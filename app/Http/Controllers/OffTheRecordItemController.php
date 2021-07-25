<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OffTheRecordItem;

use Illuminate\Support\Facades\Auth;

class OffTheRecordItemController extends Controller
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
        // dd($request->all());
        $data = $request->validate([
            'off_the_record_id' => 'integer|required',
            'toner_id' => 'integer|required',
            'quantity' => 'integer|required',
        ]);

        OffTheRecordItem::create($data);

        return redirect()->route('offTheRecord.show', $data['off_the_record_id'])
                        ->with('success', 'Item added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OffTheRecordItem $offTheRecordItem)
    {
        $data = $request->validate([
            'off_the_record_id' => 'integer|required',
            'toner_id' => 'integer|required',
            'quantity' => 'integer|required',
        ]);

        // $offTheRecordItem['updated_by'] = Auth::id();
        $offTheRecordItem->update($data);

        return redirect()->route('offTheRecord.show', $data['off_the_record_id'])
                        ->with('success', 'Item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
