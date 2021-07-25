    {{ Form::token() }}
    <div class="col-sm-2 my-1">
        <div class="form-group">
            <select name="search-type" id="" class="form-control w-100 searchType" required>
                <option disabled selected value>Search Type</option>
                <option value="reference_id">Reference ID</option>
                <option value="dr_no">DR No</option>
                <option value="invoice_no">Sales Invoice No.</option>
                <option value="req_slip">Request Slip No</option>
                <option value="location">Location</option>
                <option value="location_with_date">Location with date</option>
                <option value="delivery_date">Delivery Date</option>
            </select>
        </div>
    </div>
    <div class="col-sm-3 my-1 w-100 d-none" id="searchInput">
        <input type="text" name="search" class="form-control w-100" placeholder="Search here...">
    </div>
    <div class="col-sm-3 d-none" id="locationSelect">
        {{ Form::select('location_id', $locations, old('location_id'), ['placeholder' => 'Select here...', 'class' => 'form-control w-100']) }}
    </div>
    <div class="col-sm-3 d-none" id="supplierSelect">
        {{ Form::select('supplier_id', $suppliers, old('supplier_id'), ['placeholder' => 'Select here...', 'class' => 'form-control w-100']) }}
    </div>
    <div class="col-sm-2 my-1 form-inline date-range d-none" id="startDate">
        <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">From</span>
            </div>
            <input type="date" name="date-start" class="form-control">
        </div>
    </div>
    <div class="col-sm-2 my-1 form-inline date-range d-none" id="endDate">
        <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">To</span>
            </div>
            <input type="date" name="date-end" class="form-control">
        </div>
    </div>
    <div class="col-sm-1 my-3">
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
    </div>