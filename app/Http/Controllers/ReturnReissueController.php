<?php

namespace App\Http\Controllers;

use App\Models\ReturnReissue;
use App\Models\CheckIn;
use app\Models\Stock;
use App\Models\ReasonOfReturn;
use App\Models\SubjectFor;
use App\Models\Location;
use App\Models\ReturnReceive;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnReissueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Return Items";
        // $rors = ReasonOfReturn::pluck('value', 'id');   
        // $sfs = SubjectFor::pluck('value', 'id');
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');

        $returnReissues = ReturnReissue::orderBy('created_at','DESC')
        ->limit(50)
        ->get();

        return view('return-reissue.index', compact('page_title','returnReissues','locations'));
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
        // $request['reissue_type_id'] == 2 ? $request['delivery_date'] = null : '';
        
        if($request['reissue_type_id'] == 2) {

            $data = $request->validate([
                'return_receive_id' => 'required|integer',
                'reissue_type_id' => 'required|integer',
            ]);

            $request['delivery_date'] = null;
        } else {
            $data = $request->validate([
                'return_receive_id' => 'required|integer',
                'reissue_type_id' => 'required|integer',
                'delivery_date' => 'required|date'
            ]);
        }

        $reissue = ReturnReissue::where('return_receive_id', $data['return_receive_id'])->get();

        if($reissue->isEmpty()) {
            $data['created_by'] = Auth::id();

            $returnReissue = ReturnReissue::create($data);

            $returnReissue->reference_no = 'RIS' . str_pad($returnReissue->id, 7, '0', STR_PAD_LEFT);
            $returnReissue->update();

            return redirect()->route('returnReceive.index')
                                ->with('success', 'Reissue has been submitted.');
        } else {
            return redirect()->route('returnReceive.show', $data['return_receive_id'])
                                ->with('danger', 'Cannot proceed, Reissue already exist.');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnReissue  $returnReissue
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnReissue $returnReissue)
    {
        $page_title = 'Reissue - Reference: '. $returnReissue->reference_no;

        return view('return-reissue.show', compact('page_title', 'returnReissue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnReissue  $returnReissue
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnReissue $returnReissue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnReissue  $returnReissue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnReissue $returnReissue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnReissue  $returnReissue
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnReissue $returnReissue)
    {
        //IF PENDING STATUS THEN DELETE
        if(!$returnReissue->status) {
            $returnReissue->delete();
            return redirect()->route('returnReissue.index')->with('success', 'Re-issue '. $returnReissue->reference_no.' has ben deleted.');
        } else {
            return abort(404);
        }
    }

    public function setCompleted(ReturnReissue $returnReissue) {

        //IF RETURN TO STOCK which is reissue_type_id = 2
        if($returnReissue->reissue_type_id == 2) {
            //create checkin
            $data = [];

            $data['toner_code'] = 'N/A';
            $data['invoice_no'] = 'N/A';
            $data['or_no'] = 'N/A';
            $data['purchased_cost'] = 0.00;
            $data['purchased_date'] = date('Y-m-d');
            $data['supplier_id'] = 0;
            $data['note'] = 'N/A';
            $data['return_reissue_id'] = $returnReissue->id;
            $data['status'] = 1;
            $data['created_by'] = Auth::id();

            $checkin = CheckIn::create($data);

            //CREATE stock item
            foreach($returnReissue->returnReceive->returnItems as $item) {
                $stock = [];
                $stock = [
                    'check_in_id' => $checkin->id,
                    'toner_id' => $item->releaseItem->stock->toner_id,
                    'quantity' => $item->quantity,
                    'created_by' => Auth::id()
                ];

                Stock::create($stock);
            }

        }

        $returnReissue->status = 1;
        $returnReissue->dr_no = 'RE' . str_pad($returnReissue->id, 7, '0', STR_PAD_LEFT);
        $returnReissue->update();

        return redirect()->route('returnReissue.index')
        ->with('success', 'Re-issue '. $returnReissue->reference_no.' has ben set as completed.');

    }

    public function search(Request $request) {
        $data = $request->validate([
            'search-type' => 'required',
        ]);

        $page_title = "Return Items";

        switch ($data['search-type']) {
            case 'reference_id':
                $returnReissues = ReturnReissue::where('reference_no', 'LIKE', '%'.$request['search'].'%')
                ->orderBy('created_at','DESC')
                ->get();

                $searchReissue = 'Search Result: '.$request['search'];
                break;

            case 'location':
                $returnReissues = ReturnReissue::join('return_receives', 'return_reissues.return_receive_id', '=', 'return_receives.id')
                ->where('return_receives.location_id', $request['location_id'])
                ->orderBy('return_reissues.created_at','DESC')
                ->get();

                $location = Location::where('id', $request['location_id'])->get(['name', 'location_code']);

                $searchReissue = 'Search Result: '.$location[0]->name;
                break;
            
            case 'date':
                $returnReissues = ReturnReissue::whereBetween(DB::raw('DATE(created_at)'), array($request['date-start'], $request['date-end']))
                ->orderBy('created_at','DESC')
                ->get();

                $searchReissue = 'Search Result: Date created from "'.$request['date-start'].'" To "'.$request['date-end'].'"';

                break;
            
            default:
                $returnReissues = ReturnReissue::orderBy('created_at','DESC')
                ->limit(50)
                ->get();
                break;
        }

        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');

        

        

        return view('return-reissue.index', compact('page_title','searchReissue','returnReissues','locations'));
    }
}
