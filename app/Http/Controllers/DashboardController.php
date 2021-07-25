<?php

namespace App\Http\Controllers;

use App\Models\ViewTotalStock;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        // $tonerStocks = ViewTotalStock::whereRaw('computed_remaining_qty >= minimum_quantity')->get();
        // return view('dashboard.index', compact('tonerStocks'));
        // $toners = Toner::orderBy('model_name')->get();
        // return view('dashboard.toner-list', compact('toners'));
    }

    public function lowStock() 
    {
        // $tonerStocks = ViewTotalStock::whereRaw('computed_remaining_qty < minimum_quantity')->get();
        // return view('dashboard.index', compact('tonerStocks'));
    }
}
