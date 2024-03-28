<?php

namespace App\Http\Controllers;

use App\Models\{Restaurant,Facility,
                KriteriaFasilitas,KriteriaRasa
            };
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
        $auth = auth()->user();

        if(auth()->user()->hasRole('ADMIN'))
        {
            $data = Restaurant::with('facilities')->latest()->get();
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
                ->addColumn('facility', function ($row) use ($data) {
                    return $row->facilities ? $row->facilities->count() : 0;
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
                        $btn .=   '<a href="'.route('restaurants.edit',$row->id).'" class="btn btn-icon btn-primary btn-icon-only">
                                    <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                    </a>';
                        $btn .=   '<a href="'.route('restaurants.show',$row->id).'" class="btn btn-icon btn-secondary btn-icon-only" target="_blank">
                                    <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                    </a>';
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
        $page = 'approve-restaurants';

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
                    return $row->facilities ? $row->facilities->count() : 0;
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
                        $btn .=   '<a href="'.route('restaurants.show',$row->id).'" class="btn btn-sm btn-secondary">
                        <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                        </a>';
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

    public function listRejected(Request $request)
    {
        $page = 'restaurants-rejected';

        $data = Restaurant::where('status','=','2')->get();
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
                    return $row->facilities ? $row->facilities->count() : 0;
                })
                ->addColumn('qty_variasi_makanan', function ($row) {
                    return $row->qty_variasi_makanan ?? '-';
                })
                ->addColumn('average', function ($row) {
                    return number_format($row->average) ?? '-';
                })
                ->addColumn('note', function ($row)use($auth) {
                   return $row->note;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    $btn .=   '<a href="'.route('restaurants.show',$row->id).'" class="btn btn-sm btn-secondary">
                    <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                    </a>';
                    return $btn;
                })
                ->rawColumns(['image','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.restaurant.list-rejected', compact('page'));
    }

    public function approve(Request $request, $id){
        $data = Restaurant::find($id);
        if($data->status == 1){
            return response()->json(['code' => 400, 'message' => 'Restaurant telah di otorisasi']);
        }
        $data->update([
            'status'    => $request->status == 'Y' ? 1 : 2,
            'note'      => $request->note ?? NULL
        ]);

        return response()->json(['code' => 200, 'message' => 'Approve success']);
    }

    public function create()
    {
        $page = 'restaurant';
        $facilities = Facility::get();
        $getRasa = KriteriaRasa::get();
        $getFasilitas = KriteriaFasilitas::get();

        return view('pages.restaurant.create', compact('page','facilities','getFasilitas','getRasa'));
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
            'map_link'          => 'nullable',
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

        $count_variasi_menu = (int)$request->qty_variasi_menu;

        if($count_variasi_menu > 20)
        {
           $v_variasi_menu = 1;
        } elseif ($count_variasi_menu >= 15 || $count_variasi_menu <= 20) {
            $v_variasi_menu = 2;
        } elseif($count_variasi_menu >=10 || $count_variasi_menu <= 15) {
            $v_variasi_menu = 3;
        } elseif($count_variasi_menu >= 5 || $count_variasi_menu <= 10) {
            $v_variasi_menu = 4;
        } elseif($count_variasi_menu <= 5) {
            $v_variasi_menu = 5;
        }

        $average     = (int)str_replace([",","."], "",$request['average']);
        if($average >= 2000.00 || $average <= 15000.00) {
            $v_harga = 1;
        } elseif ($average >= 15000.00 || $average <= 25000.00) {
            $v_harga = 2;
        } elseif($average > 25000.00) {
            $v_harga = 3;
        }

        // initial value jarak
        $jarak = (int)$request->distance;
        if($jarak < 1000) {
            $v_jarak = 1;
        } elseif($jarak >= 1000 || $jarak <= 3000) {
            $v_jarak = 2;
        } elseif($jarak > 25000) {
            $v_jarak = 3;
        }

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
            'kriteria_fasilitas_id' => $request->kriteria_fasilitas_id,
            'kriteria_rasa_id' => $request->kriteria_rasa_id,
            'variasi_menu_id'  => $v_variasi_menu,
            'kriteria_jarak_id' => $v_jarak,
            'kriteria_harga_id' => $v_harga,
            'map_link'  => $request->map_link,
        ]);

        $data->facilities()->attach($request->facility_id);

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
        $page = 'restaurant';
        $facilities = Facility::get();
        $getRasa = KriteriaRasa::get();
        $getFasilitas = KriteriaFasilitas::get();
        return view('pages.restaurant.edit',compact('restaurant','page','facilities','getRasa','getFasilitas'));
    }

    public function show(Restaurant $restaurant)
    {
        $page = 'restaurant';
        $facilities = Facility::get();
        return view('pages.restaurant.show',compact('restaurant','page','facilities'));
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

        $count_variasi_menu = (int)$request->qty_variasi_menu;

        if($count_variasi_menu > 20)
        {
           $v_variasi_menu = 1;
        } elseif ($count_variasi_menu >= 15 || $count_variasi_menu <= 20) {
            $v_variasi_menu = 2;
        } elseif($count_variasi_menu >=10 || $count_variasi_menu <= 15) {
            $v_variasi_menu = 3;
        } elseif($count_variasi_menu >= 5 || $count_variasi_menu <= 10) {
            $v_variasi_menu = 4;
        } elseif($count_variasi_menu <= 5) {
            $v_variasi_menu = 5;
        }

        $average     = (int)str_replace([",","."], "",$request['average']);
        if($average >= 2000.00 || $average <= 15000.00) {
            $v_harga = 1;
        } elseif ($average >= 15000.00 || $average <= 25000.00) {
            $v_harga = 2;
        } elseif($average > 25000.00) {
            $v_harga = 3;
        }

        // initial value jarak
        $jarak = (int)$request->distance;
        if($jarak < 1000) {
            $v_jarak = 1;
        } elseif($jarak >= 1000 || $jarak <= 3000) {
            $v_jarak = 2;
        } elseif($jarak > 25000) {
            $v_jarak = 3;
        }

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
            'kriteria_fasilitas_id' => $request->kriteria_fasilitas_id,
            'kriteria_rasa_id' => $request->kriteria_rasa_id,
            'variasi_menu_id'  => $v_variasi_menu,
            'kriteria_jarak_id' => $v_jarak,
            'kriteria_harga_id' => $v_harga,
            'map_link'  => $request->map_link,
        ]);

        if ($restaurant->wasChanged('images') && $temp) {
            Storage::delete('public/images/restaurants/'.$temp);
        }

        $restaurant->facilities()->sync($request->facility_id);

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

    public function destroy(int $id)
    {
        $data = Restaurant::find($id);

        if($data)
        {
            $data->delete();
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

    public function search()
    {
        $page = 'search';
        $facilities = Facility::get();
        return view('pages.restaurant.search',compact('page','facilities'));
    }

    public function filter(Request $request)
    {
        $maxQty = $request->input('variasi_menu');
        $jarak = $request->input('jarak');
        $harga = $request->input('harga');
        $selectedFacilities = $request->input('facility_id', []);

        $data = Restaurant::where(function($query) use ($jarak, $harga, $maxQty) {
            $query->where(function($query) use ($maxQty) {
                if ($maxQty == 5) {
                    $query->where('qty_variasi_makanan', '>', 20);
                } elseif ($maxQty == 4) {
                    $query->whereBetween('qty_variasi_makanan', [15, 20]);
                } elseif ($maxQty == 3) {
                    $query->whereBetween('qty_variasi_makanan', [10, 15]);
                } elseif ($maxQty == 2) {
                    $query->whereBetween('qty_variasi_makanan', [5, 10]);
                } elseif ($maxQty == 1) {
                    $query->where('qty_variasi_makanan', '<', 5);
                }
            })
            ->where(function($query) use ($jarak) {
                if ($jarak == 5) {
                    $query->where('distance', '<', 1000);
                } elseif ($jarak == 4) {
                    $query->whereBetween('distance', [1000, 3000]);
                } elseif ($jarak == 3) {
                    $query->whereBetween('distance', [3000, 5000]);
                } elseif ($jarak == 2) {
                    $query->whereBetween('distance', [5000, 7000]);
                } elseif ($jarak == 1) {
                    $query->where('distance', '>', 7000);
                }
            })
            ->where(function($query) use ($harga) {
                if ($harga == 5) {
                    $query->whereBetween('average', [2000.00, 15000.00]);
                }  elseif ($harga == 3) {
                    $query->whereBetween('average', [15000.00, 25000.00]);
                } elseif ($harga == 1) {
                    $query->where('average', '>', 25000.00);
                }
            });
        })
        ->when(!empty($selectedFacilities), function ($query) use ($selectedFacilities) {
            $query->whereHas('facilities', function ($query) use ($selectedFacilities) {
                $query->whereIn('facilities.id', $selectedFacilities);
            });
        })
        ->get();


        return response()->json($data);
    }

}
