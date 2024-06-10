<?php

namespace App\Http\Controllers;

use App\Models\KriteriaRasa;
use Illuminate\Http\Request;
use DataTables;

class KriteriaRasaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-kriteria-rasa|create-kriteria-rasa|edit-kriteria-rasa|delete-kriteria-rasa', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-kriteria-rasa', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kriteria-rasa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kriteria-rasa', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'kriteria';

        $data = KriteriaRasa::get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('value', function ($row) {
                    return $row->value;
                })
                ->addColumn('standard_value', function ($row) {
                    return $row->standard_value;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    if ($auth->can('edit-kriteria-rasa')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="javascript:void(0)" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    }
                    if ($auth->can('delete-kriteria-rasa')) {
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
        return view('pages.kriteria-rasa.index', compact('page'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'value' => 'required',
            'standard_value' => 'required',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'standard_value.required' => 'Standar nilai harus diisi',
        ]);

        $data = KriteriaRasa::create($validated);

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

    public function show(KriteriaRasa $kriteriaRasa)
    {
    }

    public function edit(KriteriaRasa $kriteriaRasa)
    {
        return response()->json($kriteriaRasa);
    }

    public function update(Request $request, KriteriaRasa $kriteriaRasa)
    {
        $validated = $this->validate($request,[
            'value' => 'required',
            'standard_value' => 'required',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'standard_value.required' => 'Standard nilai harus diisi',
        ]);

        $kriteriaRasa->update($validated);

        if($kriteriaRasa){
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

    public function destroy(KriteriaRasa $kriteriaRasa)
    {
        $kriteriaRasa->delete();

        return response()->json([
            'success'   => true,
            'message'  => "Data berhasil dihapus"
        ]);
    }
}
