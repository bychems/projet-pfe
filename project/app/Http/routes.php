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

   Route::get('/',['as'=>'carIndex','middleware' => ['permission:carIndex'], 'uses'=>'CarsController@index']);
   Route::post('add-car',['as'=>'carStore','middleware' => ['permission:carStore'], 'uses'=>'CarsController@store']);
   Route::get('edit/{id}',[ 'as'=>'carEdit', 'uses'=>'CarsController@edit']);
   Route::put('update/{id}',[ 'as'=>'carUpdate', 'uses'=>'CarsController@update']);
   Route::get('list',['as'=>'carList','middleware' => ['permission:carList'], 'uses'=>'CarsController@listcars']);
   Route::get('delete/{id}',['as'=>'carDelete','middleware' => ['permission:carDelete'], 'uses'=>'CarsController@destroy']);
   Route::get('carListTestDrive',['as'=>'carListTestDrive','middleware' => ['permission:carListTestDrive'], 'uses'=>'CarsController@listcarstestdrive']);
   Route::get('affiche/{id}',['as'=>'carAffiche','middleware' => ['permission:carAffiche'], 'uses'=>'CarsController@affiche']);
   Route::post('add-devis',['as'=>'devisStore','middleware' => ['permission:devisStore'], 'uses'=>'QuotationsController@storeDevis']);
   Route::get('/offlineQuotations',['as'=>'OfflineQuotationIndex','middleware' => ['permission:OfflineQuotationIndex'], 'uses'=>'QuotationsController@OfflineQuotationIndex']);
   Route::post('add-quotation-offline', ['as'=>'addQuotationOffline','middleware' => ['permission:addQuotationOffline'], 'uses'=>'QuotationsController@storeQuotationOffline']);
   Route::get('getfinition/{id}',['as'=>'getfinition', 'uses'=>'CarsController@getFinition']);
   Route::get('list_quotations',['as'=>'list_quotations', 'uses'=>'QuotationsController@list_quotations']);
});


//  Routes of Catégories
Route::group(['prefix'=>'dashboard/categories',  'middleware' => ['web']], function(){

   Route::get('/',['as'=>'categoryIndex','middleware' => ['permission:categoryIndex'], 'uses'=>'CategoriesController@index']);
   Route::post('/add-category',['as'=>'categoryStore','middleware' => ['permission:categoryStore'], 'uses'=>'CategoriesController@store']);
   Route::post('/addoption',['as'=>'addoption','middleware' => ['permission:addoption'], 'uses'=>'CategoriesController@addOpCat']);
  // Route::post('/destroyCat',['as'=>'destroyCat', 'uses'=>'CategoriesController@destroy']);
   Route::get('/destroyCat/{id}',array('uses' => 'CategoriesController@destroyCat','middleware' => ['permission:destroyCat'], 'as' => 'destroyCat'));
   Route::get('/destroyOpt/{id}',array('uses' => 'CategoriesController@destroyOpt','middleware' => ['permission:destroyOpt'], 'as' => 'destroyOpt'));
  
});


//  Routes of TestDrive
Route::group(['prefix'=>'dashboard/testDrive',  'middleware' => ['web']], function(){

   Route::get('/',['as'=>'testDriveIndex','middleware' => ['permission:testDriveIndex'], 'uses'=>'TestDrivesController@index']);
   Route::post('/addDisponibility',['as'=>'adddisp','middleware' => ['permission:adddisp'], 'uses'=>'TestDrivesController@store']);
   Route::get('/Calendar/{id}',['as'=>'Calendar','middleware' => ['permission:Calendar'], 'uses'=>'TestDrivesController@showCalendar']);
   Route::get('/hours/{date}/{car}',['as'=>'hours','middleware' => ['permission:hours'], 'uses'=>'TestDrivesController@showHours']);
   Route::post('/supp-day/{id}',['as'=>'supp-day','middleware' => ['permission:supp-day'], 'uses'=>'TestDrivesController@destroy']);
   Route::post('/add-hour/{id}',['as'=>'add-hour','middleware' => ['permission:add-hour'], 'uses'=>'TestDrivesController@addHour']);
   Route::get('/cancel-hour/{id}/{id2}',['as'=>'cancel-hour','middleware' => ['permission:cancel-hour'], 'uses'=>'TestDrivesController@cancelHour']);

});

