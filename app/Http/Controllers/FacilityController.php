<?php

namespace App\Http\Controllers;
use App\Models\{Facility,Restaurant};
use DataTables;
use Illuminate\Http\Request;
use Storage;

class FacilityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-facilities|create-facilities|edit-facilities|delete-facilities', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-facilities', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-facilities', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-facilities', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'master';

        $data = Facility::orderBy('created_at')->get();
        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('image', function($row){
                    if (is_null($row->image) || $row->image == "") {
                        $url = asset('assets/img/default.png');
                    } else {
                        $url = Storage::url('public/images/facilities/'.$row->image);
                    }
                    return $image = '<img src="'. $url . '" class="rounded" style="width: 70px; height: 70px;">';
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    if ($auth->can('edit-facilities')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="'.route('facilities.edit',$row->id).'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    }
                    if ($auth->can('delete-facilities')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=
                            '<a class="btn btn-icon btn-danger btn-icon-only" href="#" onclick="deleteItem(this)" data-name="' .
                            $row->name .
                            '" data-id="' .
                            $row->id .
                            '">
                                <span class="btn-inner--icon"><i class="fas fa-trash-alt text-white"></i></span>
                            </a>';
                    }

                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.facilities.index', compact('page'));
    }

    public function create()
    {
        $page = 'master';
        return view('pages.facilities.create', compact('page'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required',
            'image' => 'nullable'
        ],[
            'name.required'           => 'Fasilitas harus diisi.',
            'name.unique'             => 'Fasilitas sudah ada.'
        ]);

        if(isset($request->image))
        {
            $originalFileName = time() . str_replace(" ", "",  $request->image->getClientOriginalName());
            $image = $request->image;
            $image_path = $image->storeAs('public/images/facilities',$originalFileName);
            $request->image = $originalFileName;
        }

        $data = Facility::create([
            'name' => $request->name,
            'image' => isset($request->image) ? $request->image : null,
        ]);

        if($data){
            return response()->json([
                'success'   => true,
                'message'   => 'Fasilitas berhasil ditambahkan'
            ]);
        }else{
            return response()->json([
                'success'   => fasle,
                'message'   => 'Fasilitas gagal ditambahkan'
            ]);
        }
    }

    public function edit(int $id)
    {
        $page = 'master';
        $data = Facility::findOrFail($id);
        return view('pages.facilities.edit',compact('data','page'));
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'name' => 'nullable|unique:facilities,name,'.$id,
        ],[
            'name.unique' => 'Fasilitas sudah ada.'
        ]);

        $facility = Facility::findOrFail($id);
        if(isset($request->image))
        {
            $temp = $facility->image;
            $originalFileName = time() . str_replace(" ", "",  $request->image->getClientOriginalName());
            $image = $request->image;
            $image_path = $image->storeAs('public/images/facilities',$originalFileName);
            $request->image = $originalFileName;
        }

        $facility->update([
            'name' => $request->name,
            'image' => isset($request->image) ? $request->image : null,
        ]);

        if($facility){
            if($request->image){
                Storage::delete('public/images/facilities/'.$temp);
                $image->storeAs('public/images/facilities', $request->image);
            }

            return response()->json([
                'success'   => true,
                'message'   => 'Fasilitas berhasil diupdate'
            ]);
        }else{
            return response()->json([
                'success'  => false,
                'message'   => 'Fasilitas gagal diupdate'
            ]);
        }
    }


    public function destroy(Facility $facility)
    {
        $data = $facility->delete();

        if($data)
        {
            Storage::delete('public/images/facilities/'.$data->image);

            return response()->json([
               'success'   => true,
                'message'  => "Fasilitas berhasil dihapus"
            ]);
        }
    }
}
