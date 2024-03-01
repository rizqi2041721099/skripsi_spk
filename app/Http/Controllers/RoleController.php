<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use DataTables;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-role|create-role|edit-role|delete-role', ['only' => ['index','store']]);
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    public function index(Request $request){
        $page = 'management-users';

        $roles = Role::all();
        $auth  = auth()->user();
        if($request->ajax()){
            return DataTables::of($roles)
                ->addColumn('name', function($row){
                    if($row->name == 'ADMIN'){
                        $badge = '<span class="badge bg-success text-white">'.$row->name.'</span>';
                        return $badge;
                    }
                    else{
                        $badge = '<span class="badge bg-secondary text-white">'.$row->name.'</span>';
                        return $badge;
                    }
                })
                ->addColumn('action', function($row)use($auth){
                    $button  = '';
                    if ($auth->can('edit-role')) {
                        $button .= '&nbsp;&nbsp;';
                        $button .=   '<a href="/roles/'.$row->id.'/edit" class="btn btn-sm btn-icon btn-primary btn-icon-only rounded">
                                        <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                    </a>';
                    }
                    if ($auth->can('delete-role')) {
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button class="btn btn-icon btn-sm btn-danger btn-icon-only rounded" onclick="deleteItem(this)" data-name="'.$row->name.'" data-id="'.$row->id.'">
                                        <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                                    </button>';
                    }
                    if ($button == '') {
                        $button = 'User does not have the right permissions.';
                    }
                    return $button;
                })
                ->rawColumns(['name','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.roles.index',compact('page'));
    }

    public function create(){
        $page = 'management-users';
        $permissions = Permission::get();

        return view('pages.roles.create',compact('permissions','page'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'name'          => 'required|string|unique:roles,name',
            'permission'    => 'required'
        ],[
            'name.required'         => 'Nama harus diisi',
            'name.string'           => 'Nama harus bersifat string',
            'name.unique'           => 'Nama telah terdaftar',
            'permission.required'   => 'Hak akses harus diisi salah satu'
        ]);

        $role = Role::create(['name' => $request->name]);
        $permissions = [];
        foreach ($request->permission as $permissionName) {
            $permission = Permission::where('id', $permissionName)->first();
            if ($permission) {
                $permissions[] = $permission;
            }
        }
        $role->syncPermissions($permissions);

        if($role){
            return response()->json([
                'success'      => true,
                'message'   => 'Role berhasil ditambahkan'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Role gagal ditambahkan'
            ]);
        }
    }

    public function edit($id){
        $page = 'management-users';

        $role               = Role::findOrFail($id);
        $permissions        = Permission::get();
        $rolePermissions    = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('pages.roles.edit',compact('rolePermissions','role','page','permissions'));
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'name'          => 'required|string|unique:roles,name,'.$id,
            'permission'    => 'required'
        ],[
            'name.required'         => 'Nama harus diisi',
            'name.string'           => 'Nama harus bersifat string',
            'name.unique'           => 'Nama telah terdaftar',
            'permission.required'   => 'Hak akses harus diisi salah satu'
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name'  => $request->name,
        ]);

        $permissions = [];
        foreach ($request->permission as $permissionName) {
            $permission = Permission::where('id', $permissionName)->first();
            if ($permission) {
                $permissions[] = $permission;
            }
        }
        $role->syncPermissions($permissions);

        if($role){
            return response()->json([
                'success'      => true,
                'message'   => 'Role berhasil diupdate'
            ]);
        }else{
            return response()->json([
                'success'      => false,
                'message'   => 'Role gagal diupdate'
            ]);
        }
    }

    public function destroy($id){

        $role = Role::where('id',$id)->first();

        if($role){
            $role->delete();
            return response()->json([
                'success'      => true,
                'message'   => 'Role berhasil dihapus'
            ]);
        }else{
            return response()->json([
                'success'      => false,
                'message'   => 'Role gagal dihapus'
            ]);
        }
    }
}
