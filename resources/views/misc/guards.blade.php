@extends('app', ['page_title' => 'Guard Data (Temp)', 'open_menu' => 'misc'])

@section('content')
<div class="row" style="margin-bottom: 20px;">
    <div class="col-12">
        {!! Form::model($search_param, ['route' => ['guards.temp'], 'class' => 'form-inline']) !!}
            <div class="col-auto">
                {!! Form::label('region', 'Region', []) !!}
            </div>
            <div class="col-auto">
                {!! Form::select('region', DB::table('tmp_guards')->distinct('region')->orderBy('region')->pluck('region', 'region'), $value = null, ['class' => 'form-control', 'required' => true]) !!}
            </div>
            <div class="col-auto">
                {!! Form::submit('Search', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
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
