<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use Image;
use Storage;
use Mail;
use App\AvtPanicRequest;
use Carbon\Carbon;

class PanicRequestsController extends Controller
{
    public function enrol() {
        return view('general.enrol');
    }

    public function submit(Request $request) {
        $input = $request->input();
        $error = "";
        $existing_panic_requests = AvtPanicRequest::where('email', $input['email'])->whereIn('status', ['Pending', 'Activated']);
        if ($existing_panic_requests->count() != 0) {
            $error .= "An earlier submission was made with the specified email address.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<span class="font-weight-bold">Sorry, we could not submit your data!</span><br />'.$error)
                    ->withInput();
        } else {
            unset($input['terms']);
            $input['title'] = strtoupper($input['title1']);
            unset($input['title1']);
            $input['first_name'] = strtoupper($input['first_name']);
            $input['surname'] = strtoupper($input['surname']);
            $input['status'] = "Pending";
            $panic_request = AvtPanicRequest::create($input);
            if ($panic_request) {
                return view('general.submit', compact('panic_request'));
            } else {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Sorry, we could not submit your data!</span><br />Please visit our website for more information.')
                        ->withInput();
            }
        }
    }

    public function pending() {
        $panic_requests = AvtPanicRequest::where('status', 'Pending')->get();
        return view('panic_requests.pending', compact('panic_requests'));
    }

    public function active() {
        $panic_requests = AvtPanicRequest::where('status', 'Active')->get();
        return view('panic_requests.active', compact('panic_requests'));
    }

    public function view(AvtPanicRequest $panic_request) {
        return view('panic_requests.view', compact('panic_request'));
    }

    public function treat(AvtPanicRequest $panic_request, Request $request) {
        $input = $request->input();
        $employee = UtilsController::getEmployee();
        $input['treated_at'] = Carbon::now();
        $input['treated_by'] = $employee->id;

        $panic_request->update($input);

        $panic_request_name = $panic_request->first_name.' '.$panic_request->surname;
        if ($panic_request->title) {
            $panic_request_name = $panic_request->title.' '.$panic_request_name;
        }

        if ($input['status'] == 'Active') {
            $panic_credentials = [
                'name' => $panic_request_name,
                'app_link' => 'http://halogengms.com/halogen.apk',
                'username' => $input['username'],
                'password' => $input['password']
            ];

            $panic_request_email = $panic_request->email;

            Mail::send('emails.panic_credentials', $panic_credentials, function ($m) use ($panic_request_email) {
                $m->from('hens@halogensecurity.com', 'Halogen Group');
                $m->to($panic_request_email)->subject('Credentials | Panic Alarm Service');
            });

            return Redirect::route('panic_requests.view', [$panic_request->slug()])
                    ->with('success', '<span class="font-weight-bold">Completed!</span><br />You have successfully treated the pending request.');
        }
    }
}
