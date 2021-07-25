<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Toner;
use App\Models\Supplier;
use App\Models\Location;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\DeliveryStatus;
use App\Models\ReturnReceive;
use App\Models\ReturnReissue;

use App\Models\ViewTotalReleaseItemPerStock;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function masterList() {
        $toners = Toner::where('status','1')->orderBy('model_name')->get();
        $suppliers = Supplier::where('status','1')->orderBy('name')->get();
        $locations = Location::where('status','1')->orderBy('name')->get();
        return view('reports.master-list', compact('toners','suppliers','locations'));
    }

    public function stocks() {
        $toners = Toner::where('status','1')->orderBy('model_name')->get();
        
        return view('reports.stock', compact('toners'));
    }

    public function checkins() {
        $checkins = CheckIn::orderBy('created_at','DESC')->orderBy('updated_at','DESC')->limit(100)->get();
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');
        $suppliers = Supplier::where('status','1')->orderBy('name')->pluck('name', 'id');
        return view('reports.checkin', compact('checkins','suppliers','locations'));
    }

    public function checkinsShow(Checkin $checkin) {

        $page_title = 'Check-in';
        return view('reports.checkin-show', compact('page_title','checkin'));
    }

    public function checkinsShowRelease(Checkin $checkin) {
        $page_title = 'Check-in';
        return view('reports.checkin-release', compact('page_title','checkin'));
    }

    public function checkinsSearch(Request $request) {
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
            
            default :
            return redirect()->route('reports.checkin');
            
        }

        $locations = Location::orderBy('name')->pluck('name', 'id');
        $suppliers = Supplier::orderBy('name')->pluck('name', 'id');

        return view('reports.checkin', compact('page_title','checkins','suppliers','locations'));
    }

    public function checkouts() {
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');
        $suppliers = Supplier::where('status','1')->orderBy('name')->pluck('name', 'id');
        $checkouts = CheckOut::orderBy('created_at','DESC')->orderBy('updated_at','DESC')->limit(100)->get();
        
        return view('reports.checkout', compact('locations', 'suppliers', 'checkouts'));
    }

     public function checkoutsShow(Checkout $checkout) {

        $page_title = 'Check-out';
        $totalReleases = ViewTotalReleaseItemPerStock::where('check_out_id', $checkout->id)->get();
        return view('reports.checkout-show', compact('page_title', 'checkout', 'totalReleases'));
     }

    public function checkoutsSearch(Request $request) {
        $data = $request->validate([
            'search-type' => 'required'
        ]);

        switch ($data['search-type']) {
            case 'reference_id':
                $data = $request->validate(['search' => 'required']);
                $checkouts = CheckOut::where('id', $data['search'])->get();
                $page_title = 'Search Result: Reference ID "'.$data['search'].'"';
                 break;

            case 'invoice_no':
                $data = $request->validate(['search' => 'required']);
                $checkouts = CheckOut::where('invoice_no', 'LIKE', '%'.$data['search'].'%')->get();
                $page_title = 'Search Result: Invoice No "'.$data['search'].'"';
                break;

            case 'toner_code':
                $data = $request->validate(['search' => 'required']);
                $checkouts = CheckOut::where('toner_code', 'LIKE', '%'.$data['search'].'%')->get();
                $page_title = 'Search Result: Toner Code "'.$data['search'].'"';
                break;
                
            case 'req_slip':
                $data = $request->validate(['search' => 'required']);
                $checkouts = CheckOut::where('request_slip_no', 'LIKE', '%'.$data['search'].'%')->get();
                $page_title = 'Search Result: Request Slip No. "'.$data['search'].'"';
                break;

            case 'dr_no':
                $data = $request->validate(['search' => 'required']);
                $checkouts = CheckOut::where('dr_no', 'LIKE', '%'.$data['search'].'%')->get();
                $page_title = 'Search Result: Delivery No "'.$data['search'].'"';
                break;

            case 'location':
                $data = $request->validate([
                    'location_id' => 'required|integer'
                    ]);
                $checkouts = CheckOut::where('location_id', $data['location_id'])->get();
                $location = Location::where('id', $data['location_id'])->get(['name', 'location_code']);
                $page_title = 'Search Result: Location "'.$location[0]->name.'"';
                break;

            case 'location_with_date':
                $data = $request->validate([
                    'location_id' => 'required|integer',
                    'date-start' => 'date|required',
                    'date-end' => 'date|required'
                    ]);
                $checkouts = CheckOut::whereBetween(DB::raw('DATE(delivery_date)'), array($data['date-start'], $data['date-end']))
                                    ->where('location_id', $data['location_id'])->get();
                $location = Location::where('id', $data['location_id'])->get(['name', 'location_code']);
                $page_title = 'Search Result: Location "'.$location[0]->name.'"';
                break;

            case 'delivery_date':
                $data = $request->validate([
                    'date-start' => 'required|date',
                    'date-end' => 'required|date'
                    ]);
                $checkouts = CheckOut::whereBetween(DB::raw('DATE(delivery_date)'), array($data['date-start'], $data['date-end']))->get();
                $page_title = 'Search Result: Date From "'.$data['date-start'].'" To "'.$data['date-end'].'"';
                break;
            
            default :
            return redirect()->route('reports.checkout');
            
        }

        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');
        $suppliers = Supplier::where('status','1')->orderBy('name')->pluck('name', 'id');
        $delivery_statuses = DeliveryStatus::pluck('name', 'id')->sortByDesc('name');

        return view('reports.checkout', compact('page_title','checkouts','suppliers','delivery_statuses','locations'));
    }


    public function returnReceive() {

        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');

        $returnReceives = ReturnReceive::doesntHave('returnReissue')
        ->orderBy('date_received','DESC')
        ->orderBy('created_at','DESC')
        ->get();

        return view('reports.return-receive', compact('returnReceives','locations'));
    }

    public function returnReceiveShow(ReturnReceive $returnReceive) {
        $page_title = "Return - Reference: ". $returnReceive->reference_no;

        return view('reports.return-receive-show', compact('page_title','returnReceive'));
    }

    public function returnReceiveSearch(Request $request) {
        $data = $request->validate([
            'search-type' => 'required'
        ]);

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

        return view('reports.return-receive', compact( 'searchReceive','returnReceives','locations'));
    }

    public function returnReissue() {
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');
        $returnReissues = ReturnReissue::orderBy('created_at','DESC')
        ->limit(50)
        ->get();

        return view('reports.return-reissue', compact('returnReissues','locations'));
    }

    public function returnReissueShow(ReturnReissue $returnReissue) {
        $page_title = 'Reissue';
        return view('reports.return-reissue-show', compact('page_title', 'returnReissue'));
    }

    public function returnReissueSearch(Request $request) {
        $data = $request->validate([
            'search-type' => 'required',
        ]);

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

        return view('reports.return-reissue', compact('returnReissues','locations','searchReissue'));
    }

    
}
