<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Location;
use App\Models\Company;

use PDF;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Locations';
        $locations = Location::orderBy('name')->get();
        $companies = Company::pluck('name','id');
        return view('location.index', compact('page_title','locations','companies'));
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
        //validate data
        $data = $request->validate([
            'name' => 'required|unique:locations',
            'company_id' => 'required|integer',
            'location_code' => 'required|unique:locations',
            'contact_person' => 'required',
            'contact_no' => 'required',
            'email' => 'required|email',
            'address' => 'nullable'
        ]);

        if($request->has('status')){
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['created_by'] = Auth::id();


        //store data
        Location::create($data);

        return redirect()->route('locations.index')
                        ->with('success', 'Location added successfully.');
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
    public function update(Request $request, Location $location)
    {
        // dd($location->location_code);
        //validate data
        $data = $request->validate([
            'name' => 'required|unique:locations,name,'.$location->id.',id',
            'company_id' => 'required|integer',
            'location_code' => 'required|unique:locations,location_code,'.$location->id.',id',
            'contact_person' => 'required',
            'contact_no' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        if($request->has('status')){
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['edited_by'] = Auth::id();

        $location->update($data);

        return redirect()->route('locations.index')
                        ->with('success', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')
                        ->with('info', 'Location deleted.');
    }

    public function search(Request $request) {
        $data = $request->validate([
            'search' => 'required',
        ]);

        $page_title = "Locations";
        $locations = Location::where('name', 'LIKE', '%'.$data['search'].'%')->get();
        $companies = Company::pluck('name','id');

        \Session::flash('info', 'Search Result: Name "' . $data['search'] . '"');
        return view('location.index', compact('page_title', 'locations', 'companies'));

    }

    // public function print() {
    //     $page_title = 'Location List';
    //     $locations = Location::orderBy('name')->get();

    //     // return view('location.pdf-list', compact('page_title','locations'));

    //     $pdf = PDF::loadView('location.pdf-list', compact('page_title', 'locations'))->setPaper('letter','landscape');

    //     return $pdf->download('location-list-'.date('YmndHis').'.pdf');
    // }


}
