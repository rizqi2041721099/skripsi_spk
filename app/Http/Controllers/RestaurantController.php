<?php

namespace App\Http\Controllers;

use App\Models\{Restaurant,Facility,
                KriteriaFasilitas,
                FoodVariaty,Comment,KriteriaVariasiMenu,KriteriaJarak,KriteriaHarga,
                KategoriJamOperasional,BobotKriteria
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
                   return $row->distance;
                })
                ->addColumn('image', function($row){
                    if (is_null($row->images) || $row->images == "") {
                        $url = asset('assets/img/default.png');
                    } else {
                        $url = Storage::url('public/images/restaurants/'.$row->images);
                    }
                    return $image = '<img src="'. $url . '" class="rounded" style="width: 70px; height: 70px;">';
                })
                // ->addColumn('facility', function ($row) use ($data) {
                //     return $row->facilities ? $row->facilities->count() : 0;
                // })
                // ->addColumn('qty_variasi_makanan', function ($row) {
                //     return $row->qty_variasi_makanan ?? '-';
                // })
                // ->addColumn('average', function ($row) {
                //     return number_format($row->average) ?? '-';
                // })
                ->addColumn('jam_operasional', function ($row) {
                    return $row->jamOperasional->range_value;
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
                        $btn .=   '<a href="javascript:void(0)" onclick="showItem(this)" data-id="'.$row->id.'" data-restaurant="'.($row->name ?? '-').'" class="btn btn-icon btn-secondary btn-icon-only">
                                    <span class="btn-inner--icon"><i class="fas fa-comment"></i></span>
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
                    return $row->distance;
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
                    return $row->distance;
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
        $getJamOperasional = KategoriJamOperasional::get();
        $getFasilitas = KriteriaFasilitas::get();
        $getVariasiMenu = KriteriaVariasiMenu::get();
        $getFasilitas = KriteriaFasilitas::get();
        $getHarga = KriteriaHarga::get();
        return view('pages.restaurant.create', compact('page','facilities','getFasilitas','getJamOperasional','getVariasiMenu','getFasilitas','getHarga'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
        'restaurant_name'               => 'required|unique:restaurants,name,',
        'distance'                      => 'required|ends_with:KM',
        'images'                        => 'nullable',
        'address'                       => 'nullable',
        'facility'                      => 'nullable',
        'qty_variasi_makanan'           => 'nullable|integer',
        'average'                       => 'nullable',
        'map_link'                      => 'nullable',
        'menuData'                      => 'nullable',
        'kriteria_fasilitas_id'         => 'required',
        'variasi_menu_id'               => 'required',
        'kriteria_jam_operasional_id'   => 'required',
        'kriteria_harga_id'             => 'required',
        ],[
            'name.required'                  => 'Nama restaurant harus diisi.',
            'distance.required'              => 'Jarak restaurant harus diisi.',
            'distance.ends_with'             => 'Format jarak tidak valid harus mengandung KM',
            'kriteria_fasilitas_id.required' => 'Kriteria fasilitas harus diisi.',
            'variasi_menu_id.required'       => 'Variasi menu harus diisi.',
            'variasi_menu_id.required'       => 'Variasi menu harus diisi.',
            'kriteria_harga_id.required'     => 'Kriteria harga harus diisi.',
            'kriteria_jam_operasional_id.required'       => 'Kriteria Jam Operasional harus diisi.',
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
        $v_jarak = 0;
        $distance_value = str_replace([' ', 'KM', 'km'], '', $request->distance);

        if($distance_value < 1) {
            $v_jarak = 1;
        } elseif($distance_value >= 1 && $distance_value <= 3) {
            $v_jarak = 2;
        } elseif($distance_value > 3 && $distance_value <= 5) {
            $v_jarak = 3;
        } elseif($distance_value > 5 && $distance_value <= 7) {
            $v_jarak = 4;
        }  elseif($distance_value > 7) {
            $v_jarak = 5;
        }

        $auth = auth()->user();

        $data = Restaurant::create([
            'name'                         => $request->restaurant_name,
            'distance'                     => $request->distance,
            'added_by'                     => auth()->user()->name,
            'address'                      => $request->address,
            'facility'                     => $request->facility,
            'status'                       => $auth->hasRole('ADMIN') ? 1 : 0,
            'images'                       => isset($request->images) ? $request->images : null,
            'kriteria_fasilitas_id'        => $request->kriteria_fasilitas_id,
            'kriteria_jam_operasional_id'  => $request->kriteria_jam_operasional_id,
            'kriteria_harga_id'            => $request->kriteria_harga_id,
            'variasi_menu_id'              => $request->variasi_menu_id,
            'kriteria_jarak_id'            => $v_jarak,
            'map_link'                     => $request->map_link,
        ]);

        // if($request->has('facility_id') || $request->has('menuData')) {
        //     if($request->has('facility_id')){
        //         $data->facilities()->attach($request->facility_id);
        //     }
        //     if($request->has('menuData')){
        //         $menuData = json_decode($request->input('menuData'), TRUE);
        //         $totalPrice = 0;
        //         $totalData = count($menuData);

        //         if($totalData > 20)
        //         {
        //            $v_variasi_menu = 1;
        //         } elseif ($totalData >= 15 && $totalData <= 20) {
        //             $v_variasi_menu = 2;
        //         } elseif($totalData >=10 && $totalData <= 15) {
        //             $v_variasi_menu = 3;
        //         } elseif($totalData >= 5 && $totalData <= 10) {
        //             $v_variasi_menu = 4;
        //         } elseif($totalData <= 5) {
        //             $v_variasi_menu = 5;
        //         }

        //         foreach ($menuData as $menu) {
        //             $name = $menu['name'];
        //             $price = $menu['price'];
        //             $priceNumeric = (int) str_replace([",", "."], "", $price);

        //             $totalPrice += $priceNumeric;

        //             FoodVariaty::create([
        //                 'restaurant_id' => $data->id,
        //                 'name' => $name,
        //                 'price' => $priceNumeric,
        //             ]);
        //         }

        //         $averagePrice = $totalData > 0 ? $totalPrice / $totalData : 0;
        //         $v_harga = 0;
        //         switch ($averagePrice) {
        //             case ($averagePrice >= 2000 && $averagePrice < 15000):
        //                 $v_harga = 1;
        //                 break;
        //             case ($averagePrice >= 15000 && $averagePrice < 25000):
        //                 $v_harga = 2;
        //                 break;
        //             case ($averagePrice >= 25000):
        //                 $v_harga = 3;
        //                 break;
        //         }

        //         if($v_harga != $data->kriteria_harga_id){
        //             return response()->json([
        //                 'success'   => false,
        //                 'message'   => 'Rata-rata harga makanan tidak sama dengan harga pada kriteria harga makanan'
        //             ]);
        //         }
        //         if($v_variasi_menu != $data->variasi_menu_id){
        //             return response()->json([
        //                 'success'   => false,
        //                 'message'   => 'Variasi menu tidak sama dengan kriteria variasi menu'
        //             ]);
        //         }

        //         $data->qty_variasi_makanan = $totalData;
        //         $data->average = $averagePrice;
        //         // $data->variasi_menu_id = $v_variasi_menu;
        //         // $data->kriteria_harga_id = $v_harga;
        //     }

        //     $data->save();
        // }


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
        $getJamOperasional = KategoriJamOperasional::get();
        $getFasilitas = KriteriaFasilitas::get();
        $foodVariaty = FoodVariaty::where('restaurant_id',$restaurant->id)->get();
        $getVariasiMenu = KriteriaVariasiMenu::get();
        $getHarga = KriteriaHarga::get();

        return view('pages.restaurant.edit',compact('restaurant','page','facilities','getJamOperasional','getFasilitas','foodVariaty','getVariasiMenu','getHarga'));
    }

    public function show(Restaurant $restaurant)
    {
        $page = 'restaurant';
        $facilities = Facility::get();
        $food_variaty = FoodVariaty::where('restaurant_id',$restaurant->id)->get();
        $commentList = Comment::where('restaurant_id',$restaurant->id)->whereNull('parent_id')->get();
        $getJamOperasional = KategoriJamOperasional::get();
        return view('pages.restaurant.show',compact('restaurant','page','facilities','food_variaty','commentList','getJamOperasional'));
    }

    public function detailRestaurant(Restaurant $restaurant)
    {
        $restaurant = Restaurant::where('id',$restaurant->id)->first();
        $facilities = Facility::get();
        $food_variaty = FoodVariaty::where('restaurant_id',$restaurant->id)->get();
        $commentList = Comment::where('restaurant_id',$restaurant->id)->whereNull('parent_id')->get();
        $getJamOperasional = KategoriJamOperasional::get();
        return view('pages.frontend.home.detail-restaurant',compact('restaurant','facilities','food_variaty','commentList','getJamOperasional'));
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'restaurant_name'  => 'nullable|unique:restaurants,name,'.$id,
            'distance'  => 'nullable|ends_with:KM',
            'image'     => 'nullable|image',
            'address'   => 'nullable',
            'facility'   => 'nullable',
            'qty_variasi_makanan'    => 'nullable|integer',
            'average'           => 'nullable',
            'kriteria_fasilitas_id' => 'nullable',
            'kriteria_jam_operasional_id' => 'nullable',
            'variasi_menu_id' => 'nullable',
            'kriteria_harga_id' => 'nullable',
        ], [
            'name.unique' => 'Restaurant sudah ada.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'qty_variasi_makanan.integer' => 'Qty food variaty harus berupa angka.',
            'distance.ends_with'      => 'Format jarak tidak valid harus mengandung KM'
        ]);

        $v_jarak = 0;
        $distance_value = str_replace([' ', 'KM', 'km'], '', $request->distance);

        if($distance_value < 1) {
            $v_jarak = 1;
        } elseif($distance_value >= 1 && $distance_value <= 3) {
            $v_jarak = 2;
        } elseif($distance_value > 3 && $distance_value <= 5) {
            $v_jarak = 3;
        } elseif($distance_value > 5 && $distance_value <= 7) {
            $v_jarak = 4;
        }  elseif($distance_value > 7) {
            $v_jarak = 5;
        }

        $restaurant = Restaurant::find($id);

        $temp = null;
        if ($request->hasFile('image')) {
            $temp = $restaurant->image;
            $originalFileName = time() . str_replace(" ", "",  $request->image->getClientOriginalName());
            $image_path = $request->image->storeAs('public/images/restaurants', $originalFileName);
            $request->image = $originalFileName;
        }
        // $menuData = json_decode($request->input('menuData'), TRUE);
        // $menuData = collect(json_decode($request->input('menuData'), TRUE));

        if ($restaurant->wasChanged('images') && $temp) {
            Storage::delete('public/images/restaurants/'.$temp);
        }

        // $restaurant->facilities()->sync($request->facility_id);

        // $totalPrice = 0;
        // $totalData = count($menuData);

        // if($totalData > 20)
        // {
        //    $v_variasi_menu = 1;
        // } elseif ($totalData >= 15 && $totalData <= 20) {
        //     $v_variasi_menu = 2;
        // } elseif($totalData >=10 && $totalData <= 15) {
        //     $v_variasi_menu = 3;
        // } elseif($totalData >= 5 && $totalData <= 10) {
        //     $v_variasi_menu = 4;
        // } elseif($totalData <= 5) {
        //     $v_variasi_menu = 5;
        // }

        // $existingVariety = FoodVariaty::where('restaurant_id',$restaurant->id)->select('id','name','price')->get();
        // foreach ($existingVariety as $foodVariety) {
        //     if (!$menuData->contains('id', $foodVariety->id)) {
        //         $foodVariety->delete();
        //     }
        // }

        // foreach ($menuData as $menu) {
        //     $name = $menu['name'];
        //     $price = (int) str_replace([",", "."], "", $menu['price']);
        //     $totalPrice += $price;
        //     if($existingVariety->isEmpty()){
        //         FoodVariaty::create([
        //             'restaurant_id' => $restaurant->id,
        //             'name' => $name,
        //             'price' => $price,
        //         ]);
        //     } else {
        //         $existing = $existingVariety->where('id',$menu['id'])->first();
        //         if ($existing) {
        //                 $existing->update([
        //                     'price' => $price,
        //                     'name' => $name,
        //                 ]);
        //         } else {
        //             FoodVariaty::create([
        //                 'restaurant_id' => $restaurant->id,
        //                 'name' => $name,
        //                 'price' => $price,
        //             ]);
        //         }
        //     }

        // }

        // $averagePrice = $totalData > 0 ? $totalPrice / $totalData : 0;
        // $v_harga = 0;
        // switch ($averagePrice) {
        //     case ($averagePrice >= 2000 && $averagePrice < 15000):
        //         $v_harga = 1;
        //         break;
        //     case ($averagePrice >= 15000 && $averagePrice < 25000):
        //         $v_harga = 2;
        //         break;
        //     case ($averagePrice >= 25000):
        //         $v_harga = 3;
        //         break;
        // }
        $restaurant->update([
            'name'      => $request->restaurant_name,
            'distance'  => $request->distance,
            'address'   => $request->address,
            // 'facility'   => $request->facility,
            'images'    => $request->hasFile('image') ? $originalFileName : $restaurant->images,
            'kriteria_fasilitas_id' => $request->kriteria_fasilitas_id,
            'kriteria_jam_operasional_id' => $request->kriteria_jam_operasional_id,
            'kriteria_jarak_id' => $v_jarak,
            'map_link'  => $request->map_link,
            // 'qty_variasi_makanan' => $totalData,
            // 'average' => $averagePrice,
            'variasi_menu_id' => $request->variasi_menu_id,
            'kriteria_harga_id' => $request->kriteria_harga_id,
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
        $getJamOperasional = KategoriJamOperasional::get();
        $getJarak = KriteriaJarak::get();
        $getVariasiMenu = KriteriaVariasiMenu::get();
        $getHarga = KriteriaHarga::get();
        $getFasilitas = KriteriaFasilitas::get();
        return view('pages.restaurant.search',compact('page','facilities','getJamOperasional','getJarak','getVariasiMenu','getHarga','getFasilitas'));
    }

    public function searchRestaurant()
    {
        $getJamOperasional = KategoriJamOperasional::get();
        $getJarak = KriteriaJarak::get();
        $getVariasiMenu = KriteriaVariasiMenu::get();
        $getHarga = KriteriaHarga::get();
        $facilities = Facility::get();
        $getJamOperasional = KategoriJamOperasional::get();
        $getFasilitas = KriteriaFasilitas::get();
        return view('pages.frontend.home.search-restaurant',compact('getJamOperasional','getJarak','getVariasiMenu','getHarga','facilities','getJamOperasional','getFasilitas'));
    }

    public function filter(Request $request)
    {
        $maxQty = $request->input('variasi_menu');
        $jarak = $request->input('jarak');
        $harga = $request->input('harga');
        $jam_operasional = $request->input('jam_operasional');
        $fasilitas = $request->input('fasilitas');
        // $selectedFacilities = $request->input('facility_id', []);

        $data = Restaurant::where(function($query) use ($jarak, $harga, $maxQty, $jam_operasional, $fasilitas) {
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
            ->where(function($query) use ($jam_operasional) {
                if ($jam_operasional == 5) {
                    $query->where('kriteria_jam_operasional_id', 5);
                } elseif ($jam_operasional == 4) {
                    $query->where('kriteria_jam_operasional_id',4);
                } elseif ($jam_operasional == 3) {
                    $query->where('kriteria_jam_operasional_id', 3);
                } elseif ($jam_operasional == 2) {
                    $query->where('kriteria_jam_operasional_id', 2);
                } elseif ($jam_operasional == 1) {
                    $query->where('kriteria_jam_operasional_id',1);
                }
            })
            ->where(function($query) use ($fasilitas) {
                if ($fasilitas == 5) {
                    $query->where('kriteria_fasilitas_id', 5);
                } elseif ($fasilitas == 4) {
                    $query->where('kriteria_fasilitas_id',4);
                } elseif ($fasilitas == 3) {
                    $query->where('kriteria_fasilitas_id', 3);
                } elseif ($fasilitas == 2) {
                    $query->where('kriteria_fasilitas_id', 2);
                } elseif ($fasilitas == 1) {
                    $query->where('kriteria_fasilitas_id',1);
                }
            })
            ->where(function($query) use ($harga) {
                if ($harga == 1) {
                    $query->where('kriteria_harga_id', 1);
                }  elseif ($harga == 2) {
                    $query->where('kriteria_harga_id', 2);
                } elseif ($harga == 3) {
                    $query->where('kriteria_harga_id',3);
                }
            });
        })
        // ->when(!empty($selectedFacilities), function ($query) use ($selectedFacilities) {
        //     $query->whereHas('facilities', function ($query) use ($selectedFacilities) {
        //         $query->whereIn('facilities.id', $selectedFacilities);
        //     });
        // })
        ->get();
        if(count($data) != 0){
            $alternatif_hasil = [];
            $sum_v_harga_makanan = [];
            $sum_v_variasi_makanan = [];
            $sum_v_jam_operasional = [];
            $sum_v_jarak = [];
            $sum_v_fasilitas = [];
            $bobot_v_harga = 0;
            $bobot_v_jarak = 0;
            $bobot_v_jam_operasional = 0;
            $bobot_v_variasi = 0;
            $bobot_v_fasilitas = 0;

            foreach ($data as $item) {
                // $v_harga_makanan = 1 / $item->v_harga_makanan;
                // $v_variasi_makanan = 5 / $item->v_variasi_makanan;
                // $v_jam_operasional = 5 / $item->v_jam_operasional;
                // $v_jarak = 1 / $item->v_jarak;
                // $v_fasilitas = 1 / $item->v_fasilitas;

                $v_harga_makanan = round($item->harga->value, 2);
                $sum_v_harga_makanan[] = $v_harga_makanan;

                $v_variasi_makanan = round($item->variasiMenu->value, 2);
                $sum_v_variasi_makanan[] = $v_variasi_makanan;

                $v_jam_operasional = round($item->jamOperasional->value, 2);
                $sum_v_jam_operasional[] = $v_jam_operasional;

                $v_jarak = round($item->jarak->value, 2);
                $sum_v_jarak[] = $v_jarak;

                $v_fasilitas = round($item->fasilitas->value, 2);
                $sum_v_fasilitas[] = $v_fasilitas;
            }

            $min_v_harga_makanan = min($sum_v_harga_makanan);
            $min_v_jarak = min($sum_v_jarak);
            $max_v_fasilitas = max($sum_v_fasilitas);
            $max_v_jam_operasional = max($sum_v_jam_operasional);
            $max_v_variasi_makanan = max($sum_v_variasi_makanan);

            foreach ($data as $item) {
                $bobotKriteria = BobotKriteria::first();
                $b_harga_makanan = $bobotKriteria->bobot_harga_makanan / 100;
                $b_jarak = $bobotKriteria->bobot_jarak / 100;
                $b_fasilitas = $bobotKriteria->bobot_fasilitas / 100;
                $b_jam_operasional = $bobotKriteria->bobot_jam_operasional / 100;
                $b_variasi_menu = $bobotKriteria->bobot_variasi_menu / 100;

                $v_harga_makanan = $min_v_harga_makanan / $item->harga->value;
                $v_jarak = $min_v_jarak / $item->jarak->value;
                $v_fasilitas = $item->fasilitas->value / $max_v_fasilitas;
                $v_jam_operasional = $item->jamOperasional->value / $max_v_jam_operasional;
                $v_variasi_makanan =  $item->variasiMenu->value / $max_v_variasi_makanan;

                $bobot_v_harga =  round($v_harga_makanan,2) * number_format($b_harga_makanan,2);
                $bobot_v_variasi = round($v_variasi_makanan,2) * number_format($b_variasi_menu,2);
                $bobot_v_jam_operasional = round($v_jam_operasional,2) * number_format($b_jam_operasional,2);
                $bobot_v_jarak = round($v_jarak,2) * number_format($b_jam_operasional,2);
                $bobot_v_fasilitas = round($v_fasilitas,2) * number_format($b_fasilitas,2);


                // $v_bobot_jarak += round($v_jarak,2);
                // $value_jarak = round($v_jarak,2) / $v_bobot_jarak;
                // $jumlah = round($v_harga_makanan, 2) + round($v_variasi_makanan, 2) + round($v_jam_operasional, 2) + round($v_jarak, 2) + round($v_fasilitas, 2);
                $jumlah = round($bobot_v_harga, 2) + round($bobot_v_variasi, 2) + round($bobot_v_jam_operasional, 2) + round($bobot_v_jarak, 2) + round($bobot_v_fasilitas, 2);

                $alternatif_hasil[] = [
                    'alternatif' => $item,
                    'v_harga_makanan' => round($bobot_v_harga,2),
                    'v_variasi_makanan' => round($bobot_v_variasi,2),
                    'v_jam_operasional'    => round($bobot_v_jam_operasional,2),
                    'v_jarak'           => round($bobot_v_jarak,2),
                    'v_fasilitas'       => round($bobot_v_fasilitas,2),
                    'jumlah_nilai'      => round($jumlah,2),
                ];
            }
            usort($alternatif_hasil, function ($a, $b) {
                if ($a['jumlah_nilai'] == $b['jumlah_nilai']) {
                    return strcasecmp($a['alternatif']->name, $b['alternatif']->name);
                }

                return $b['jumlah_nilai'] <=> $a['jumlah_nilai'];
            });
            return response()->json([
                'success' => true,
                'message' => 'Data restaurants ditemukan',
                'alternatif_hasil' => $alternatif_hasil
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }


    public function commentRestaurant(Request $request, $id)
    {
        $page = 'restaurants';
        $data = Comment::where('restaurant_id',$id)->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('content', function ($row) {
                    return $row->content;
                })
                ->addColumn('user', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('rating', function ($row) {
                    $starHtml = '';
                    $maxRating = 5;
                    $starColor = '#ffcd3c';
                    $emptyStarColor = '#ddd';

                    for ($i = 0; $i < $row->star_rating; $i++) {
                        $starHtml .= '<i class="fa fa-star fa-xs" style="color: ' . $starColor . '; font-size: 16px" aria-hidden="true"></i>';
                    }
                    for ($i = $row->star_rating; $i < $maxRating; $i++) {
                        $starHtml .= '<i class="fa fa-star fa-xs" style="color: ' . $emptyStarColor . '; font-size: 16px" aria-hidden="true"></i>';
                    }

                    return $starHtml;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .=
                        '<button class="btn btn-sm btn-danger" href="#" onclick="deleteDetail(this)" data-name="' .
                        $row->name .
                        '" data-id="' .
                        $row->id .
                        '">
                            <span class="btn-inner--icon"><i class="fas fa-trash-alt text-white"></i></span>
                        </button>';
                    return $btn;
                })
                ->rawColumns(['rating','action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function destroyComment(int $id)
    {
        $data = Comment::find($id);

        if($data)
        {
            $data->delete();
            return response()->json([
               'success'   => true,
                'message'  => "Comment berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success'   => false,
                 'message'  => "Comment gagal dihapus"
             ]);
        }
    }


    public function rankingRestaurants(Request $request)
    {
        $page = 'restaurants';

        $data = Restaurant::get();
        $alternatif_hasil = [];
        $sum_v_harga_makanan = [];
        $sum_v_variasi_makanan = [];
        $sum_v_jam_operasional = [];
        $sum_v_jarak = [];
        $sum_v_fasilitas = [];
        $bobot_v_harga = 0;
        $bobot_v_jarak = 0;
        $bobot_v_jam_operasional = 0;
        $bobot_v_variasi = 0;
        $bobot_v_fasilitas = 0;

        foreach ($data as $item) {
            // $v_harga_makanan = 1 / $item->v_harga_makanan;
            // $v_variasi_makanan = 5 / $item->v_variasi_makanan;
            // $v_jam_operasional = 5 / $item->v_jam_operasional;
            // $v_jarak = 1 / $item->v_jarak;
            // $v_fasilitas = 1 / $item->v_fasilitas;

            $v_harga_makanan = round($item->harga->value, 2);
            $sum_v_harga_makanan[] = $v_harga_makanan;

            $v_variasi_makanan = round($item->variasiMenu->value, 2);
            $sum_v_variasi_makanan[] = $v_variasi_makanan;

            $v_jam_operasional = round($item->jamOperasional->value, 2);
            $sum_v_jam_operasional[] = $v_jam_operasional;

            $v_jarak = round($item->jarak->value, 2);
            $sum_v_jarak[] = $v_jarak;

            $v_fasilitas = round($item->fasilitas->value, 2);
            $sum_v_fasilitas[] = $v_fasilitas;
        }

        $min_v_harga_makanan = min($sum_v_harga_makanan);
        $min_v_jarak = min($sum_v_jarak);
        $max_v_fasilitas = max($sum_v_fasilitas);
        $max_v_jam_operasional = max($sum_v_jam_operasional);
        $max_v_variasi_makanan = max($sum_v_variasi_makanan);

        foreach ($data as $item) {
            $bobotKriteria = BobotKriteria::first();
            $b_harga_makanan = $bobotKriteria->bobot_harga_makanan / 100;
            $b_jarak = $bobotKriteria->bobot_jarak / 100;
            $b_fasilitas = $bobotKriteria->bobot_fasilitas / 100;
            $b_jam_operasional = $bobotKriteria->bobot_jam_operasional / 100;
            $b_variasi_menu = $bobotKriteria->bobot_variasi_menu / 100;

            $v_harga_makanan = $min_v_harga_makanan / $item->harga->value;
            $v_jarak = $min_v_jarak / $item->jarak->value;
            $v_fasilitas = $item->fasilitas->value / $max_v_fasilitas;
            $v_jam_operasional = $item->jamOperasional->value / $max_v_jam_operasional;
            $v_variasi_makanan =  $item->variasiMenu->value / $max_v_variasi_makanan;

            $bobot_v_harga =  round($v_harga_makanan,2) * number_format($b_harga_makanan,2);
            $bobot_v_variasi = round($v_variasi_makanan,2) * number_format($b_variasi_menu,2);
            $bobot_v_jam_operasional = round($v_jam_operasional,2) * number_format($b_jam_operasional,2);
            $bobot_v_jarak = round($v_jarak,2) * number_format($b_jam_operasional,2);
            $bobot_v_fasilitas = round($v_fasilitas,2) * number_format($b_fasilitas,2);


            // $v_bobot_jarak += round($v_jarak,2);
            // $value_jarak = round($v_jarak,2) / $v_bobot_jarak;
            // $jumlah = round($v_harga_makanan, 2) + round($v_variasi_makanan, 2) + round($v_jam_operasional, 2) + round($v_jarak, 2) + round($v_fasilitas, 2);
            $jumlah = round($bobot_v_harga, 2) + round($bobot_v_variasi, 2) + round($bobot_v_jam_operasional, 2) + round($bobot_v_jarak, 2) + round($bobot_v_fasilitas, 2);

            $alternatif_hasil[] = [
                'alternatif' => $item,
                'v_harga_makanan' => $bobot_v_harga,
                'v_variasi_makanan' => $bobot_v_variasi,
                'v_jam_operasional'    => $bobot_v_jam_operasional,
                'v_jarak'           => $bobot_v_jarak,
                'v_fasilitas'       => $bobot_v_fasilitas,
                'jumlah_nilai'      => $jumlah,
            ];
        }
        usort($alternatif_hasil, function ($a, $b) {
            if ($a['jumlah_nilai'] == $b['jumlah_nilai']) {
                return strcasecmp($a['alternatif']->name, $b['alternatif']->name);
            }

            return $b['jumlah_nilai'] <=> $a['jumlah_nilai'];
        });

        if ($request->ajax()) {
            return DataTables::of($alternatif_hasil)
                ->addColumn('name', function ($row) {
                    return '<a href="'.route('detail.restaurant', $row['alternatif']->id).'">'.$row['alternatif']->name.'</a>';
                })
                ->addColumn('v_harga_makanan', function ($row) {
                    return round($row['v_harga_makanan'],2);
                  })
                  ->addColumn('v_jarak', function ($row) {
                      return round($row['v_jarak'],2);
                  })
                  ->addColumn('v_fasilitas', function ($row) {
                      return round($row['v_fasilitas'],2);
                  })
                  ->addColumn('v_jam_operasional', function ($row) {
                      return round($row['v_jam_operasional'],2);
                  })
                  ->addColumn('v_variasi_makanan', function ($row) {
                      return round($row['v_variasi_makanan'],2);
                  })
                  ->addColumn('jumlah', function ($row) {
                    return round($row['jumlah_nilai'],2);
                  })
                ->addIndexColumn()
                ->rawColumns(['name'])
                ->make(true);
        }

        return view('pages.frontend.home.ranking-restaurants',compact('page'));
    }
}
