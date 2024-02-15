<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodVariaty;
use DataTables;

class FoodVariatyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-food-variaties|create-food-variaties|edit-food-variaties|delete-food-variaties', ['only' => ['index', 'store']]);
        $this->middleware('permission:create-food-variaties', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-food-variaties', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-food-variaties', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $page = 'master';

        $data = FoodVariaty::orderBy('created_at')->get();
        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row)use($auth) {
                    $btn = '';
                    if ($auth->can('edit-food-variaties')) {
                        $btn .= '&nbsp;&nbsp';
                        $btn .=   '<a href="javascript:void(0)" onclick="updateItem(this)" data-id="'.$row->id.'" class="btn btn-icon btn-primary btn-icon-only rounded">
                                <span class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                </a>';
                    }
                    if ($auth->can('delete-food-variaties')) {
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
        return view('pages.food_variaties.index', compact('page'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|unique:food_variaties,name',
        ],[
            'name.required'  => 'Variasi makanan harus diisi.',
            'name.unique'   => 'Variasi makanan sudah ada.'
        ]);

        $data = FoodVariaty::create(['name' => $request->name]);

        if($data){
            return response()->json([
                'success'   => true,
                'message'   => 'Variasi makanan berhasil ditambahkan'
            ]);
        }else{
            return response()->json([
                'success'   => fasle,
                'message'   => 'Variasi makanan gagal ditambahkan'
            ]);
        }
    }

    public function edit(int $id)
    {
        $data = FoodVariaty::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'name' => 'nullable|unique:food_variaties,name,'.$id,
        ],[
            'name.unique' => 'Variasi makanan sudah ada.'
        ]);

        $foodVariaty = FoodVariaty::findOrFail($id);

        $foodVariaty->update(['name' => $request->name]);

        if($foodVariaty){
            return response()->json([
                'success'   => true,
                'message'   => 'Variasi makanan berhasil diupdate'
            ]);
        }else{
            return response()->json([
                'success'  => false,
                'message'   => 'Variasi makanan gagal diupdate'
            ]);
        }
    }


    public function destroy(FoodVariaty $FoodVariaty)
    {
        $data = $FoodVariaty->delete();

        return response()->json([
           'success'   => true,
            'message'  => "Variasi makanan berhasil dihapus"
        ]);
    }
}
