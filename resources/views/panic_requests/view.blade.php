@extends('app', ['page_title' => 'Panic Request', 'open_menu' => 'panic'])

<?php
use GuzzleHttp\Client;

if (!isset($_SESSION)) session_start();
$halo_user = $_SESSION['halo_user'];

$client = new Client();
$res = $client->request('GET', DB::table('acc_config')->whereId(1)->first()->master_url.'/api/getRoles', [
    'query' => [
        'username' => $halo_user->username,
        'link_id' => config('var.link_id')
    ]
]);
$permissions = json_decode($res->getBody());
?>

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-warning" href="{{ route('panic_requests.pending') }}">Pending Panic Requests</a>
        <a class="btn btn-info" href="{{ route('panic_requests.active') }}">Active Panic Requests</a>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="display-1 table table-condensed table-hover table-striped" width="100%">
            <tr>
                <th><strong>CLIENT INFORMATION</strong></th>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Name</small><br /><strong>{{ $panic_request->title }} {{ $panic_request->first_name }} {{ $panic_request->surname }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Date of Birth</small><br /><strong>{{ Carbon\Carbon::parse($panic_request->date_of_birth)->format('F j, Y') }}</strong></div>
                        <div class="col"><small>Gender</small><br /><strong>{{ $panic_request->gender }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Home Address</small><br /><strong>{!! nl2br($panic_request->home_address) !!}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Primary Phone</small><br /><strong>{{ $panic_request->primary_phone }}</strong></div>
                        <div class="col"><small>Alternate Phone</small><br /><strong>{{ $panic_request->alternate_phone }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Email Address</small><br /><strong>{{ $panic_request->email }}</strong></div>
                        <div class="col"><small>Occupation</small><br /><strong>{{ $panic_request->occupation }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Status</small><br /><strong class="@if ($panic_request->status == 'Pending') text-warning @elseif ($panic_request->status == 'Active') text-info @elseif ($panic_request->status == 'Rejected') text-danger @endif">{{ $panic_request->status }}</strong></div>
                        <div class="col"><small>Enrolment Date</small><br /><strong>{{ Carbon\Carbon::parse($panic_request->created_at)->format('F j, Y') }}</strong></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">

        @if ($panic_request->status == 'Pending')
        @if (count(array_intersect($permissions, ['ControlRoom'])) != 0)

        {!! Form::model(null, ['route' => ['panic_requests.treat', $panic_request->slug()], 'class' => 'form-group']) !!}
        <div class="form-group row">
            {!! Form::label('status', 'Action *', ['class' => 'col-md-4 col-form-label']) !!}
            <div class="col-md-8">
                {!! Form::select('status', ['Active' => 'Activate', 'Rejected' => 'Reject'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('comment', 'Comment *', ['class' => 'col-md-4 col-form-label']) !!}
            <div class="col-md-8">
                {!! Form::textarea('comment', $value = null, ['class' => 'form-control', 'placeholder' => 'Comment', 'required' => true, 'maxlength' => 200, 'rows' => 4]) !!}
            </div>
        </div>
        <div id="credentials" style="display: none;">
        <div class="form-group row">
            {!! Form::label('username', 'Username *', ['class' => 'col-md-4 col-form-label']) !!}
            <div class="col-md-8">
                {!! Form::text('username', $value = null, ['class' => 'form-control', 'placeholder' => 'Username', 'maxlength' => 100]) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('password', 'Password *', ['class' => 'col-md-4 col-form-label']) !!}
            <div class="col-md-8">
                {!! Form::text('password', $value = null, ['class' => 'form-control', 'placeholder' => 'Password', 'maxlength' => 100]) !!}
            </div>
        </div>
        </div>
        <div class="form-group row">
            <div class="col-md-8 offset-md-4">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}

        @endif
        @else

        <table class="display-1 table table-condensed table-hover table-striped" width="100%">
            <tr>
                <th><strong>ACTIVATION</strong></th>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Treated By</small><br /><strong>{{ App\AccEmployee::whereId($panic_request->treated_by)->first()->username }}</strong></div>
                        <div class="col"><small>Date Treated</small><br /><strong>{{ Carbon\Carbon::parse($panic_request->treated_at)->format('F j, Y') }}</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col"><small>Comment</small><br /><strong>{!! nl2br($panic_request->comment) !!}</strong></div>
                        <div class="col"><small>Username</small><br /><strong>{!! nl2br($panic_request->username) !!}</strong></div>
                    </div>
                </td>
            </tr>
        </table>

        @endif
    </div>
</div>

<script type="text/javascript">
    $("#status").change(function() {
        if ($(this).val() == "Active") {
            $("#credentials").slideDown(1000);
            $("#username").attr("required", true);
            $("#password").attr("required", true);
        } else {
            $("#credentials").slideUp(1000);
            $("#username").attr("required", false);
            $("#password").attr("required", false);
        }
    });
</script>
@endsection
