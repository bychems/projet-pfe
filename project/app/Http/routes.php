<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//  Routes of Cars
Route::group(['prefix'=>'dashboard/cars','middleware' => ['web']], function(){
    Route::get('/',['as'=>'addcarIndex', 'uses'=>'CarsController@index']);
    Route::post('add-car', ['as'=>'savecar', 'uses'=>'CarsController@store']);
    Route::put('edit','CarsController@edit');
    Route::get('list',['as'=>'listCars', 'uses'=>'CarsController@listcars']);
    Route::get('affiche/{id}',['as'=>'afficheCar', 'uses'=>'CarsController@affiche']);


});

//  Routes of Catégories
Route::group(['prefix'=>'dashboard/categories','middleware' => ['web']], function(){
Route::get('/',['as'=>'addcategorieIndex', 'uses'=>'CategoriesController@index']);
Route::post('add-categorie',['as'=>'addcategorieStore', 'uses'=>'CategoriesController@store']);
Route::post('addoption',['as'=>'addoption', 'uses'=>'CategoriesController@addOpCat']);
});


//  Routes of Customers
Route::group(['prefix'=>'dashboard/customers','middleware' => ['web']], function(){
Route::get('/',['as'=>'addcustomerIndex', 'uses'=>'CustomersController@index']);
Route::post('addcustomer', ['as'=>'addcustomer', 'uses'=>'CustomersController@store']);
Route::get('list',['as'=>'listCustomers', 'uses'=>'CustomersController@listcustomers']);
Route::get('affiche/{id}',['as'=>'afficheCustomer', 'uses'=>'CustomersController@affiche']);
Route::get('edit/{id}',['as'=>'editcustomer', 'uses'=>'CustomersController@edit']);
Route::put('update/{id}',['as'=>'updatecustomer', 'uses'=>'CustomersController@update']);
});


Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

