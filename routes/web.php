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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('403', 'ErrorController@pageNotFound')->name('403');

Route::get('403-login', 'ErrorController@loginError')->name('403-login');

Route::get('/', 'HomeController@index');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('home', 'HomeController');

/*
Route::resource('ima-event', 'ImaEventController');
Route::get('ima-event/ima-event-details-print/{id}', 'ImaEventController@print_event_details');
*/

Route::resource('ima-event', 'EventsDetailController');
Route::get('ima-event/ima-event-details-print/{id}', 'EventsDetailController@print_event_details');
Route::get('ima-event/ima-event-email/{id}', 'EventsDetailController@event_email');
Route::post('ima-event/ima-event-attendees-ajax/', 'EventsDetailController@event_attendees_ajax');

Route::get('ima-event-home', 'ImaEventController@index')->name('ima-event-home');

Route::resource('events-details', 'EventsDetailController');

Route::resource('event-attendee', 'EventAttendeeController');

Route::resource('event-settings', 'EventsSettingsController');
Route::get('event-general-settings', 'EventsSettingsController@settings');

Route::resource('api-sync', 'ApiSyncController');
Route::get('api-sync-auto-events', 'ApiSyncController@api_sync_auto_events');
Route::get('api-sync-auto-attendees', 'ApiSyncController@api_sync_auto_attendees');
Route::get('api-sync-auto-time', 'ApiSyncController@api_sync_auto_events_time');
Route::get('api-sync-auto-price', 'ApiSyncController@api_sync_auto_events_price');
Route::get('api-force-sync-all', 'ApiSyncController@force_sync_all');
Route::get('api-force-sync-all-new-db', 'ApiSyncController@force_sync_all_new_db');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return redirect('ima-event');
});
