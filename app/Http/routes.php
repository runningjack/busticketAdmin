<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function() {
    Route::get('/',"DashboardController@index");
    Route::get('/dashboard', "DashboardController@index");
    Route::post("/","DashboardController@store");
    //Route::get('/',"DashboardController@RouteAutocomplete");

    Route::get("buses/index","BusController@index");
    Route::post("buses/index","BusController@store");


    Route::get("routes/index","RouteController@index");
    Route::post("routes/index","RouteController@store");
    Route::post("routes/routeupdate/{id?}","RouteController@update");
    Route::post("routes/routedelete/{id?}","RouteController@destroy");
    Route::get("routes/routedetails/{id?}","RouteController@show");
    Route::get("routes/addbusstop/{id?}","RouteController@getBusStop");
    Route::post("routes/addbusstop","RouteController@addBusStop");

    Route::get("merchants/index","MerchantController@index");
    Route::post("merchants/index","MerchantController@store");
    Route::get("merchants/merchantdetails/{id?}","MerchantController@show");
    Route::post("merchants/merchantdetails/{id?}","MerchantController@addBusStop");
    Route::get('merchants/autocomplete/{id?}',"MerchantController@routeAutocomplete");
    Route::post('merchants/autocomplete/{id?}',"MerchantController@addBusStop");


    Route::get("administrators/index","UserController@index");
    Route::get("administrators/addnew","UserController@create");
    Route::post("administrators/addnew","UserController@store");
    Route::get("administrators/edituser/{id}","UserController@edit");
    Route::post("administrators/edituser/{id}","UserController@update");
    Route::post("administrators/deleteuser/{id}","UserController@destroy");

    Route::get("tickets/index","TicketController@index");
    Route::post("tickets/index","TicketController@store");

    Route::get("privileges/index","PrivilegeController@index");
    Route::post("privileges/index","PrivilegeController@store");
    Route::post("privileges/editrole/{id?}","PrivilegeController@update");
});
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

