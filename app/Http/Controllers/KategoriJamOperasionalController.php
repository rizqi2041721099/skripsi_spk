<?php

namespace App\Http\Controllers;

use App\Models\KategoriJamOperasional;
use Illuminate\Http\Request;
use DataTables;

class KategoriJamOperasionalController
{
    public function index(Request $request)
    {
        $page = 'kriteria';
        $data = KategoriJamOperasional::get();
        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('value', function ($row) {
                    return $row->value;
                })
                ->addColumn('standard_value', function ($row) {
                    return $row->standard_value;
                })
                ->addColumn('range_value', function ($row) {
                    return $row->range_value;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    // if ($auth->can('edit-kriteria-jarak')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="javascript:void(0)" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    // }
                    // if ($auth->can('delete-kriteria-jarak')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=
                            '<a class="btn btn-icon btn-danger btn-icon-only" href="#" onclick="deleteItem(this)" data-name="' .
                            $row->name .
                            '" data-id="' .
                            $row->id .
                            '">
                                <span class="btn-inner--icon"><i class="fas fa-trash-alt text-white"></i></span>
                            </a>';
                    // }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.kategori-jam-operasional.index', compact('page'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'value' => 'required',
            'standard_value' => 'required',
            'range_value' => 'required',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'standard_value.required' => 'Standar nilai harus diisi',
            'range_value'   => 'Rentang rata-rata harus diisi'
        ]);

        $data = KategoriJamOperasional::create($validated);

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

    // public function show(KategoriJamOperasional $kategoriJamOperasional)
    // {
    // }

    public function edit(int $id)
    {
        return response()->json(KategoriJamOperasional::find($id));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'value' => 'nullable',
            'standard_value' => 'nullable',
            'range_value' => 'nullable',
        ],[
            'value.required'  => 'Nilai harus diisi.',
            'standard_value.required' => 'Standar nilai harus diisi',
            'range_value'   => 'Rentang rata-rata harus diisi'
        ]);

        $data = KategoriJamOperasional::findOrFail($id)->update($validated);

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
        KategoriJamOperasional::findOrFail($id)->delete();

        return response()->json([
            'success'   => true,
            'message'  => "Data berhasil dihapus"
        ]);
    }
}
