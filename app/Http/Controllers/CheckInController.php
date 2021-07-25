<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\Supplier; 
use App\Models\Toner;
use App\Models\Stock;
use App\Models\Location;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckInController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:checkin-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:checkin-create', ['only' => ['create','store']]);
        $this->middleware('permission:checkin-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:checkin-delete', ['only' => ['destroy']]);
        $this->middleware('permission:checkin-complete', ['only' => ['setCompleted']]);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Check-in';
        $checkins = CheckIn::orderBy('created_at','DESC')->orderBy('updated_at','DESC')->limit(100)->paginate(50);
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');
        $suppliers = Supplier::where('status','1')->orderBy('name')->pluck('name', 'id');
        return view('checkins.index', compact('page_title','checkins','suppliers','locations'));
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
            'toner_code' => 'required',
            'invoice_no' => 'required',
            'or_no' => 'required',
            'purchased_cost' => 'required|numeric|between:0.00,9999999.99',
            'purchased_date' => 'required|date',
            'supplier_id' => 'required|integer',
            'note' => 'nullable'
        ]);

        $data['created_by'] = Auth::id();

        $checkin = CheckIn::create($data);
        // return redirect()->route('checkins.index')
        //                 ->with('success', 'Successfully created.');

        return redirect()->route('checkins.show', $checkin->id)
                        ->with('success', 'Successfully created, please add items.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show(CheckIn $checkin)
    {
        $stocks = Stock::where('check_in_id', $checkin->id)->get();
        $toners = Toner::where('status','1')->orderBy('model_name')->pluck('model_name', 'id');
        return view('checkins.show', compact('checkin', 'toners', 'stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckIn $checkin)
    {   
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckIn $checkin)
    {
        $data = $request->validate([
            'toner_code' => 'required',
            'invoice_no' => 'required',
            'or_no' => 'required',
            'purchased_cost' => 'required|numeric|between:0.00,9999999.99',
            'purchased_date' => 'required|date',
            'supplier_id' => 'required|integer',
            'note' => 'nullable'
        ]);

        $data['edited_by'] = Auth::id();

        $checkin->update($data);
        
        return redirect()->route('checkins.index')
                        ->with('success', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckIn $checkin)
    {
        if (!$checkin->status) {
            
            foreach ($checkin->stocks as $stock) {
                $stock->delete();
            }

            $checkin->delete();

            return redirect()->route('checkins.index')
                            ->with('success', 'Successfully deleted.');
        } else {
            return redirect()->route('checkins.index')
                            ->with('warning', 'Check-in '. $checkin->ReferenceNo .' cannot be deleted, status already set as completed.');
        }
        
    }

    public function setCompleted(Checkin $checkin)
    {
        $data['status'] = 1;

        if($checkin->TotalQuantity) {
            $checkin->update($data);
            return redirect()->route('checkins.show', $checkin->id)
                        ->with('success','Checkin status updated.');
        } else {
            return redirect()->route('checkins.show', $checkin->id)
            ->with('warning', 'Checkin: ' . $checkin->ReferenceNo . ' cannot be set as completed, no item found in this checkin');
        }
        
    }

    public function search(Request $request) {
        
        $data = $request->validate([
            'search-type' => 'required'
        ]);

        switch ($data['search-type']) {
            case 'reference_id':
                $data = $request->validate(['search' => 'required']);
                $checkins = CheckIn::where('id', $data['search'])->get();
                $page_title = 'Search Result: Reference ID "'.$data['search'].'"';
                 break;
            case 'invoice_no':
                $data = $request->validate(['search' => 'required']);
                $checkins = CheckIn::where('invoice_no', 'LIKE', '%'.$data['search'].'%')->get();
                $page_title = 'Search Result: Invoice No "'.$data['search'].'"';
                break;
            case 'toner_code':
                $data = $request->validate(['search' => 'required']);
                $checkins = CheckIn::where('toner_code', 'LIKE', '%'.$data['search'].'%')->get();
                $page_title = 'Search Result: Toner Code "'.$data['search'].'"';
                break;
            case 'supplier':
                $data = $request->validate([
                    'supplier_id' => 'required|integer',
                    'date-start' => 'required|date',
                    'date-end' => 'required|date'
                    ]);
                $checkins = CheckIn::whereBetween(DB::raw('DATE(purchased_date)'), array($data['date-start'], $data['date-end']))
                                    ->where('supplier_id', $data['supplier_id'])->get();
                $supplier = Supplier::where('id', $data['supplier_id'])->get(['name', 'vendor_code']);
                $page_title = 'Search Result: Supplier "'.$supplier[0]->name.'"';
                break;
            case 'purchased_date':
                $data = $request->validate([
                    'date-start' => 'required|date',
                    'date-end' => 'required|date'
                    ]);
                $checkins = CheckIn::whereBetween(DB::raw('DATE(purchased_date)'), array($data['date-start'], $data['date-end']))->get();
                $page_title = 'Search Result: Date From "'.$data['date-start'].'" To "'.$data['date-end'].'"';
                break;
            
        }

        $suppliers = Supplier::where('status','1')->pluck('name', 'id')->sortByDesc('name');
        $locations = Location::where('status','1')->pluck('name', 'id')->sortBy('name');

        return view('checkins.index', compact('page_title','checkins','suppliers','locations'));

    }

    public function print() {
        
    }

}
