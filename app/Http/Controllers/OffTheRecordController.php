<?php

namespace App\Http\Controllers;

use App\Models\OffTheRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\OffTheRecordTransactionType;
use App\Models\OffTheRecordIssueDescription;
use App\Models\OffTheRecordSubjectFor;
use App\Models\OffTheRecordActionTaken;
use App\Models\Location;
use App\Models\Toner;

class OffTheRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Off records';
        $transaction_types = OffTheRecordTransactionType::pluck('value', 'id');
        $issue_descriptions = OffTheRecordIssueDescription::pluck('value', 'id');
        $subject_fors = OffTheRecordSubjectFor::pluck('value', 'id');
        $action_takens = OffTheRecordActionTaken::pluck('value', 'id');
        $locations = Location::orderBy('name')->pluck('name', 'id');

        $offTheRecords = OffTheRecord::orderBy('created_at')->orderBy('updated_at')->limit(100)->get();
        return view('off_the_record.index', compact('page_title','offTheRecords', 'transaction_types', 'issue_descriptions', 'subject_fors', 'action_takens', 'locations'));
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
        // dd($request->all());

        $data = $request->validate([
            "location_id" => 'required',
            "off_the_record_transaction_type_id" => "required",
            "transaction_date" => "date|required",
            "transaction_reference" => "required",
            "off_the_record_issue_description_id" => "required",
            "off_the_record_subject_for_id" => "required",
            "off_the_record_action_taken_id" => "required",
            "action_reference" => "required",
            "notes" => "nullable",
        ]);

        $data['created_by'] = Auth::id();


        $offTheRecord = OffTheRecord::create($data);

        $prefix = "";
        switch ($data['off_the_record_transaction_type_id']) {
            case 1:
                $prefix = "OTRR";
                break;
            case 2:
                $prefix = "OTRCI";
                break;
            default:
                $prefix = "OTRCO";
                break;
        }

        $offTheRecord->reference_no = $prefix . str_pad($offTheRecord->id, 7, '0', STR_PAD_LEFT);
        $offTheRecord->update();

        return redirect()->route('offTheRecord.show', $offTheRecord->id)
                        ->with('success', 'Creation successful, please add items.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OffTheRecord  $offTheRecord
     * @return \Illuminate\Http\Response
     */
    public function show(OffTheRecord $offTheRecord)
    {
        $transaction_types = OffTheRecordTransactionType::pluck('value', 'id');
        $issue_descriptions = OffTheRecordIssueDescription::pluck('value', 'id');
        $subject_fors = OffTheRecordSubjectFor::pluck('value', 'id');
        $action_takens = OffTheRecordActionTaken::pluck('value', 'id');
        $locations = Location::orderBy('name')->pluck('name', 'id');
        $toners = Toner::orderBy('model_name')->pluck('model_name', 'id');
        return view('off_the_record.show', compact('offTheRecord', 'transaction_types', 'issue_descriptions', 'subject_fors', 'action_takens', 'locations', 'toners'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OffTheRecord  $offTheRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(OffTheRecord $offTheRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OffTheRecord  $offTheRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OffTheRecord $offTheRecord)
    {
        $data = $request->validate([
            "location_id" => 'required',
            "off_the_record_transaction_type_id" => "required",
            "transaction_date" => "date|required",
            "transaction_reference" => "required",
            "off_the_record_issue_description_id" => "required",
            "off_the_record_subject_for_id" => "required",
            "off_the_record_action_taken_id" => "required",
            "action_reference" => "required",
            "notes" => "nullable",
        ]);

        $data['updated_by'] = Auth::id();
        $offTheRecord->update($data);

        return redirect()->route('offTheRecord.show', $offTheRecord->id)
                        ->with('success', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OffTheRecord  $offTheRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(OffTheRecord $offTheRecord)
    {
        //
    }
}
