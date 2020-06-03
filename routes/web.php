<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$link_id = (int) config('var.link_id');

Route::get('/', [
    'as' => 'welcome', 'uses' => 'WelcomeController@index'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Admin,ControlRoom']);

Route::post('panic_requests/{panic_request}/treat', [
    'as' => 'panic_requests.treat', 'uses' => 'PanicRequestsController@treat'
])->middleware(['auth.user', 'auth.access:'.$link_id.',ControlRoom']);
Route::post('panic_requests/submit', [
    'as' => 'panic_requests.submit', 'uses' => 'PanicRequestsController@submit'
]);
Route::get('panic_requests/enrol', [
    'as' => 'panic_requests.enrol', 'uses' => 'PanicRequestsController@enrol'
]);
Route::get('panic_requests/pending', [
    'as' => 'panic_requests.pending', 'uses' => 'PanicRequestsController@pending'
])->middleware(['auth.user', 'auth.access:'.$link_id.',ControlRoom']);
Route::get('panic_requests/active', [
    'as' => 'panic_requests.active', 'uses' => 'PanicRequestsController@active'
])->middleware(['auth.user', 'auth.access:'.$link_id.',ControlRoom']);
Route::get('panic_requests/{panic_request}/view', [
    'as' => 'panic_requests.view', 'uses' => 'PanicRequestsController@view'
])->middleware(['auth.user', 'auth.access:'.$link_id.',ControlRoom,Admin']);
Route::bind('panic_requests', function($value, $route) {
    return App\AvtPanicRequest::findBySlug($value)->first();
});
