<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Toner;
use App\Models\ViewRemainingStockPerStock;

use App\Models\ReleaseItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:stock-create', ['only' => ['create','store']]);
        $this->middleware('permission:stock-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:stock-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'check_in_id' => 'required|integer',
            'toner_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $data['created_by'] = Auth::id();

        Stock::create($data);

        return redirect()->route('checkins.show', $request['check_in_id'])
                        ->with('success', 'Item added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $data = $request->validate([
            'check_in_id' => 'required|integer',
            'toner_id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $data['edited_by'] = Auth::id();

        $stock->update($data);
        // dd($stock);

        return redirect()->route('checkins.show', $request['check_in_id'])
                        ->with('success', 'Item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        if (!$stock->checkIn->status) {
            $stock->delete();
            return redirect()->route('checkins.show', $stock->checkIn->id)
                        ->with('success', 'Item has been deleted.');
        } else {
            return redirect()->route('checkins.show', $stock->checkIn->id)
                        ->with('danger', 'Item cannot be deleted, Check-in already been posted as completed.');
        }
    }

    public function getRemainingStock(Stock $stock){
        $remainingStock = ViewRemainingStockPerStock::where('id', $stock->id)->get();

        return response()->json($remainingStock);
    }

    
}
