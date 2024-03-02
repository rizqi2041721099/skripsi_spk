<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class CacheController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:cleaner', ['only' => ['clear']]);
    }

    public function clear()
    {
        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        return redirect()->route('home')->with('success','Cache, route, view, config berhasil dihapus!');
    }
}
