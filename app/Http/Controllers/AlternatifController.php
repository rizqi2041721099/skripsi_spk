<?php

namespace App\Http\Controllers;

use App\Models\{Alternatif,Restaurant,BobotKriteria};
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
        $data = Restaurant::orderBy('name')->get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('restaurant', function ($row) {
                    return $row->name;
                })
                ->addColumn('v_harga_makanan', function ($row) {
                    return $row->harga->value;
                })
                ->addColumn('v_jarak', function ($row) {
                    return $row->jarak->value;
                })
                ->addColumn('v_fasilitas', function ($row) {
                    return $row->fasilitas->value;
                })
                ->addColumn('v_jam_operasional', function ($row) {
                    return $row->jamOperasional->value;
                })
                ->addColumn('v_variasi_makan', function ($row) {
                    return $row->variasiMenu->value;
                })
                // ->addColumn('action', function ($row)use($auth) {
                //     $btn = '';
                //     if ($auth->can('edit-alternatif')) {
                //         $btn .= '&nbsp;&nbsp';
                //         $btn .=   '<a href="'.route('alternatif.edit',$row->id).'" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                //                 <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                //                 </a>';
                //     }
                //     if ($auth->can('delete-alternatif')) {
                //         $btn .= '&nbsp;&nbsp';
                //         $btn .=
                //             '<a class="btn btn-icon btn-danger btn-icon-only" href="#" onclick="deleteItem(this)" data-name="' .
                //             $row->name .
                //             '" data-id="' .
                //             $row->id .
                //             '">
                //                 <span class="btn-inner--icon"><i class="fas fa-trash-alt text-white"></i></span>
                //             </a>';
                //     }

                //     return $btn;
                // })
                // ->rawColumns(['action'])
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
            'v_jam_operasional'     => 'required',
            'v_jarak'            => 'required',
            'v_fasilitas'        => 'required',
        ],[
            'restaurant_id.required'    => 'Restaurant harus diisi.',
            'restaurant_id.unique'      => 'Restaurant sudah ada.',
            'v_jarak'                   => 'Value jarak harus diisi.',
            'v_harga_makanan'           => 'Value harga makanan harus diisi.',
            'v_variasi_makanan'         => 'Value variasi makanan harus diisi.',
            'v_fasilitas'               => 'Value fasilitas harus diisi.',
            'v_jam_operasional'         => 'Value jam operasional harus diisi.',
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
            'v_jam_operasional'     => 'nullable',
            'v_jarak'            => 'nullable',
            'v_fasilitas'        => 'nullable',
        ],[
            'restaurant_id.required'    => 'Restaurant harus diisi.',
            'restaurant_id.unique'      => 'Restaurant sudah ada.',
            'v_jarak'                   => 'Value jarak harus diisi.',
            'v_harga_makanan'           => 'Value harga makanan harus diisi.',
            'v_variasi_makanan'         => 'Value variasi makanan harus diisi.',
            'v_fasilitas'               => 'Value fasilitas harus diisi.',
            'v_jam_operasional'         => 'Value jam operasional harus diisi.',
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
        $data = Restaurant::orderBy('name')->get();

        $auth  = auth()->user();
        $alternatif_hasil = [];
        $sum_v_harga_makanan = [];
        $sum_v_variasi_makanan = [];
        $sum_v_jam_operasional = [];
        $sum_v_jarak = [];
        $sum_v_fasilitas = [];

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

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('restaurant', function ($row) {
                    return $row->name;
                })
                ->addColumn('v_harga_makanan', function ($row) use ($min_v_harga_makanan) {
                    $v_harga_makanan = $min_v_harga_makanan / $row->harga->value;
                    return round($v_harga_makanan,2);
                })
                ->addColumn('v_jarak', function ($row) use ($min_v_jarak){
                    $v_jarak = $min_v_jarak / $row->jarak->value;
                    return round($v_jarak,2);
                })
                ->addColumn('v_fasilitas', function ($row) use ($max_v_fasilitas) {
                    $v_fasilitas = $row->fasilitas->value / $max_v_fasilitas;
                    return round($v_fasilitas,2);
                })
                ->addColumn('v_jam_operasional', function ($row) use ($max_v_jam_operasional) {
                    $v_jam_operasional = $row->jamOperasional->value / $max_v_jam_operasional;
                    return round($v_jam_operasional,2);
                })
                ->addColumn('v_variasi_makan', function ($row) use ($max_v_variasi_makanan) {
                    $v_variasi_makanan =  $row->variasiMenu->value / $max_v_variasi_makanan ;
                    return round($v_variasi_makanan,2);
                })
                ->addIndexColumn()
                ->make(true);
            }
            return view('pages.alternatif.perhitungan_saw', compact('page','min_v_harga_makanan','min_v_jarak','max_v_fasilitas','max_v_jam_operasional','max_v_variasi_makanan'));
    }

    public function normalisasiAlternatif(Request $request)
    {
        $page = 'alternatif';
        $data = Restaurant::orderBy('name')->get();

        $auth  = auth()->user();
        $alternatif_hasil = [];
        $sum_v_harga_makanan = [];
        $sum_v_variasi_makanan = [];
        $sum_v_jam_operasional = [];
        $sum_v_jarak = [];
        $sum_v_fasilitas = [];

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
        // dd(['min '.min($min_v_harga_makanan),$sum_v_harga_makanan]);
        // foreach ($data as $item) {
        //     $v_harga_makanan = 1 / $item->v_harga_makanan;
        //     $v_jarak = 1 / $item->v_jarak;
        //     $v_fasilitas = 5 / $item->v_fasilitas;
        //     $v_jam_operasional = 5 / $item->v_jam_operasional;
        //     $v_variasi_makanan = 5 / $item->v_variasi_makanan;

        //     $v_harga = $min_v_harga_makanan != 0 ?   $min_v_harga_makanan / round($v_harga_makanan,2)  : 0;
        //     $v_jarak = $min_v_jarak != 0 ?  $min_v_jarak / round($v_jarak,2) : 0;
        //     $v_fasilitas = $max_v_fasilitas != 0 ? round($v_fasilitas,2) / $max_v_fasilitas : 0;
        //     $v_rasa = $max_v_jam_operasional != 0 ? round($v_jam_operasional,2) / $max_v_jam_operasional : 0;
        //     $v_variasi = $max_v_variasi_makanan != 0 ? round($v_variasi_makanan,2) / $max_v_variasi_makanan : 0;

        //     $alternatif_hasil[] = [
        //         'alternatif' => $item,
        //         'v_harga_makanan'   =>  round($v_harga,2),
        //         'v_variasi_makanan' => round($v_variasi,2),
        //         'v_jam_operasional'    => round($v_rasa,2),
        //         'v_jarak'           => round($v_jarak,2),
        //         'v_fasilitas'       => round($v_fasilitas,2),
        //     ];
        // }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('restaurant', function ($row) {
                    return $row->name;
                })
                ->addColumn('v_harga_makanan', function ($row) use ($min_v_harga_makanan) {
                    $v_harga_makanan = $min_v_harga_makanan / $row->harga->value;
                    return $min_v_harga_makanan.' / '.$row->harga->value.' = '.round($v_harga_makanan,2);
                })
                ->addColumn('v_jarak', function ($row) use ($min_v_jarak){
                    $v_jarak = $min_v_jarak / $row->jarak->value;
                    return $min_v_jarak.' / '.$row->jarak->value.' = '.round($v_jarak,2);
                })
                ->addColumn('v_fasilitas', function ($row) use ($max_v_fasilitas) {
                    $v_fasilitas = $row->fasilitas->value / $max_v_fasilitas;
                    return $row->fasilitas->value.' / '.$max_v_fasilitas.' = '.round($v_fasilitas,2);
                })
                ->addColumn('v_jam_operasional', function ($row) use ($max_v_jam_operasional) {
                    $v_jam_operasional = $row->jamOperasional->value / $max_v_jam_operasional;
                    return $row->jamOperasional->value.' / '.$max_v_jam_operasional.' = '.round($v_jam_operasional,2);
                })
                ->addColumn('variasi_makanan', function ($row) use ($max_v_variasi_makanan) {
                    $v_variasi_makanan =  $row->variasiMenu->value / $max_v_variasi_makanan ;
                    return $row->variasiMenu->value.' / '.$max_v_variasi_makanan.' = '.round($v_variasi_makanan,2);
                })
                ->addIndexColumn()
                ->make(true);
            }
    }

    public function dataRanking(Request $request)
    {
        $page = 'alternatif';
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
        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($alternatif_hasil)
                ->addColumn('restaurant', function ($row) {
                    return $row['alternatif']->name;
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
                    // return isset($row['jumlah_nilai']) && $row['jumlah_nilai'] != 0 ? round($row['jumlah_nilai'], 2) : null;
                })
                ->addIndexColumn()
                ->make(true);
        }
    }
}
