<?php

namespace App\Http\Controllers;

use App\Models\{Restaurant,Facility,
                KriteriaFasilitas,KriteriaRasa,
                FoodVariaty,Comment,KriteriaVariasiMenu,KriteriaJarak,KriteriaHarga
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
            $data = Restaurant::where('added_by',auth()->user()->name)->get();
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
                ->addColumn('rasa', function ($row) {
                    return $row->rasa->standard_value;
                })
                ->addColumn('status', function ($row) {
                    $span = '';
                    if($row->status == '0'){
                        $span .= '<span class="badge badge-pill badge-warning">Waiting</span>';
                    } else {
                        $span .= '<span class="badge badge-pill badge-primary">Approve</span>';
                    }
                    return $span;
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
                ->rawColumns(['action','image','status'])
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
            'restaurant_name'   => 'required|unique:restaurants,name,',
            'distance'          => 'required',
            'images'            => 'nullable',
            'address'           => 'nullable',
            'facility'          => 'nullable',
            'qty_variasi_makanan'    => 'nullable|integer',
            'average'           => 'nullable',
            'map_link'          => 'nullable',
            'menuData'          => 'nullable'
        ],[
            'name.required'           => 'Nama restaurant harus diisi.',
            'distance.required'       => 'Jarak restaurant harus diisi.',
            // 'qty_variasi_makanan'       => 'Qty food variaty harus berupa angka.',
        ]);

        if(isset($request->images))
        {
            $originalFileName = time() . str_replace(" ", "",  $request->images->getClientOriginalName());
            $image = $request->images;
            $image_path = $image->storeAs('public/images/restaurants',$originalFileName);
            $request->images = $originalFileName;
        }

        // $count_variasi_menu = (int)$request->qty_variasi_makanan;

        // $average     = (int)str_replace([",","."], "",$request['average']);

        // initial value jarak
        $jarak = (int)$request->distance;
        if($jarak < 1000) {
            $v_jarak = 5;
        } elseif($jarak >= 1000 && $jarak < 3000) {
            $v_jarak = 4;
        } elseif($jarak <= 3000 && $jarak < 5000) {
            $v_jarak = 3;
        } elseif($jarak <= 5000 && $jarak <= 7000) {
            $v_jarak = 2;
        }  elseif($jarak >= 7000) {
            $v_jarak = 1;
        }
        $auth = auth()->user();
        $menuData = json_decode($request->input('menuData'), TRUE);

        $data = Restaurant::create([
            'name'      => $request->restaurant_name,
            'distance'  => $request->distance,
            'added_by'  => auth()->user()->name,
            'address'   => $request->address,
            'facility'   => $request->facility,
            'status'    => $auth->hasRole('ADMIN') ? 1 : 0,
            'images'    => isset($request->images) ? $request->images : null,
            'kriteria_fasilitas_id' => $request->kriteria_fasilitas_id,
            'kriteria_rasa_id' => $request->kriteria_rasa_id,
            'kriteria_jarak_id' => $v_jarak,
            'map_link'  => $request->map_link,
        ]);
        $data->facilities()->attach($request->facility_id);

        $totalPrice = 0;
        $totalData = count($menuData);

        if($totalData > 20)
        {
           $v_variasi_menu = 1;
        } elseif ($totalData >= 15 && $totalData <= 20) {
            $v_variasi_menu = 2;
        } elseif($totalData >=10 && $totalData <= 15) {
            $v_variasi_menu = 3;
        } elseif($totalData >= 5 && $totalData <= 10) {
            $v_variasi_menu = 4;
        } elseif($totalData <= 5) {
            $v_variasi_menu = 5;
        }

        foreach ($menuData as $menu) {
            $name = $menu['name'];
            $price = $menu['price'];
            $priceNumeric = (int) str_replace([",", "."], "", $price);

            $totalPrice += $priceNumeric;

            FoodVariaty::create([
                'restaurant_id' => $data->id,
                'name' => $name,
                'price' => $priceNumeric,
            ]);
        }
        $averagePrice = $totalData > 0 ? $totalPrice / $totalData : 0;
        $v_harga = 0;
        switch ($averagePrice) {
            case ($averagePrice >= 2000 && $averagePrice < 15000):
                $v_harga = 1;
                break;
            case ($averagePrice >= 15000 && $averagePrice < 25000):
                $v_harga = 2;
                break;
            case ($averagePrice >= 25000):
                $v_harga = 3;
                break;
        }

        $data->qty_variasi_makanan = $totalData;
        $data->average = $averagePrice;
        $data->variasi_menu_id = $v_variasi_menu;
        $data->kriteria_harga_id = $v_harga;
        $data->save();

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
        $foodVariaty = FoodVariaty::where('restaurant_id',$restaurant->id)->get();

        return view('pages.restaurant.edit',compact('restaurant','page','facilities','getRasa','getFasilitas','foodVariaty'));
    }

    public function show(Restaurant $restaurant)
    {
        $page = 'restaurant';
        $facilities = Facility::get();
        $food_variaty = FoodVariaty::where('restaurant_id',$restaurant->id)->get();
        $commentList = Comment::where('restaurant_id',$restaurant->id)->get();
        $getRasa = KriteriaRasa::get();
        return view('pages.restaurant.show',compact('restaurant','page','facilities','food_variaty','commentList','getRasa'));
    }

    public function detailRestaurant(Restaurant $restaurant)
    {
        $restaurant = Restaurant::where('id',$restaurant->id)->first();
        $facilities = Facility::get();
        $food_variaty = FoodVariaty::where('restaurant_id',$restaurant->id)->get();
        $commentList = Comment::where('restaurant_id',$restaurant->id)->get();
        $getRasa = KriteriaRasa::get();
        return view('pages.frontend.home.detail-restaurant',compact('restaurant','facilities','food_variaty','commentList','getRasa'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $this->validate($request, [
            'restaurant_name'  => 'nullable|unique:restaurants,name,'.$restaurant->id,
            'distance'  => 'nullable',
            'image'     => 'nullable|image',
            'address'   => 'nullable',
            'facility'   => 'nullable',
            'qty_variasi_makanan'    => 'nullable|integer',
            'average'           => 'nullable',
            'kriteria_fasilitas_id' => 'nullable',
            'kriteria_rasa_id' => 'nullable'
        ], [
            'name.unique' => 'Restaurant sudah ada.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'qty_variasi_makanan.integer' => 'Qty food variaty harus berupa angka.',
        ]);

        // initial value jarak
        $jarak = (int)$request->distance;
        $v_jarak = 0;
        if($jarak < 1000) {
            $v_jarak = 1;
        } elseif($jarak >= 1000 && $jarak < 3000) {
            $v_jarak = 2;
        } elseif($jarak <= 3000 && $jarak < 5000) {
            $v_jarak = 3;
        } elseif ($jarak <= 5000 && $jarak <= 7000) {
            $v_jarak = 4;
        }  elseif ($jarak > 7000) {
            $v_jarak = 5;
        }

        $temp = null;
        if ($request->hasFile('image')) {
            $temp = $restaurant->image;
            $originalFileName = time() . str_replace(" ", "",  $request->image->getClientOriginalName());
            $image_path = $request->image->storeAs('public/images/restaurants', $originalFileName);
            $request->image = $originalFileName;
        }

        // $menuData = json_decode($request->input('menuData'), TRUE);
        $menuData = collect(json_decode($request->input('menuData'), TRUE));

        $restaurant->update([
            'name'      => $request->restaurant_name,
            'distance'  => $request->distance,
            'address'   => $request->address,
            'facility'   => $request->facility,
            'images'    => $request->hasFile('image') ? $originalFileName : $restaurant->images,
            'kriteria_fasilitas_id' => $request->kriteria_fasilitas_id,
            'kriteria_rasa_id' => $request->kriteria_rasa_id,
            'kriteria_jarak_id' => $v_jarak,
            'map_link'  => $request->map_link,
        ]);

        if ($restaurant->wasChanged('images') && $temp) {
            Storage::delete('public/images/restaurants/'.$temp);
        }

        $restaurant->facilities()->sync($request->facility_id);

        $totalPrice = 0;
        $totalData = count($menuData);

        if($totalData > 20)
        {
           $v_variasi_menu = 1;
        } elseif ($totalData >= 15 && $totalData <= 20) {
            $v_variasi_menu = 2;
        } elseif($totalData >=10 && $totalData <= 15) {
            $v_variasi_menu = 3;
        } elseif($totalData >= 5 && $totalData <= 10) {
            $v_variasi_menu = 4;
        } elseif($totalData <= 5) {
            $v_variasi_menu = 5;
        }

        $existingVariety = FoodVariaty::where('restaurant_id',$restaurant->id)->select('id','name','price')->get();
        foreach ($existingVariety as $foodVariety) {
            if (!$menuData->contains('id', $foodVariety->id)) {
                $foodVariety->delete();
            }
        }

        foreach ($menuData as $menu) {
            $name = $menu['name'];
            $price = (int) str_replace([",", "."], "", $menu['price']);
            $totalPrice += $price;
            if($existingVariety->isEmpty()){
                FoodVariaty::create([
                    'restaurant_id' => $restaurant->id,
                    'name' => $name,
                    'price' => $price,
                ]);
            } else {
                $existing = $existingVariety->where('id',$menu['id'])->first();
                if ($existing) {
                        $existing->update([
                            'price' => $price,
                            'name' => $name,
                        ]);
                } else {
                    FoodVariaty::create([
                        'restaurant_id' => $restaurant->id,
                        'name' => $name,
                        'price' => $price,
                    ]);
                }
            }

        }

        $averagePrice = $totalData > 0 ? $totalPrice / $totalData : 0;
        $v_harga = 0;
        switch ($averagePrice) {
            case ($averagePrice >= 2000 && $averagePrice < 15000):
                $v_harga = 1;
                break;
            case ($averagePrice >= 15000 && $averagePrice < 25000):
                $v_harga = 2;
                break;
            case ($averagePrice >= 25000):
                $v_harga = 3;
                break;
        }

        $restaurant->update([
            'qty_variasi_makanan' => $totalData,
            'average' => $averagePrice,
            'variasi_menu_id' => $v_variasi_menu,
            'kriteria_harga_id' => $v_harga,
        ]);

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
                    "average_rating" => $averageRating,
            );
        }

        return response()->json($response);
    }

    public function search()
    {
        $page = 'search';
        $facilities = Facility::get();
        $getRasa = KriteriaRasa::get();
        $getJarak = KriteriaJarak::get();
        $getVariasiMenu = KriteriaVariasiMenu::get();
        $getHarga = KriteriaHarga::get();
        return view('pages.restaurant.search',compact('page','facilities','getRasa','getJarak','getVariasiMenu','getHarga'));
    }

    public function searchRestaurant()
    {
        $getRasa = KriteriaRasa::get();
        $getJarak = KriteriaJarak::get();
        $getVariasiMenu = KriteriaVariasiMenu::get();
        $getHarga = KriteriaHarga::get();
        $facilities = Facility::get();
        $getRasa = KriteriaRasa::get();
        return view('pages.frontend.home.search-restaurant',compact('getRasa','getJarak','getVariasiMenu','getHarga','facilities','getRasa'));
    }

    public function filter(Request $request)
    {
        $maxQty = $request->input('variasi_menu');
        $jarak = $request->input('jarak');
        $harga = $request->input('harga');
        $rasa = $request->input('rasa');
        $selectedFacilities = $request->input('facility_id', []);

        $data = Restaurant::where(function($query) use ($jarak, $harga, $maxQty, $rasa) {
            $query->where(function($query) use ($maxQty) {
                if ($maxQty == 5) {
                    $query->where('variasi_menu_id', 5);
                } elseif ($maxQty == 4) {
                    $query->where('variasi_menu_id',4);
                } elseif ($maxQty == 3) {
                    $query->where('variasi_menu_id',3);
                } elseif ($maxQty == 2) {
                    $query->where('variasi_menu_id',2);
                } elseif ($maxQty == 1) {
                    $query->where('variasi_menu_id', 1);
                }
            })
            ->where(function($query) use ($jarak) {
                if ($jarak == 5) {
                    $query->where('kriteria_jarak_id', 5);
                } elseif ($jarak == 4) {
                    $query->where('kriteria_jarak_id',4);
                } elseif ($jarak == 3) {
                    $query->where('kriteria_jarak_id', 3);
                } elseif ($jarak == 2) {
                    $query->where('kriteria_jarak_id', 2);
                } elseif ($jarak == 1) {
                    $query->where('kriteria_jarak_id',1);
                }
            })
            ->where(function($query) use ($rasa) {
                if ($rasa == 5) {
                    $query->where('kriteria_rasa_id', 5);
                } elseif ($rasa == 4) {
                    $query->where('kriteria_rasa_id',4);
                } elseif ($rasa == 3) {
                    $query->where('kriteria_rasa_id', 3);
                } elseif ($rasa == 2) {
                    $query->where('kriteria_rasa_id', 2);
                } elseif ($rasa == 1) {
                    $query->where('kriteria_rasa_id',1);
                }
            })
            ->where(function($query) use ($harga) {
                if ($harga == 5) {
                    $query->where('kriteria_harga_id', 5);
                }  elseif ($harga == 3) {
                    $query->where('kriteria_harga_id', 3);
                } elseif ($harga == 1) {
                    $query->where('kriteria_harga_id',1);
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
