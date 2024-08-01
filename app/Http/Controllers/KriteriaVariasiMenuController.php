<?php

namespace App\Http\Controllers;

use App\Models\KriteriaVariasiMenu;
use Illuminate\Http\Request;
use DataTables;

class KriteriaVariasiMenuController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-kriteria-variasi-menu|create-kriteria-variasi-menu|edit-kriteria-variasi-menu|delete-kriteria-variasi-menu', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-kriteria-variasi-menu', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kriteria-variasi-menu', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kriteria-variasi-menu', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'kriteria';

        $data = KriteriaVariasiMenu::get();

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
                ->addColumn('range_value', function ($row) {
                    return $row->range_value;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    if ($auth->can('edit-kriteria-variasi-menu')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="javascript:void(0)" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    }
                    if ($auth->can('delete-kriteria-variasi-menu')) {
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
        return view('pages.kriteria-variasi-menu.index', compact('page'));
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
            'range_value' => 'required',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'skala.required'  => 'Skala harus diisi.',
            'standard_value.required' => 'Standar nilai harus diisi',
            'range_value'   => 'Rentang rata-rata harga harus diisi'
        ]);

        $data = KriteriaVariasiMenu::create($validated);

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

    public function show(KriteriaVariasiMenu $kriteriaVariasiMenu)
    {
    }

    public function edit(KriteriaVariasiMenu $kriteriaVariasiMenu)
    {
        return response()->json($kriteriaVariasiMenu);
    }

    public function update(Request $request, int $id)
    {
        $validated = $this->validate($request,[
            'value' => 'nullable',
            'skala' => 'nullable',
            'standard_value' => 'nullable',
            'range_value' => 'nullable',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'standard_value.required' => 'Standar nilai harus diisi',
            'range_value'   => 'Rentang rata-rata harga harus diisi'
        ]);

        $data = KriteriaVariasiMenu::findOrFail($id)->update($validated);

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
        KriteriaVariasiMenu::findOrFail($id)->delete();

        return response()->json([
            'success'   => true,
            'message'  => "Data berhasil dihapus"
        ]);
    }
}
