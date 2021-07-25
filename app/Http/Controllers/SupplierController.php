<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Suppliers";
        $suppliers = Supplier::orderBy('name')->get();
        return view('suppliers.index', compact('page_title', 'suppliers'));
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
            'name' => 'required|unique:suppliers',
            'vendor_code' => 'required|unique:suppliers',
            'contact_person' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'address' => 'nullable'
        ]);

        if($request->has('status')){
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['created_by'] = Auth::id();

        Supplier::create($data);
        return redirect()->route('suppliers.index')
                        ->with('success', 'Supplier created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //validate data
        $data = $request->validate([
            'name' => 'required|unique:suppliers,name,'.$supplier->id.',id',
            'vendor_code' => 'required|unique:suppliers,vendor_code,'.$supplier->id.',id',
            'contact_person' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'address' => 'nullable'
        ]);

        if($request->has('status')){
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $data['edited_by'] = Auth::id();

        //update
        $supplier->update($data);
        return redirect()->route('suppliers.index')
                        ->with('success', 'Supplier updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }

    public function search(Request $request) {

        $data = $request->validate([
            'search' => 'required',
        ]);

        $page_title = "Suppliers";
        $suppliers = Supplier::where('name', 'LIKE', '%'.$data['search'].'%')->get();
        
        \Session::flash('info', 'Search Result: Name "' . $data['search'] . '"');

        return view('suppliers.index', compact('page_title', 'suppliers'));
    }

    // public function print() {
    //     $page_title = 'Supplier List';
    //     $suppliers = Supplier::orderBy('name')->get();

    //     $pdf = PDF::loadView('suppliers.pdf-list', compact('page_title', 'suppliers'))->setPaper('letter','landscape');

    //     return $pdf->download('supplier-list-'.date('YmndHis').'.pdf');
    // }
}
