<?php

namespace App\Http\Controllers;

use App\Models\PriceFood;
use Illuminate\Http\Request;

class PriceFoodController extends Controller
{
    public function index(Request $request)
    {
        $page = 'master';

        $data = PriceFood::get();
        $auth  = auth()->user();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('standar_name', function ($row) {
                    return $row->standar_name;
                })
                ->addColumn('range_price', function ($row) {
                    return $row->range_price;
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
        return view('pages.price_food.index', compact('page'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(PriceFood $priceFood)
    {
    }

    public function edit(PriceFood $priceFood)
    {
    }

    public function update(Request $request, PriceFood $priceFood)
    {
    }

    public function destroy(PriceFood $priceFood)
    {
    }
}
