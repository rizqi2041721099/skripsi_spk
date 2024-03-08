<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use DataTables;
use Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-restaurant|create-restaurant|edit-restaurant|delete-restaurant', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-restaurant', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-restaurant', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-restaurant', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'restaurants';

        if(auth()->user()->hasRole('ADMIN'))
        {
            $data = Restaurant::orderBy('created_at')->get();
        } else {
            $data = [];
        }

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('address', function ($row) {
                    return Str::limit($row->address, 20);
                })
                ->addColumn('distance', function ($row) {
                    return $row->distance.' m';
                })
                ->addColumn('image', function($row){
                    if (is_null($row->images) || $row->images == "") {
                        $url = asset('assets/img/default.png');
                    } else {
                        $url = Storage::url('public/images/restaurants/'.$row->images);
                    }
                    return $image = '<img src="'. $url . '" class="rounded" style="width: 70px; height: 70px;">';
                })
                ->addColumn('facility', function ($row) {
                    return $row->facility ?? '-';
                })
                ->addColumn('qty_variasi_makanan', function ($row) {
                    return $row->qty_variasi_makanan ?? '-';
                })
                ->addColumn('average', function ($row) {
                    return number_format($row->average) ?? '-';
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    $btn .= '<div class="btn-group" role="group"/> ';
                    if ($auth->can('edit-restaurant')) {
                        // $btn .= '&nbsp;&nbsp';
                        $btn .=   '<button href="javascript:void(0)" onclick="updateItem(this)" data-id="'.$row->id.'" data-image="'.$row->images.'" class="btn btn-primary">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </button>';
                    }
                    if ($auth->can('delete-restaurant')) {
                        // $btn .= '&nbsp;&nbsp';
                        $btn .=
                            '<button class="btn btn-danger" href="#" onclick="deleteItem(this)" data-name="' .
                            $row->name .
                            '" data-id="' .
                            $row->id .
                            '">
                                <span class="btn-inner--icon"><i class="fas fa-trash-alt text-white"></i></span>
                            </button>';
                    }
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.restaurant.index', compact('page'));
    }

    public function listApprove(Request $request)
    {
        $page = 'restaurants';

        $data = Restaurant::where('status','=','0')->get();
        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('address', function ($row) {
                    return Str::limit($row->address, 20);
                })
                ->addColumn('distance', function ($row) {
                    return $row->distance.' m';
                })
                ->addColumn('image', function($row){
                    if (is_null($row->images) || $row->images == "") {
                        $url = asset('assets/img/default.png');
                    } else {
                        $url = Storage::url('public/images/restaurants/'.$row->images);
                    }
                    return $image = '<img src="'. $url . '" class="rounded" style="width: 70px; height: 70px;">';
                })
                ->addColumn('facility', function ($row) {
                    return $row->facility ?? '-';
                })
                ->addColumn('qty_variasi_makanan', function ($row) {
                    return $row->qty_variasi_makanan ?? '-';
                })
                ->addColumn('average', function ($row) {
                    return number_format($row->average) ?? '-';
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    $btn .= '<div class="btn-group" role="group"/> ';
                    if($row->status == '0'){
                        $btn .= '&nbsp;&nbsp;';
                        $btn .= '<button onclick="approve(this)" data-status="Y" data-name="setujui '.$row->name.'" data-id="'.$row->id.'" class="btn btn-sm btn-success btn-icon btn-round"><i class="fas fa-check-circle"></i></button>';
                        $btn .= '&nbsp;&nbsp;';
                        $btn .= '<button onclick="approve(this)" data-status="N" data-name="tolak '.$row->name.'" data-id="'.$row->id.'" class="btn btn-sm btn-danger btn-icon btn-round"><i class="fas fa-ban"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.restaurant.list-approve', compact('page'));
    }

    public function approve(Request $request, $id){
        $data = Restaurant::find($id);
        if($data->status == 1){
            return response()->json(['code' => 400, 'message' => 'Restaurant telah di otorisasi']);
        }
        $data->update([
            'status'    => $request->status == 'Y' ? 1 : 0,
            'note'      => $request->note ?? NULL
        ]);

        return response()->json(['code' => 200, 'message' => 'Approve success']);
    }

    public function create()
    {
        $page = 'restaurant';
        return view('pages.restaurant.create', compact('page'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required|unique:restaurants,name,',
            'distance'          => 'required',
            'images'            => 'nullable',
            'address'           => 'nullable',
            'facility'          => 'nullable',
            'qty_variasi_makanan'    => 'nullable|integer',
            'average'           => 'nullable',
        ],[
            'name.required'           => 'Nama restaurant harus diisi.',
            'distance.required'       => 'Jarak restaurant harus diisi.',
            'qty_variasi_makanan'       => 'Qty food variaty harus berupa angka.',
        ]);

        if(isset($request->images))
        {
            $originalFileName = time() . str_replace(" ", "",  $request->images->getClientOriginalName());
            $image = $request->images;
            $image_path = $image->storeAs('public/images/restaurants',$originalFileName);
            $request->images = $originalFileName;
        }

        $average     = (int)str_replace([",","."], "",$request['average']);

        $auth = auth()->user();
        $data = Restaurant::create([
            'name'      => $request->name,
            'distance'  => $request->distance,
            'added_by'  => auth()->user()->name,
            'address'   => $request->address,
            'facility'   => $request->facility,
            'average'   => $average,
            'status'    => $auth->hasRole('ADMIN') ? 1 : 0,
            'qty_variasi_makanan'   => $request->qty_variasi_makanan,
            'images'    => isset($request->images) ? $request->images : null,
        ]);

        if($data){
            return response()->json([
                'success'   => true,
                'message'   => 'Restaurant berhasil ditambahkan'
            ]);
        }else{
            return response()->json([
                'success'   => fasle,
                'message'   => 'Restaurant gagal ditambahkan'
            ]);
        }
    }

    public function edit(Restaurant $restaurant)
    {
        return response()->json($restaurant);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $this->validate($request, [
            'name'      => 'nullable|unique:restaurants,name,'.$restaurant->id,
            'distance'  => 'nullable',
            'image'     => 'nullable|image',
            'address'   => 'nullable',
            'facility'   => 'nullable',
            'qty_variasi_makanan'    => 'nullable|integer',
            'average'           => 'nullable',
        ], [
            'name.unique' => 'Restaurant sudah ada.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'qty_variasi_makanan.integer' => 'Qty food variaty harus berupa angka.',
        ]);

        $average     = (int)str_replace([",","."], "",$request['average']);

        $temp = null;
        if ($request->hasFile('image')) {
            $temp = $restaurant->image;
            $originalFileName = time() . str_replace(" ", "",  $request->image->getClientOriginalName());
            $image_path = $request->image->storeAs('public/images/restaurants', $originalFileName);
            $request->image = $originalFileName;
        }

        $restaurant->update([
            'name'      => $request->name,
            'distance'  => $request->distance,
            'address'   => $request->address,
            'facility'   => $request->facility,
            'qty_variasi_makanan'   => $request->qty_variasi_makanan,
            'average'   => $average,
            'images'    => $request->hasFile('image') ? $originalFileName : $restaurant->images,
        ]);

        if ($restaurant->wasChanged('images') && $temp) {
            Storage::delete('public/images/restaurants/'.$temp);
        }

        if ($restaurant) {
            return response()->json([
                'success'   => true,
                'message'   => 'Restaurant berhasil diupdate'
            ]);
        } else {
            return response()->json([
                'success'  => false,
                'message'   => 'Restaurant gagal diupdate'
            ]);
        }

    }

    public function destroy(Restaurant $restaurant)
    {
        $data = $restaurant->delete();

        if($data)
        {
            Storage::delete('public/images/restaurants/'.$data->image);

            return response()->json([
               'success'   => true,
                'message'  => "Restaurant berhasil dihapus"
            ]);
        }
    }

    public function getRestaurant(Request $request)
    {
        $search = $request->search;
        try {
            if($search == '') {
                $data = Restaurant::get();
            } else {
                $data = Restaurant::where('name', 'like', '%' . $search . '%')->get();
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
