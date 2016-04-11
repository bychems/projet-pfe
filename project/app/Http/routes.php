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
Route::group(['prefix'=>'dashboard/cars',  'middleware' => ['web']], function(){

   Route::get('/',['as'=>'carIndex', 'uses'=>'CarsController@index']);
   Route::post('add-car',['as'=>'carStore', 'uses'=>'CarsController@store']);
   Route::put('edit',['as'=>'carEdit', 'uses'=>'CarsController@edit']);
   Route::get('list',['as'=>'carList', 'uses'=>'CarsController@listcars']);
   Route::delete('supp/{id}',['as'=>'carDelete', 'uses'=>'CarsController@destroy']);
   Route::get('carListTestDrive',['as'=>'carListTestDrive', 'uses'=>'CarsController@listcarstestdrive']);
   Route::get('affiche/{id}',['as'=>'carAffiche', 'uses'=>'CarsController@affiche']);
   Route::get('devis/{id}',['as'=>'creerDevis', 'uses'=>'CarsController@devis']);
   Route::post('add-devis',['as'=>'devisStore', 'uses'=>'QuotationsController@storeDevis']);
   Route::get('/offlineQuotations',['as'=>'OfflineQuotationIndex', 'uses'=>'QuotationsController@OfflineQuotationIndex']);
   Route::post('add-quotation-offline', ['as'=>'addQuotationOffline', 'uses'=>'QuotationsController@storeQuotationOffline']);
});


//  Routes of Catégories
Route::group(['prefix'=>'dashboard/categories',  'middleware' => ['web']], function(){

   Route::get('/',['as'=>'categoryIndex', 'uses'=>'CategoriesController@index']);
   Route::post('/add-category',['as'=>'categoryStore', 'uses'=>'CategoriesController@store']);
   Route::post('/addoption',['as'=>'addoption', 'uses'=>'CategoriesController@addOpCat']);
  // Route::post('/destroyCat',['as'=>'destroyCat', 'uses'=>'CategoriesController@destroy']);
   Route::get('/destroyCat/{id}',array('uses' => 'CategoriesController@destroyCat', 'as' => 'destroyCat'));
   Route::get('/destroyOpt/{id}',array('uses' => 'CategoriesController@destroyOpt', 'as' => 'destroyOpt'));
  
});


//  Routes of TestDrive
Route::group(['prefix'=>'dashboard/testDrive',  'middleware' => ['web']], function(){

   //  Routes of TestDrive

   Route::get('/',['as'=>'testDriveIndex', 'uses'=>'TestDrivesController@index']);
   Route::post('/addDisponibility',['as'=>'adddisp', 'uses'=>'TestDrivesController@store']);
   Route::get('/Calendar/{id}',['as'=>'Calendar', 'uses'=>'TestDrivesController@showCalendar']);
   Route::get('/hours/{date}/{car}',['as'=>'hours', 'uses'=>'TestDrivesController@showHours']);
   Route::post('/supp-day/{id}',['as'=>'supp-day', 'uses'=>'TestDrivesController@destroy']);
   Route::post('/add-hour/{id}',['as'=>'add-hour', 'uses'=>'TestDrivesController@addHour']);
   Route::get('/cancel-hour/{id}/{id2}',['as'=>'cancel-hour', 'uses'=>'TestDrivesController@cancelHour']);


});

//  Routes of Customers
Route::group(['prefix'=>'dashboard/customers','middleware' => ['web']], function(){
   Route::get('/',['as'=>'addcustomerIndex', 'uses'=>'CustomersController@index']);
   Route::post('addcustomer', ['as'=>'addcustomer', 'uses'=>'CustomersController@store']);
   Route::get('list',['as'=>'listCustomers', 'uses'=>'CustomersController@listcustomers']);
   Route::get('affiche/{id}',['as'=>'afficheCustomer', 'uses'=>'CustomersController@affiche']);
   Route::get('edit/{id}',['as'=>'editcustomer', 'uses'=>'CustomersController@edit']);
   Route::put('update/{id}',['as'=>'updatecustomer', 'uses'=>'CustomersController@update']);
   Route::post('/add-hour/{id}',['as'=>'add-hour', 'uses'=>'TestDrivesController@addHour']);
   Route::get('/offlineCustomers',['as'=>'OfflineCustomerIndex', 'uses'=>'CustomersController@OfflineCustomerIndex']);
   Route::post('addcustomerOffline', ['as'=>'addcustomerOffline', 'uses'=>'CustomersController@storeOffline']);
});

//  Routes of Users
Route::group(['prefix'=>'dashboard/','middleware' => ['web']], function(){
   Route::get('adduser',['as'=>'addUser', 'uses'=>'UsersController@index']);
   Route::post('storeuser', ['as'=>'storeUser', 'uses'=>'UsersController@store']);
   Route::get('profiluser', ['as'=>'profilUser', 'uses'=>'UsersController@profil']);
   Route::get('detailuser/{id}', ['as'=>'detailUser', 'uses'=>'UsersController@detailUser']);
   Route::put('update/{id}',['as'=>'updateUser', 'uses'=>'UsersController@update']);

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

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', ['as'=>'home', 'uses'=>'HomeController@index']);
});
