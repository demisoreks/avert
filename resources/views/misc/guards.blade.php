@extends('app', ['page_title' => 'Guard Data (Temp)', 'open_menu' => 'misc'])

@section('content')
<div class="row">
    <div class="col-12">
        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
            <thead>
                <tr class="text-center">
                    <th data-priority="1"><strong>REGION</strong></th>
                    <th data-priority="1"><strong>ZONE</strong></th>
                    <th data-priority="3"><strong>ZONAL HEAD</strong></th>
                    <th data-priority="1"><strong>CLIENT NAME</strong></th>
                    <th data-priority="2"><strong>CLIENT LOCATION</strong></th>
                    <th data-priority="1"><strong>CUG NUMBER</strong></th>
                    <th data-priority="1"><strong>GUARD'S NAME</strong></th>
                    <th data-priority="1"><strong>GUARD'S NUMBER</strong></th>
                    <th><strong>GUARD'S ADDRESS</strong></th>
                    <th><strong>DESIGNATION</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guards as $guard)
                <tr>
                    <td>{{ $guard->region }}</td>
                    <td>{{ $guard->zone }}</td>
                    <td>{{ $guard->zonal_head }}</td>
                    <td>{{ $guard->client_name }}</td>
                    <td>{{ $guard->client_location }}</td>
                    <td>{{ $guard->cug_number }}</td>
                    <td>{{ $guard->guard_name }}</td>
                    <td>{{ $guard->guard_number }}</td>
                    <td>{{ $guard->guard_home_address }}</td>
                    <td>{{ $guard->designation }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
