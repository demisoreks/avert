@extends('app', ['page_title' => 'Pending Panic Requests', 'open_menu' => 'panic'])

@section('content')
<div class="row">
    <div class="col-12">
        <table id="myTable3" class="display-1 table table-condensed table-hover table-striped responsive" width="100%">
            <thead>
                <tr class="text-center">
                    <th width="10%"><strong>ENROLMENT DATE/TIME</strong></th>
                    <th><strong>NAME</strong></th>
                    <th width="26%"><strong>HOME ADDRESS</strong></th>
                    <th width="10%"><strong>PRIMARY PHONE</strong></th>
                    <th width="10%"><strong>ALTERNATE PHONE</strong></th>
                    <th width="15%"><strong>EMAIL ADDRESS</strong></th>
                    <th width="10%" data-priority="1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($panic_requests as $panic_request)
                <tr>
                    <td>{{ $panic_request->created_at }}</td>
                    <td>{{ $panic_request->title }} {{ $panic_request->first_name }} {{ $panic_request->surname }}</td>
                    <td>{!! nl2br($panic_request->home_address) !!}</td>
                    <td>{{ $panic_request->primary_phone }}</td>
                    <td>{{ $panic_request->alternate_phone }}</td>
                    <td>{{ $panic_request->email }}</td>
                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('panic_requests.view', [$panic_request->slug()]) }}">View Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
