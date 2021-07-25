<?php

namespace App\Http\Controllers;

use App\Models\Toner;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() 
    {
        $toners = Toner::where('status','1')->orderBy('model_name')->get();
        return view('dashboard.toner-list', compact('toners'));
    }

    // public function lowStock() 
    // {
    //     $tonerStocks = ViewTotalStock::whereRaw('computed_remaining_qty < minimum_quantity')->get();
    //     return view('dashboard.index', compact('tonerStocks'));
    // }
}
