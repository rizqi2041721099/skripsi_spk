<?php

namespace App\Http\Controllers;

use App\Models\KriteriaFasilitas;
use Illuminate\Http\Request;
use DataTables;

class KriteriaFasilitasController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-kriteria-fasilitas|create-kriteria-fasilitas|edit-kriteria-fasilitas|delete-kriteria-fasilitas', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-kriteria-fasilitas', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kriteria-fasilitas', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kriteria-fasilitas', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'kriteria';

        $data = KriteriaFasilitas::get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('value', function ($row) {
                    return $row->value;
                })
                ->addColumn('skala', function ($row) {
                    return $row->skala;
                })
                ->addColumn('standard_value', function ($row) {
                    return $row->standard_value;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    if ($auth->can('edit-kriteria-fasilitas')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="javascript:void(0)" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    }
                    if ($auth->can('delete-kriteria-fasilitas')) {
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
        return view('pages.kriteria-fasilitas.index', compact('page'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'value' => 'required',
            'skala' => 'required',
            'standard_value' => 'required',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'skala.required' => 'Skala harus diisi.',
            'standard_value.required' => 'Standar nilai harus diisi',
        ]);

        $data = KriteriaFasilitas::create($validated);

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

    public function show(KriteriaFasilitas $kriteriaFasilitas)
    {
    }

    public function edit(int $id)
    {
        $data = KriteriaFasilitas::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, int $id)
    {
        $validated = $this->validate($request,[
            'value' => 'required',
            'skala' => 'required',
            'standard_value' => 'required',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'skala.required'  => 'Skala harus diisi.',
            'standard_value.required' => 'Standar nilai harus diisi',
        ]);

        $data = KriteriaFasilitas::findOrFail($id)->update($validated);
        if($data){
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

    public function destroy(int $id)
    {
        KriteriaFasilitas::findOrFail($id)->delete();

        return response()->json([
            'success'   => true,
            'message'  => "Data berhasil dihapus"
        ]);
    }
}
