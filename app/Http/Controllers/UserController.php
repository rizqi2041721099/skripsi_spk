<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DataTables;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DB;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:list-users|create-users|edit-users|delete-users', ['only' => ['index','store']]);
         $this->middleware('permission:create-users', ['only' => ['create','store']]);
         $this->middleware('permission:edit-users', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-users', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'management-users';
        $auth  = auth()->user();

        if($request->filter_name) {
            $data = User::where('name',$request->filter_name)->get();
        } else {
            $data = User::orderBy('created_at')->get();
        }

        if($request->ajax()){
            return DataTables::of($data)
                ->addColumn('name',function($row){
                    return $row->name;
                })
                ->addColumn('role', function($row){
                    if(!empty($row->getRoleNames())){
                        foreach($row->getRoleNames() as $role){
                            if($role == 'ADMIN'){
                                $badge = '<label class="badge badge-primary">'.$role.'</label>';
                                return $badge;
                            }elseif($role == 'USER'){
                                $badge = '<label class="badge badge-success">'.$role.'</label>';
                                return $badge;
                            }

                        }
                    }
                })
                ->addColumn('email',function($row){
                    return $row->email;
                })
                ->addColumn('action',function($row)use($auth){
                    $btn = '';
                    if ($auth->can('edit-users')) {
                        $btn .= '&nbsp;&nbsp;';
                        $btn .= '<a href="'.route('users.edit',$row->id).'" data-original-title="Edit" class="btn btn-primary"><span><i class="fas fa-pen-square"></i></span></a>';
                    }
                    if ($auth->can('delete-users')) {
                        $btn .= '&nbsp;&nbsp;';
                        $btn .= '<a class="btn btn-icon btn-danger btn-icon-only" href="#" onclick="deleteItem(this)" data-name="'.$row->name.'" data-id="'.$row->id.'">
                                            <span class="btn-inner--icon"><i class="fas fa-trash-alt text-white"></i></span>
                                </a>';
                    }

                    return $btn;
                })
                ->rawColumns(['action','role'])
                ->addIndexColumn()
                ->make(true);
            }
        return view('pages.users.index',compact('page'));
    }

    public function create()
    {
        $page = 'management-users';

        return view('pages.users.create',compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|same:confirm_password',
        ],[
            'name.required'          => 'Nama lengkap harus diisi.',
            'email.required'         => 'Email harud diisi.',
            'email.unique'           => 'Email sudah ada.',
            'password.required'      => 'Password harud diisi.',
            'password.same'          => 'Password yang diinput tidak sama.',
        ]);

        $validated = $request->all();

        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
        ]);

        $role = Role::where('name','USER')->first();
        $user->assignRole([$role->id]);

        return response()->json([
            'success'   => true,
            'message'   => "$user->name berhasil ditambahkan"
        ],201);
    }

    public function show(int $id)
    {
        $page = 'management-users';
        $user = User::find($id);

        return view('pages.users.show',compact('page','user'));
    }

    public function edit(int $id)
    {
        $page = 'management-users';
        $user = User::find($id);
        $role = Role::whereNotIn('id',[1])->first();
        $userRole = $user->roles->first();

        return view('pages.users.edit',compact('page','role','userRole','user'));
    }

    public function editProfile(int $id)
    {
        $page = 'profile';
        $data = User::where('id',auth()->user()->id)->first();

        return view('pages.profile.edit',compact('page','data'));
    }

    public function updateProfile(Request $request, int $id)
    {
        $request->validate([
            'name'          => 'nullable|unique:users,name,'.$id,
            'email'         => 'nullable|email|unique:users,email,'.$id,
        ],[
            'name.unique'   => 'Nama sudah ada',
            'email.unique' => 'Email sudah ada',
        ]);

        $validated = $request->all();
        if(!empty($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        }else{
            $validated = Arr::except($validated,array('password'));
        }

        $user = User::find($id);
        $user->update($validated);

        return response()->json([
            'success'   => true,
            'message'   => "profile user berhasil diupdate"
        ],200);
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$id
        ]);

        $validated = $request->all();
        if(!empty($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        }else{
            $validated = Arr::except($validated,array('password'));
        }

        $user = User::find($id);
        $role = Role::where('name','USER')->first();
        $user->assignRole([$role->id]);
        $user->update($validated);

        return response()->json([
            'success'   => true,
            'message'   => "$user->name berhasil diupdate"
        ],200);
    }

    public function destroy(int $id)
    {
        $user = User::find($id)->delete();

        return response()->json([
            'success'   => true,
            'message'   => "User berhasil dihapus"
        ],200);
    }

    public function getUsers(Request $request)
    {
        $search = $request->search;
        try {
            if($search == '') {
                $data = User::role($roles)->get();
            } else {
                $data = User::where('name', 'like', '%' . $search . '%')
                                ->get();
            }
        } catch (\Throwable $th) {
            $response = [];
        }
        $response = array();
        foreach($data as $data){

            $response[] = array(
                    "id" => $data->id,
                    "text" => $data->name,
            );
        }

        return response()->json($response);
    }

}
