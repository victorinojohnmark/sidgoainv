<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page_title ?? 'Title here' }}</title>
    <link rel="stylesheet" href="{{ base_path().'/public/css/report.css' }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/report.css') }}"> --}}
</head>
<body>
    <div id="app">
        <div id="holder">
            @include('includes.pdf.header')            
            <table style="margin-bottom:20px;">
                <thead>
                    <tr>
                        <th colspan="7" class="table-header"><b>{{ $page_title }}</b></th>
                      </tr>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Person</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->index + 1}}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->vendor_code }}</td>
                        <td>{{ $supplier->contact_person }}</td>
                        <td>{{ $supplier->contact_no }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No result available.</td>
                    </tr>
                    @endforelse
            
                </tbody>
            </table>   
            
        </div>
    </div>
</body>
</html>

