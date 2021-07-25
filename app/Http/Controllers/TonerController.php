<?php

namespace App\Http\Controllers;

use App\Models\Toner;
use App\Models\Supplier;
use App\Models\TonerType;
use App\Models\Unit;
use App\Models\Stock;
use App\Models\ViewRemainingStockPerToner;
use App\Models\ViewRemainingStockPerTonerCompleted;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use PDF;

class TonerController extends Controller
{

    function __construct() 
    {
        $this->middleware('permission:toner-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:toner-create', ['only' => ['create','store']]);
        $this->middleware('permission:toner-edit', ['only' => ['update','edit']]);
        

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Toners";
        $toners = Toner::orderBy('model_name')->get();
        $toner_types = TonerType::all()->pluck('name', 'id');
        $units = Unit::all()->pluck('name','id');
        // $suppliers = Supplier::all()->pluck('name', 'id')->sortBy('name');
        return view('toners.index')
                ->with([
                    'page_title' => $page_title, 
                    'toners' => $toners,
                    'toner_types' => $toner_types,
                    'units' => $units
                    ]);
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
            'model_name' => 'required|unique:toners',
            'toner_type_id' => 'required',
            'minimum_quantity' => 'required',
            'unit_id' => 'required',
            // 'status' => 'required'
        ]);
        
        if($request->has('status')){
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['created_by'] = Auth::id();

        Toner::create($data);
        return redirect()->route('toners.index')
                        ->with('success', 'Toner created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function show(Toner $toner)
    {
        // $tonerStocks = ViewRemainingStockPerTonerCompleted::where('toner_id', $toner->id)
        //                                                     ->where('remaining_stock','>','0')
        //                                                     ->get();
        // $totalRemainingStock = ViewRemainingStockPerTonerCompleted::where('toner_id', $toner->id)
        //                                                             ->sum('remaining_stock');
        return view('toners.show', compact('toner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function edit(Toner $toner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toner $toner)
    {
        // dd($request);
        $data = $request->validate([
            'model_name' => 'required|unique:toners,model_name,'.$toner->id.',id',
            'toner_type_id' => 'required',
            'minimum_quantity' => 'required',
            'unit_id' => 'required',
            // 'status' => 'required',
        ]);

        if($request->has('status')){
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['edited_by'] = Auth::id();

        $toner->update($data);
        return redirect()->route('toners.index')
                        ->with('success', 'Successfuly updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Toner  $toner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toner $toner)
    {
        $toner->delete();

        return redirect()->route('toners.index')
                        ->with('info', 'Toner deleted.');
    }

    public function getStocksByToner(Toner $toner) {
        $stocks = ViewRemainingStockPerToner::where('toner_id', $toner->id)
                                            ->where('remaining_stock', '>', '0')
                                            ->orderBy('check_in_id')->get();

        return response()->json($stocks);
        
    }

    public function search(Request $request) {
        $data = $request->validate([
            'search' => 'required',
        ]);

        $toners = Toner::where('model_name', 'LIKE', '%'.$data['search'].'%')->get();
        $page_title = "Toners";
        $toner_types = TonerType::all()->pluck('name', 'id');
        $units = Unit::all()->pluck('name','id');

        \Session::flash('info', 'Search Result: Toner Model "' . $data['search'] . '"');
        return view('toners.index')
                    ->with([
                        'page_title' => 'Toners', 
                        'toners' => $toners,
                        'toner_types' => $toner_types,
                        'units' => $units,
                    ]);
                    // ->with();
    }

    public function print() {
        $page_title = 'Toner List';
        // return view('reports.index', compact('page_title'));

        // $pdf = PDF::loadView('reports.index', compact('page_title'));
        // return $pdf->download('toner_list.pdf');

        $toners = Toner::orderBy('model_name')->get();
          
        $pdf = PDF::loadView('toners.pdf-list', compact('page_title', 'toners'));
    
        return $pdf->download('toner-list-'.date('YmdHis').'.pdf');

        // return view('toners.pdf-list', compact('page_title', 'toners'));
    }
}