//  Routes of Customers
Route::group(['prefix'=>'dashboard/customers','middleware' => ['web']], function(){
   Route::get('/',['as'=>'addcustomerIndex','middleware' => ['permission:addcustomerIndex'], 'uses'=>'CustomersController@index']);
   Route::post('addcustomer', ['as'=>'addcustomer','middleware' => ['permission:addcustomer'], 'uses'=>'CustomersController@store']);
   Route::get('list',['as'=>'listCustomers','middleware' => ['permission:listCustomers'], 'uses'=>'CustomersController@listcustomers']);
   Route::get('affiche/{id}',['as'=>'afficheCustomer','middleware' => ['permission:afficheCustomer'], 'uses'=>'CustomersController@affiche']);
   Route::get('edit/{id}',['as'=>'editcustomer','middleware' => ['permission:editcustomer'], 'uses'=>'CustomersController@edit']);
   Route::put('update/{id}',['as'=>'updatecustomer','middleware' => ['permission:updatecustomer'], 'uses'=>'CustomersController@update']);
   Route::get('/offlineCustomers',['as'=>'OfflineCustomerIndex','middleware' => ['permission:OfflineCustomerIndex'], 'uses'=>'CustomersController@OfflineCustomerIndex']);
   Route::post('addcustomerOffline', ['as'=>'addcustomerOffline','middleware' => ['permission:addcustomerOffline'], 'uses'=>'CustomersController@storeOffline']);
});

//  Routes of Users
Route::group(['prefix'=>'dashboard/','middleware' => ['web']], function(){
   Route::get('adduser',['as'=>'addUser','middleware' => ['permission:addUser'], 'uses'=>'UsersController@index']);
   Route::post('storeuser', ['as'=>'storeUser','middleware' => ['permission:storeUser'], 'uses'=>'UsersController@store']);
   Route::get('profiluser', ['as'=>'profilUser','middleware' => ['permission:profilUser'], 'uses'=>'UsersController@profil']);
   Route::get('detailuser/{id}', ['as'=>'detailUser','middleware' => ['permission:detailUser'], 'uses'=>'UsersController@detailUser']);
   Route::put('update/{id}',['as'=>'updateUser','middleware' => ['permission:updateUser'], 'uses'=>'UsersController@update']);
   Route::get('addrolepermission',['as'=>'addRolePermission', 'uses'=>'UsersController@rolePermissionIndex']);
   Route::post('storerole',['as'=>'storeRole', 'uses'=>'UsersController@RoleStore']);
   Route::post('storepermission',['as'=>'storePermission', 'uses'=>'UsersController@PermissionStore']);
   Route::post('storerolepermission',['as'=>'storeRolePermission', 'uses'=>'UsersController@rolePermissionStore']);
   Route::get('rolepermission/{id_role}',['as'=>'getRolePermission', 'uses'=>'UsersController@getRolePermission']);
   Route::get('parametresuser', ['as'=>'parametresuser','middleware' => ['permission:parametresUtilisateur'], 'uses'=>'UsersController@parametres']);
   Route::get('list_users',['as'=>'list_users', 'uses'=>'UsersController@list_users']);

});


//  Routes of Front
Route::group(['prefix'=>'front',  'middleware' => ['web']], function(){

   Route::get('/',['as'=>'homepageIndex', 'uses'=>'UsersController@frontIndex']);
   Route::get('/getcategories/{id_car}',['as'=>'getcategories', 'uses'=>'UsersController@getCategoriesFront']);

});


Route::get('/p', function () {
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

    Route::get('/dashboard', ['as'=>'home', 'uses'=>'HomeController@index']);
});
