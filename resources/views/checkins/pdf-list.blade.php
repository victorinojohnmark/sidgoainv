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
                        <th><b>#</b></th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Code</th>
                        <th>Person</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->company->code }}</td>
                        <td>{{ $location->location_code }}</td>
                        <td>{{ $location->contact_person }}</td>
                        <td>{{ $location->contact_no }}</td>
                        <td>{{ $location->email }}</td>
                        <td>{{ $location->address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No result available.</td>
                    </tr>
                    @endforelse
            
                </tbody>
            </table>   
            
        </div>
    </div>
</body>
</html>

