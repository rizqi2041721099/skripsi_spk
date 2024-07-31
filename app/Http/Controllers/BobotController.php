<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotKriteria;
use DataTables;

class BobotController extends Controller
{
    public function index(Request $request)
    {
        $page = 'master';
        $data = BobotKriteria::orderBy('created_at')->get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('b_harga_makanan', function ($row) {
                    return $row->bobot_harga_makanan.'%';
                })
                ->addColumn('b_jarak', function ($row) {
                    return $row->bobot_jarak.'%';
                })
                ->addColumn('b_fasilitas', function ($row) {
                    return $row->bobot_fasilitas.'%';
                })
                ->addColumn('b_jam_operasional', function ($row) {
                    return $row->bobot_jam_operasional.'%';
                })
                ->addColumn('b_variasi_menu', function ($row) {
                    return $row->bobot_variasi_menu.'%';
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    $btn .= '&nbsp;&nbsp';
                    $btn .=   '<a href="javascript:void(0)" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                            <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                            </a>';
                    // $btn .= '&nbsp;&nbsp';
                    // $btn .=
                    //     '<a class="btn btn-icon btn-danger btn-icon-only" href="#" onclick="deleteItem(this)" data-name="' .
                    //     $row->name .
                    //     '" data-id="' .
                    //     $row->id .
                    //     '">
                    //         <span class="btn-inner--icon"><i class="fas fa-trash-alt text-white"></i></span>
                    //     </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.bobot-kriteria.index', compact('page'));
    }

    public function create()
    {
        $page = 'master';
        return view('pages.kriterias.bobot-kriteria',compact('page'));
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'bobot_harga_makanan' => 'required|numeric|between:0,100',
            'bobot_jarak'         => 'required|numeric|between:0,100',
            'bobot_fasilitas'     => 'required|numeric|between:0,100',
            'bobot_jam_operasional'  => 'required|numeric|between:0,100',
            'bobot_variasi_menu'  => 'required|numeric|between:0,100',
        ]);

        $b_harga_makanan =$request->bobot_harga_makanan / 100;
        $b_jarak =$request->bobot_jarak / 100;
        $b_fasilitas =$request->bobot_fasilitas / 100;
        $b_jam_operasional =$request->bobot_jam_operasional / 100;
        $b_variasi_menu =$request->bobot_variasi_menu / 100;

        $sum = $b_harga_makanan + $b_jarak + $b_fasilitas + $b_jam_operasional + $b_variasi_menu;
        if($sum != 1.0){
            return response()->json([
                'success'   => false,
                'message'   => 'Total bobot harus 100%'
            ]);
        } else {
            $data = BobotKriteria::create($validated);
            return response()->json([
                'success'   => true,
                'message'   => 'Data berhasil ditambahkan'
            ]);
        }
    }

    public function show(int $id)
    {
    }

    public function edit(int $id)
    {
        $data = BobotKriteria::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, int $id)
    {
        $validated = $this->validate($request,[
            'bobot_harga_makanan' => 'required|numeric|between:0,100',
            'bobot_jarak'         => 'required|numeric|between:0,100',
            'bobot_fasilitas'     => 'required|numeric|between:0,100',
            'bobot_jam_operasional'  => 'required|numeric|between:0,100',
            'bobot_variasi_menu'  => 'required|numeric|between:0,100',
        ]);

        $b_harga_makanan =$request->bobot_harga_makanan / 100;
        $b_jarak =$request->bobot_jarak / 100;
        $b_fasilitas =$request->bobot_fasilitas / 100;
        $b_jam_operasional =$request->bobot_jam_operasional / 100;
        $b_variasi_menu =$request->bobot_variasi_menu / 100;

        $sum = $b_harga_makanan + $b_jarak + $b_fasilitas + $b_jam_operasional + $b_variasi_menu;

        if($sum != 1.0){
            return response()->json([
                'success'   => false,
                'message'   => 'Total bobot harus 100%'
            ]);
        } else {
            $data = BobotKriteria::findOrFail($id)->update($validated);
            return response()->json([
                'success'   => true,
                'message'   => 'Data berhasil ditambahkan'
            ]);
        }
    }

    public function destroy(int $id)
    {
        $data = BobotKriteria::findOrFail($id);

        if($data) {
            $data->delete();
            return response()->json([
                'success'   => true,
                'message'  => "Data berhasil dihapus"
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'  => "Data gagal dihapus"
            ]);
        }
    }
}
