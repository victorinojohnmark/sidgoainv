<?php

namespace App\Http\Controllers;

use App\Models\ReturnReceive;
use App\Models\ReasonOfReturn;
use App\Models\SubjectFor;
use App\Models\CheckOut;
use App\Models\Location;
use App\Models\ReissueType;
use App\Models\ReturnReissue;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Return Items";
        $rors = ReasonOfReturn::pluck('value', 'id');   
        $sfs = SubjectFor::pluck('value', 'id');
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');

        $returnReceives = ReturnReceive::doesntHave('returnReissue')
        ->orderBy('date_received','DESC')
        ->orderBy('created_at','DESC')
        ->get();

        // $returnReissues = ReturnReissue::orderBy('created_at','DESC')
        // ->limit(50)
        // ->get();

        return view('return-receive.index', compact('page_title','returnReceives','rors','sfs','locations'));
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
            'location_id' => 'required|integer',
            'date_received' => 'required|date',
            'reason_of_return_id' => 'required|integer',
            'subject_for_id' => 'required|integer',
        ]);
        
        $data['created_by'] = Auth::id();
        $return = ReturnReceive::create($data);

        return redirect()->route('returnReceive.show', $return->id)
                            ->with('success', 'Return profile successfully created. Please add returned items.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnReceive  $returnReceive
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ReturnReceive $returnReceive)
    {
        $page_title = "Return - Reference: ". $returnReceive->reference_no;
        $reissue_types = ReissueType::pluck('name', 'id');

        if($request->query('checkout-search')) {
            $checkouts = CheckOut::where('reference_no', 'LIKE', '%'.$request->query('checkout-search').'%')->get();
            return view('return-receive.show', compact('page_title','returnReceive','reissue_types','checkouts'));
        } else {
            return view('return-receive.show', compact('page_title','returnReceive','reissue_types'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnReceive  $returnReceive
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnReceive $returnReceive)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnReceive  $returnReceive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnReceive $returnReceive)
    {
        if(!$returnReceive->status) {
            $data = $request->validate([
                'location_id' => 'required|integer',
                'date_received' => 'required|date',
                'reason_of_return_id' => 'required|integer',
                'subject_for_id' => 'required|integer',
            ]);
    
            $data['updated_by'] = Auth::id();
    
            $returnReceive->update($data);
    
            return redirect()->route('returnReceive.index')
                                ->with('success', 'Return ' . $returnReceive->reference_no . ' has been updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnReceive  $returnReceive
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnReceive $returnReceive)
    {
        if(!$returnReceive->status) {
            //delete subitem
            foreach ($returnReceive->returnItems as $returnItem) {
                $returnItem->delete();
            }

            $returnReceive->delete();

            return redirect()->route('returnReceive.index')
                            ->with('info', 'Successfully deleted.');
        } else {
            return redirect()->route('returnReceive.index')
                            ->with('warning', 'Return '. $returnReceive->reference_no.' cannot be deleted, status already set as completed.');
        }
    }

    public function setCompleted(ReturnReceive $returnReceive) {

        if($returnReceive->returnItems->sum('quantity')) {
            //SET COMPLETE
            $returnReceive->status = 1;
            $returnReceive->update();
            return redirect()->route('returnReceive.show', $returnReceive->id)
                            ->with('success', 'Return '.$returnReceive->reference_no.' has been set as completed.');
        } else {
            return redirect()->route('returnReceive.show', $returnReceive->id)
                            ->with('warning', 'Cannot proceed, no item found in this return '. $returnReceive->reference_no);
        }

    }

    public function search(Request $request) {
        $data = $request->validate([
            'search-type' => 'required'
        ]);

        $page_title = "Return Items";
        $rors = ReasonOfReturn::pluck('value', 'id');   
        $sfs = SubjectFor::pluck('value', 'id');
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');

        switch ($data['search-type']) {
            case 'reference_id':
                $returnReceives = ReturnReceive::where('reference_no', 'LIKE', '%'.$request['search'].'%')
                ->orderBy('date_received','DESC')
                ->orderBy('created_at','DESC')
                ->limit(50)
                ->get();

                $searchReceive = 'Search Result: '.$request['search'];
                break;

            case 'location':
                $returnReceives = ReturnReceive::where('location_id', $request['location_id'])
                ->orderBy('date_received','DESC')
                ->orderBy('created_at','DESC')
                ->limit(50)
                ->get();

                $location = Location::where('id', $request['location_id'])->get(['name', 'location_code']);

                $searchReceive = 'Search Result: '.$location[0]->name;
                break;

            case 'date_received':
                $returnReceives = ReturnReceive::whereBetween(DB::raw('DATE(date_received)'), array($request['date-start'], $request['date-end']))
                ->orderBy('date_received','DESC')
                ->orderBy('created_at','DESC')
                ->limit(50)
                ->get();

                $searchReceive = 'Search Result: Date received from "'.$request['date-start'].'" To "'.$request['date-end'].'"';
                break;
        
            default:
                $returnReceives = ReturnReceive::doesntHave('returnReissue')
                ->orderBy('date_received','DESC')
                ->orderBy('created_at','DESC')
                ->get();

                $searchReceive = null;
                break;
        }

        return view('return-receive.index', compact('page_title', 'searchReceive','returnReceives','rors','sfs','locations'));

    }
}
