<?php

namespace App\Http\Controllers;

use App\Models\{Alternatif,Restaurant};
use Illuminate\Http\Request;
use DataTables;

class AlternatifController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-alternatif|create-alternatif|edit-alternatif|delete-alternatif', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-alternatif', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-alternatif', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-alternatif', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'alternatif';
        $data = Alternatif::orderBy('created_at')->get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('restaurant', function ($row) {
                    return $row->restaurant->name;
                })
                ->addColumn('v_harga_makanan', function ($row) {
                    return $row->v_harga_makanan;
                })
                ->addColumn('v_variasi_makan', function ($row) {
                    return $row->v_variasi_makan;
                })
                ->addColumn('v_rasa_makanan', function ($row) {
                    return $row->v_rasa_makanan;
                })
                ->addColumn('v_jarak', function ($row) {
                    return $row->v_jarak;
                })
                ->addColumn('v_fasilitas', function ($row) {
                    return $row->v_fasilitas;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    if ($auth->can('edit-alternatif')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="'.route('alternatif.edit',$row->id).'" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    }
                    if ($auth->can('delete-alternatif')) {
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
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }
            return view('pages.alternatif.index', compact('page'));
    }

    public function create()
    {
        $page = 'alternatif';
        return view('pages.alternatif.create',compact('page'));
    }

    public function store(Request $request)
    {
       $validated =  $this->validate($request,[
            'restaurant_id'      => 'required|unique:alternatifs,restaurant_id',
            'v_harga_makanan'    => 'required',
            'v_variasi_makanan'  => 'required',
            'v_rasa_makanan'     => 'required',
            'v_jarak'            => 'required',
            'v_fasilitas'        => 'required',
        ],[
            'restaurant_id.required'    => 'Restaurant harus diisi.',
            'restaurant_id.unique'      => 'Restaurant sudah ada.',
            'v_jarak'                   => 'Value jarak harus diisi.',
            'v_harga_makanan'           => 'Value harga makanan harus diisi.',
            'v_variasi_makanan'         => 'Value variasi makanan harus diisi.',
            'v_fasilitas'               => 'Value fasilitas harus diisi.',
            'v_rasa_makanan'             => 'Value rasa makanan harus diisi.',
        ]);
        // dd($request->all());
        $data = Alternatif::create($validated);

        if($data){
            return response()->json([
                'success'   => true,
                'message'   => 'Data berhasil ditambahkan'
            ]);
        }else{
            return response()->json([
                'success'   => fasle,
                'message'   => 'Data gagal ditambahkan'
            ]);
        }
    }

    public function edit(Alternatif $alternatif)
    {
        $page = 'alternatif';
        $restaurant = Restaurant::get();
        $data = Alternatif::findOrFail($alternatif->id);
        return view('pages.alternatif.edit',compact('data', 'restaurant', 'page'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $validated = $this->validate($request,[
            'restaurant_id'      => 'nullable|unique:alternatifs,restaurant_id,'.$alternatif->id,
            'v_harga_makanan'    => 'nullable',
            'v_variasi_makanan'  => 'nullable',
            'v_rasa_makanan'     => 'nullable',
            'v_jarak'            => 'nullable',
            'v_fasilitas'        => 'nullable',
        ],[
            'restaurant_id.required'    => 'Restaurant harus diisi.',
            'restaurant_id.unique'      => 'Restaurant sudah ada.',
            'v_jarak'                   => 'Value jarak harus diisi.',
            'v_harga_makanan'           => 'Value harga makanan harus diisi.',
            'v_variasi_makanan'         => 'Value variasi makanan harus diisi.',
            'v_fasilitas'               => 'Value fasilitas harus diisi.',
            'v_rasa_makanan'             => 'Value rasa makanan harus diisi.',
        ]);

        $alternatif->update($validated);

        if($alternatif){
            return response()->json([
                'success'   => true,
                'message'   => 'Data berhasil diupdate'
            ]);
        }else{
            return response()->json([
                'success'   => fasle,
                'message'   => 'Data gagal diupdate'
            ]);
        }
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return response()->json([
            'success'   => true,
            'message'  => "Data berhasil dihapus"
        ]);
    }

    public function perhitunganSaw(Request $request)
    {
        $page = 'alternatif';
        $data = Alternatif::orderBy('created_at')->get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('restaurant', function ($row) {
                    return $row->restaurant->name;
                })
                ->addColumn('v_harga_makanan', function ($row) {
                    if ($row->v_harga_makanan != 0) {
                        $v_harga_makanan =  1 / $row->v_harga_makanan;
                         return round($v_harga_makanan,2);
                     }
                })
                ->addColumn('v_variasi_makan', function ($row) {
                    if ($row->v_variasi_makanan != 0) {
                        $v_variasi_makanan = 5 / $row->v_variasi_makanan;
                        return round($v_variasi_makanan,2);
                    }
                })
                ->addColumn('v_rasa_makanan', function ($row) {
                    if ($row->v_rasa_makanan != 0) {
                        $v_rasa_makanan =  5 / $row->v_rasa_makanan;
                        return round($v_rasa_makanan,2);
                    }
                })
                ->addColumn('v_jarak', function ($row) {
                    if ($row->v_jarak != 0) {
                       $v_jarak =  1 / $row->v_jarak;
                        return round($v_jarak,2);
                    }
                })
                ->addColumn('v_fasilitas', function ($row) {
                    if ($row->v_fasilitas != 0) {
                        $v_fasilitas =  1 / $row->v_fasilitas;
                         return round($v_fasilitas,2);
                    }
                })
                ->addIndexColumn()
                ->make(true);
            }
            return view('pages.alternatif.perhitungan_saw', compact('page'));
    }

    public function normalisasiAlternatif(Request $request)
    {
        $page = 'alternatif';
        $data = Alternatif::orderBy('created_at')->get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('restaurant', function ($row) {
                    return $row->restaurant->name;
                })
                ->addColumn('v_harga_makanan', function ($row) {
                    if ($row->v_harga_makanan != 0) {
                        $v_harga_makanan =  1 / $row->v_harga_makanan;
                        return '1 / ' . $row->v_harga_makanan . ' = '.  round($v_harga_makanan,2);
                    }
                })
                ->addColumn('variasi_makanan', function ($row) {
                    if ($row->v_variasi_makanan != 0) {
                        $v_variasi_makanan = 5 / $row->v_variasi_makanan;
                        return '5 / '. $row->v_variasi_makanan. ' = '.round($v_variasi_makanan,2);
                    }
                })
                ->addColumn('v_rasa_makanan', function ($row) {
                    if ($row->v_rasa_makanan != 0) {
                        $v_rasa_makanan =  5 / $row->v_rasa_makanan;
                        return '5 / '. $row->v_rasa_makanan. ' = '.round($v_rasa_makanan,2);
                    }
                })
                ->addColumn('v_jarak', function ($row) {
                    if ($row->v_jarak != 0) {
                        $v_jarak =  1 / $row->v_jarak;
                        return '1 / '. $row->v_jarak .' = '.round($v_jarak,2);
                    }
                })
                ->addColumn('v_fasilitas', function ($row) {
                    if ($row->v_fasilitas != 0) {
                        $v_fasilitas =  1 / $row->v_fasilitas;
                        return '1 / '. $row->v_fasilitas.' = '.round($v_fasilitas,2);
                    }
                })
                ->addIndexColumn()
                ->make(true);
            }
    }

    public function dataRanking(Request $request)
    {
        $page = 'alternatif';
        $data = Alternatif::get();
        $alternatif_hasil = [];

        foreach ($data as $item) {
            $v_harga_makanan = 1 / $item->v_harga_makanan;
            $v_variasi_makanan = 5 / $item->v_variasi_makanan;
            $v_rasa_makanan = 5 / $item->v_rasa_makanan;
            $v_jarak = 1 / $item->v_jarak;
            $v_fasilitas = 1 / $item->v_fasilitas;

            $jumlah = round($v_harga_makanan, 2) + round($v_variasi_makanan, 2) + round($v_rasa_makanan, 2) + round($v_jarak, 2) + round($v_fasilitas, 2);

            $alternatif_hasil[] = [
                'alternatif' => $item,
                'jumlah_nilai' => $jumlah
            ];
        }

        usort($alternatif_hasil, function ($a, $b) {
            return $b['jumlah_nilai'] <=> $a['jumlah_nilai'];
        });
        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($alternatif_hasil)
                ->addColumn('restaurant', function ($row) {
                    return isset($row['alternatif']->restaurant->name) ? $row['alternatif']->restaurant->name : null;
                })
                ->addColumn('v_harga_makanan', function ($row) {
                    return isset($row['alternatif']->v_harga_makanan) && $row['alternatif']->v_harga_makanan != 0 ? round(1 / $row['alternatif']->v_harga_makanan, 2) : null;
                })
                ->addColumn('v_variasi_makanan', function ($row) {
                    return isset($row['alternatif']->v_variasi_makanan) && $row['alternatif']->v_variasi_makanan != 0 ? round(5 / $row['alternatif']->v_variasi_makanan, 2) : null;
                })
                ->addColumn('v_rasa_makanan', function ($row) {
                    return isset($row['alternatif']->v_rasa_makanan) && $row['alternatif']->v_rasa_makanan != 0 ? round(5 / $row['alternatif']->v_rasa_makanan, 2) : null;
                })
                ->addColumn('v_jarak', function ($row) {
                    return isset($row['alternatif']->v_jarak) && $row['alternatif']->v_jarak != 0 ? round(1 / $row['alternatif']->v_jarak, 2) : null;
                })
                ->addColumn('v_fasilitas', function ($row) {
                    return isset($row['alternatif']->v_fasilitas) && $row['alternatif']->v_fasilitas != 0 ? round(1 / $row['alternatif']->v_fasilitas, 2) : null;
                })
                ->addColumn('jumlah', function ($row) {
                    return isset($row['jumlah_nilai']) && $row['jumlah_nilai'] != 0 ? round($row['jumlah_nilai'], 2) : null;
                })
                ->addIndexColumn()
                ->make(true);
        }
    }
}
