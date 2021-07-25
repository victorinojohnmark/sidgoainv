@extends('layouts.app')

@section('content')

<h1 class="display-6 mb-3">Item Count</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#onStock" role="tab" aria-controls="home" aria-selected="true">On Stock</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-danger" id="profile-tab" data-toggle="tab" href="#lowStock" role="tab" aria-controls="profile" aria-selected="false">Low Stock</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="onStock" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-sm table-striped table-hover table-bordered mt-2">
            <thead>
                <tr>
                    <tr>
                        <th>#</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Current Stock</th>
                        <th>ROP</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @php $ctr = 1; @endphp
                @forelse ($toners as $toner)
                    @if ($toner->CurrentStock >= $toner->minimum_quantity)
                    <tr>
                        <td>{{ $ctr++ }}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalShowToner{{ $toner->id }}">{{ $toner->model_name }}</a>
                            @include('includes.modals.toner.show')
                        </td>
                        <td>{{ $toner->toner_type->name }}</td>
                        <td>{{ $toner->CurrentStock }}</td>
                        <td>{{ $toner->minimum_quantity }}</td>
                    </tr>   
                    @endif
                @empty
                <tr>
                    <td colspan="5">No results found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="lowStock" role="tabpanel" aria-labelledby="profile-tab">
        <table class="table table-sm table-striped table-hover table-bordered mt-2">
            <thead>
                <tr>
                    <tr>
                        <th>#</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Current Stock</th>
                        <th>ROP</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @php $ctr = 1; @endphp
                @forelse ($toners as $toner)
                    @if ($toner->CurrentStock < $toner->minimum_quantity)
                    <tr>
                        <td>{{ $ctr++ }}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalShowToner{{ $toner->id }}">{{ $toner->model_name }}</a>
                            @include('includes.modals.toner.show')
                        </td>
                        <td>{{ $toner->toner_type->name }}</td>
                        <td class="text-danger">{{ $toner->CurrentStock }}</td>
                        <td>{{ $toner->minimum_quantity }}</td>
                    </tr>   
                    @endif
                @empty
                <tr>
                    <td colspan="5">No results found.</td>
                </tr>
                @endforelse
        </table>
    </div>
</div>


@endsection
