<?php

namespace App\Http\Controllers;

use App\Models\ReleaseItem;
use App\Models\CheckOut;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReleaseItemController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:releaseitem-create', ['only' => ['create','store']]);
        $this->middleware('permission:releaseitem-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:releaseitem-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            'check_out_id' => 'integer|required',
            'stock_id' => 'integer|required',
            'quantity' => 'integer|required'
        ]);

        /*
        check if checkout status is floating, meaning 0
        Rules: 
        Release Items are editable under floating checkouts if not,
        then release-edit are unable
        */
        $checkout = CheckOut::find($data['check_out_id']);

        if (!$checkout->status) {
            //meaning checkouts status is 0
            $data['created_by'] = Auth::id();
            ReleaseItem::create($data);
            return redirect()->route('checkouts.show', $data['check_out_id'])
                        ->with('success', 'Item successfully added');
        } else {
            //meaning checkouts status is 1
            return redirect()->route('checkouts.show', $data['check_out_id'])
                        ->with('warning', 'Adding/Editing release-items are restricted after check-out is already set as completed.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReleaseItem  $releaseItem
     * @return \Illuminate\Http\Response
     */
    public function show(ReleaseItem $releaseItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReleaseItem  $releaseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ReleaseItem $releaseItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReleaseItem  $releaseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReleaseItem $releaseitem)
    {
        $data = $request->validate([
            'check_out_id' => 'required|integer',
            'stock_id' => 'required|integer',
            'quantity' => 'required|integer',
            'note' => 'nullable'
        ]);

        $checkout = CheckOut::find($data['check_out_id']);

        if (!$checkout->status) {
            $data['edited_by'] = Auth::id();

            $releaseitem->update($data);    
            return redirect()->route('checkouts.show', $data['check_out_id'])
                        ->with('success', 'Item successfully updated');
        } else {
            return redirect()->route('checkouts.show', $data['check_out_id'])
                        ->with('warning', 'Adding/Editing release-items are restricted after check-out is already set as completed.');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReleaseItem  $releaseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReleaseItem $releaseitem)
    {     
        if(!$releaseitem->checkOut->status){
            $releaseitem->delete();

            return redirect()->route('checkouts.show', $releaseitem->checkOut->id)
                        ->with('success', 'Item has been deleted');
        } else {
            return redirect()->route('checkouts.show', $releaseitem->checkOut->id)
                        ->with('warning', 'Item cannot be deleted, Check-out has already been posted as completed.');
        }
    }
}
