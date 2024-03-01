<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use DataTables;

class KriteriaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-kriteria|create-kriteria|edit-kriteria|delete-kriteria', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-kriteria', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kriteria', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kriteria', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'kriteria';

        $data = Kriteria::orderBy('created_at')->get();

        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('category', function ($row) {
                    if($row->category == 1)
                    {
                        return 'Cost';
                    } else {
                        return 'Benefit';
                    }
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    if ($auth->can('edit-kriteria')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="'.route('kriterias.edit',$row->id).'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    }
                    if ($auth->can('delete-kriteria')) {
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
        return view('pages.kriterias.index', compact('page'));
    }

    public function create()
    {
        $page = 'kriteria';
        return view('pages.kriterias.create',compact('page'));
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'name'      => 'required|unique:kriterias,name',
            'category'  => 'required',
            'description'  => 'nullable',
        ],[
            'name.required'  => 'Nama harus diisi.',
            'name.unique'   => 'Nama sudah ada.',
            'category.required' => 'Kategori harus diisi'
        ]);

        $data = Kriteria::create($validated);
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

    public function edit(Kriteria $kriteria)
    {
        $page = 'kriteria';
        $data = Kriteria::findOrFail($kriteria->id);
        return view('pages.kriterias.edit',compact('data','page'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $this->validate($request,[
            'name' => 'nullable|unique:kriterias,name,'.$kriteria->id,
            'category'  => 'nullable',
            'description'  => 'nullable',
        ],[
            'name.required'  => 'Nama harus diisi.',
            'name.unique'   => 'Nama sudah ada.',
            'category.required' => 'Kategori harus diisi'
        ]);

        $kriteria->update($validated);

        if($kriteria){
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

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return response()->json([
            'success'   => true,
            'message'  => "Data berhasil dihapus"
        ]);
    }
}
