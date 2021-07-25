<?php

namespace App\Http\Controllers;

use App\Models\ReturnItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnItemController extends Controller
{
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
        //
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
            'return_receive_id' => 'required',
            'release_item_id' => 'required',
            'quantity' => 'required|integer'
        ]);

        $data['created_by'] = Auth::id();

        ReturnItem::create($data);

        return redirect()->route('returnReceive.show', $data['return_receive_id'])
                            ->with('success', 'Item added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnItems  $returnItems
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnItems $returnItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnItems  $returnItems
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnItems $returnItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnItems  $returnItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnItems $returnItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnItems  $returnItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnItem $returnItem, Request $request)
    {

        $returnItem->delete();

        return redirect()->route('returnReceive.show', $request['return_receive_id'])
                            ->with('info', 'Item deleted.');
    }
}
