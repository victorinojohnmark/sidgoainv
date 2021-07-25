<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Location;
use App\Models\Toner;
use App\Models\ReleaseItem;
use App\Models\ViewTotalReleaseItemPerStock;
use App\Models\Supplier;
use App\Models\DeliveryStatus;
use App\Models\Delivery;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class CheckOutController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:checkout-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:checkout-create', ['only' => ['create','store']]);
        $this->middleware('permission:checkout-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:checkout-delete', ['only' => ['destroy']]);
        $this->middleware('permission:checkout-complete', ['only' => ['setCompleted']]);
        $this->middleware('permission:checkout-void', ['only' => ['voidCheckout']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Check-out';
        $locations = Location::where('status','1')->orderBy('name')->pluck('name', 'id');
        $suppliers = Supplier::where('status','1')->orderBy('name')->pluck('name', 'id');

        // $delivery_statuses = DeliveryStatus::pluck('name', 'id')->sortByDesc('name');
        $checkouts = CheckOut::orderBy('created_at','DESC')->orderBy('updated_at','DESC')->limit(100)->paginate(50);
        return view('checkouts.index', compact('page_title', 'locations', 'checkouts', 'suppliers'));
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
        //check if its completion checkout
        if($request->filled('parent_checkout_id')) {

            $data = $request->validate([
                'location_id' => 'required|integer',
                // 'invoice_no' => 'required',
                'po_no' => 'required',
                'request_slip_no' => 'required',
                // 'delivery_date' => 'required|date',
                // 'delivery_by' => 'nullable',
                'parent_checkout_id' => 'required|integer',
                'note' => 'nullable',
            ]);

            $data['delivery_status_id'] = 1;
            $data['created_by'] = Auth::id();

            $parentCheckout = Checkout::find($data['parent_checkout_id']);
            if(is_null($parentCheckout->completingCheckout)) {
                $checkout = CheckOut::create($data);

                return redirect()->route('checkouts.show', $checkout->id)
                            ->with('success', 'Completion checkout created, please add items.');
                // return 'completion checkout not existing';
            }else {
                return redirect()->route('checkouts.show', $data['parent_checkout_id'])
                        ->with('danger', 'Error! Invalid entry, completion checkout already exist.');
            }

            

        } else {
            $data = $request->validate([
                'location_id' => 'required|integer',
                // 'invoice_no' => 'required',
                'po_no' => 'required',
                'request_slip_no' => 'required',
                // 'delivery_date' => 'required|date',
                // 'delivery_by' => 'nullable',
                'note' => 'nullable',
            ]);
    
            if($request->has('return_to_supplier')){
                $data['return_to_supplier'] = 1;
            }
            
            $data['delivery_status_id'] = 3;
            $data['created_by'] = Auth::id();
            $checkout = CheckOut::create($data);
    
            // return redirect()->route('checkouts.index')
            //                 ->with('success', 'Checkout created.');
    
            return redirect()->route('checkouts.show', $checkout->id)
                            ->with('success', 'Checkout created, please add items.');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function show(CheckOut $checkout)
    {
        $totalReleases = ViewTotalReleaseItemPerStock::where('check_out_id', $checkout->id)->get();
        $toners = Toner::where('status','1')->pluck('model_name', 'id')->sortByDesc('model_name');
        $delivery_statuses = DeliveryStatus::where('id', '<', '3')->pluck('name', 'id')->sortByDesc('name');

        return view('checkouts.show', compact('checkout', 'toners', 'totalReleases', 'delivery_statuses'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckOut $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckOut $checkout)
    {
        $data = $request->validate([
            'location_id' => 'required|integer',
            // 'invoice_no' => 'required',
            'po_no' => 'required',
            'request_slip_no' => 'required',
            // 'delivery_status_id' => 'required|integer',
            // 'delivery_date' => 'required|date',
            // 'delivery_by' => 'nullable',
            'note' => 'nullable',
        ]);

        if($request->has('return_to_supplier')){
            $data['return_to_supplier'] = 1;
        } else {
            $data['return_to_supplier'] = 0;
        }

        $data['edited_by'] = Auth::id();

        $checkout->update($data);

        return redirect()->route('checkouts.index')
                        ->with('success', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckOut $checkout)
    {
        if (!$checkout->status) {
            foreach ($checkout->releaseItems as $releaseItem) {
                $releaseItem->delete();
            }
    
            $checkout->delete();
    
            return redirect()->route('checkouts.index')
                            ->with('success', 'Successfully deleted.');
        } else {
            return redirect()->route('checkouts.index')
                            ->with('warning', 'Check-out '. $checkout->ReferenceNo .' cannot be deleted, status already set as completed.');
        }
    }

    public function setCompleted(CheckOut $checkout, Request $request)
    {

        $data = $request->validate([
            'delivery_status_id' => 'required|integer',
            'delivery_date' => 'required|date',
            'delivery_by' => 'nullable',
            'invoice_no' => 'required',
        ]);

        if ($checkout->TotalItemCount == 0) {
            return redirect()->route('checkouts.show', $checkout->id)
                            ->with('warning', 'Checkout: ' . $checkout->ReferenceNo . ' cannot be set as completed, no item found in this checkout');
        } else {
            
            $data['status'] = 1;
            $checkout->update($data);

            $dr = [
                'check_out_id' => $checkout->id,
                'dr_no' => (Delivery::max('dr_no')) + 1
            ];
    
            Delivery::create($dr);

            return redirect()->route('checkouts.show', $checkout->id)
                            ->with('success','Checkout status updated.');
        }
   
    }

    public function voidCheckout(Checkout $checkout, Request $request) 
    {
      if(!$checkout->status) {
        $data = [
            'void_status' => 1,
            'parent_checkout_id' => null,
          ];
  
        $checkout->update($data);

        foreach ($checkout->releaseItems as $item) {
            $item->delete();
        }
  
        return redirect()->route('checkouts.show', $checkout->id)
                              ->with('success','Checkout set as void successfully.');
      }
    }

    public function search(Request $request) {
        
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
            return redirect()->route('checkouts.index');
            
        }

        $suppliers = Supplier::where('status','1')->pluck('name', 'id')->sortByDesc('name');
        $locations = Location::where('status','1')->pluck('name', 'id')->sortBy('name');
        $delivery_statuses = DeliveryStatus::pluck('name', 'id')->sortByDesc('name');

        return view('checkouts.index', compact('page_title','checkouts','suppliers','delivery_statuses','locations'));


    }

    public function fileUpload(Request $request, Checkout $checkout) {
        $request->validate([
            'files' => 'required|mimes:pdf,docx,doc,jpg,png,gif,jpeg'
        ]);
        
        if ($request->file()) {

            //rename filename
            $fileName = $checkout->reference_no.'-'.time().'_'.$request->file('files')->getClientOriginalName();

            //move file
            $request->file('files')->storeAs('uploads', $fileName, 'public');

            // dd($checkout->files);
            $array = $checkout->files;
            array_push($array, $fileName);

            $checkout->files = $array;
            $checkout->update();
            
        }

        

        return redirect()->route('checkouts.index')
                        ->with('success', 'File successfully uploaded.');
    }

    public function fileDelete(Checkout $checkout, Request $request) {
        if (!empty($request->query('file'))) {
            $file = $request->query('file');
            $array = $checkout->files;

            @unlink('storage/uploads/'.$file);

            $key = array_search($file, $array);
            if (false !== $key) {
                unset($array[$key]);
            }
            $checkout->files = $array;
            $checkout->update();

            return redirect()->route('checkouts.index')
                        ->with('info', 'File deleted.');
        }
    }

}
