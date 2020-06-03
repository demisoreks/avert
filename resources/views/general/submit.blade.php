@extends('general', ['page_title' => 'Panic Alarm Service'])

@section('content')
<div class="row">
    <div class="col-xl-8 offset-xl-2">
        <div class="card">
            <div class="card-body">
                <legend>Success!!!</legend>
                <div class="alert alert-info">
                    <p>Dear {{ $panic_request->title }} {{ $panic_request->first_name }} {{ $panic_request->surname }},</p>
                    <p>Thank you for enroling for this service. An email containing your credentials will be sent to {{ $panic_request->email }}.</p>
                    <p><a href="https://halogen-group.com/" target="_blank">Halogen Group</a></p>
                </div>
                <a href="{{ route('panic_requests.enrol') }}" class="btn btn-block btn-secondary btn-lg">Click here for a new enrolment</a>
            </div>
        </div>
    </div>
</div>
@endsection
