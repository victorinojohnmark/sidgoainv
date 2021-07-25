<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page_title ?? 'Title here' }}</title>
    <link rel="stylesheet" href="{{ base_path().'/public/css/report.css' }}">
    
</head>
<body>
    <div id="app">
        <div id="holder">
            @include('includes.pdf.header')
            <table class="table-hover">
                <thead>
                  <tr>
                    <th colspan="5" class="table-header"><b>{{ $page_title }}</b></th>
                  </tr>
                  <tr>
                    <th><b>#</b></th>
                    <th><b>Model</b></th>
                    <th><b>Type</b></th>
                    <th><b>Unit</b></th>
                    <th><b>Minimum QTY.</b></th>
                  </tr>
                </thead>
                <tbody>
                      @forelse ($toners as $toner)
                          <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $toner->model_name }}</td>
                                <td>{{ $toner->toner_type->name }}</td>
                                <td>{{ $toner->unit->name }}</td>
                                <td>{{ $toner->minimum_quantity }}</td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="5">No record found.</td>
                          </tr>
                      @endforelse
            
                </tbody>
              </table>
        </div>
    </div>
</body>
</html>

