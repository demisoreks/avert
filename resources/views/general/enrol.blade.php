@extends('general', ['page_title' => 'Panic Alarm Service'])

@section('content')
<div class="row">
    <div class="col-xl-8 offset-xl-2">
        <div class="card">
            <div class="card-body">
                <legend>Enrolment Form</legend>
                <div class="alert alert-info">
                    <p>
                        A <strong>valid email address</strong> is required for you to receive your default login credentials.
                    </p>
                    <p>* compulsory</p>
                </div>
                {!! Form::model(new App\AvtPanicRequest, ['route' => ['panic_requests.submit'], 'class' => 'form-group', 'files' => true]) !!}
                    @include('panic_requests/form_register', ['submit_text' => 'Submit Enrolment Form'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
