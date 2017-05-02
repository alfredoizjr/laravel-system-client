<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

/* rutes resources clients in workers*/

Route::resource('clients','clients\ClientsController');
Route::get('/actives', 'clients\ClientsController@actives');
Route::get('/deactivated', 'clients\ClientsController@deactivated');
Route::get('/do-date-client', 'clients\ClientsController@witDoDate');
Route::get('/statusd/{id}', 'clients\ClientsController@status_d');
Route::get('/statusa/{id}', 'clients\ClientsController@status_a');
Route::get('/statusp/{id}', 'clients\ClientsController@status_p');
Route::get('/folder/{id}', ['as'=>'folder','uses'=>'clients\ClientsController@folder']);
Route::post('client-service/{id}',['as'=>'client-service','uses'=>'clients\ClientsController@insertService']);
Route::post('client-service-delete/{id}',['as'=>'client-service-delete','uses'=>'clients\ClientsController@deleteService']);


/* rutes resources clients in workers*/

/*   rutes resources services      */
/*-------------------------------------------------------------------------------------------*/
/*----------the edit and update is desable but we can call if we put the routes here----------*/
/*-------------------------------------------------------------------------------------------*/

/* -------------------------*/
/* rutes resources history---*/
/* -------------------------*/
Route::get('history/{id}','history\HistoryClientController@show');
Route::post('history','history\HistoryClientController@search');

/* rutes resources services*/
Route::resource('services','services\ServiceController',[
                                                          'only'=>['index','store','destroy']
                                                         ]);

/* -------------------------*/
/* rutes resources task-----*/
/* -------------------------*/

Route::resource('task','task\TaskController');
Route::get('task-in-client/{id}','task\TaskController@create_in_client');
Route::get('close-task/{id}','task\TaskController@closeTask');
Route::get('close-task','task\TaskController@showCloseTask');
Route::get('delete-task/{id}','task\TaskController@delete');


/* -------------------------*/
/* rutes email controller-----*/
/* -------------------------*/

Route::get('email','email\EmailClientsController@index');
Route::post('send-to','email\EmailClientsController@emailData');
Route::post('send','email\EmailClientsController@sendEmail');


/* -------------------------*/
/* rutes user manager-----*/
/* -------------------------*/

Route::resource('user','user\UserManagerController');
Route::get('user-delete/{id}','user\UserManagerController@delete');
Route::get('get-admin/{id}','user\UserManagerController@GetpermissionAdmin');
Route::get('remove-admin/{id}','user\UserManagerController@RemovepermissionAdmin');

/* -------------------------*/
/* rutes user reminder-----*/
/* -------------------------*/
Route::resource('reminder','reminder\ReminderController');
Route::get('reminder/delete/{id}','reminder\ReminderController@destroy');

/* ----------------------------------------*/
/* rutes extra information for clients-----*/
/* ---------------------------------------*/
Route::resource('extra','extra\ExtraInformationController');
Route::get('extra/create/{id}','extra\ExtraInformationController@insert_domain_name');
Route::get('extra-resource/create/{id}','extra\ExtraInformationController@insert_extra_resource');
Route::Post('extra-resource-insert','extra\ExtraInformationController@store_extra_resource');
/* rutes extra information domain name-----*/
Route::get('extra/show-edit/{id}','extra\ExtraInformationController@show_domain_name');
Route::Post('extra/update-domain-name/{id}','extra\ExtraInformationController@update_domain_name');
Route::get('extra/destroy-domain-name/{id}','extra\ExtraInformationController@destroy_domain_name');
/* rutes extra information for extra resurce-----*/
Route::get('extra/show-extra-resource/{id}','extra\ExtraInformationController@show_extra_resource');
Route::Post('extra/update-extra-resource/{id}','extra\ExtraInformationController@update_extra_resource');
Route::get('extra/destroy-extra-resource/{id}','extra\ExtraInformationController@destroy_extra_resource');
/* rutes extra information for Directory business-----*/
Route::get('extra/show-bisiness-directory/{id}','extra\ExtraInformationController@insert_business_directory');
Route::Post('extra/store-domain-name/','extra\ExtraInformationController@store_business_directory');
Route::get('extra/show-business-directory/{id}','extra\ExtraInformationController@show_business_directory');
Route::Post('extra/update-business-directory/{id}','extra\ExtraInformationController@update_business_directory');
Route::get('extra/destroy-business-directory/{id}','extra\ExtraInformationController@destroy_business_directory');





/* ----------------------------------------*/
/* --------rutes profile users------------*/
/* ---------------------------------------*/
Route::resource('profile','profile\ProfileController');
Route::get('change-password-form','profile\ProfileController@changePasswordForm');
Route::post('change-password','profile\ProfileController@changePassword');
Route::post('avatar','profile\ProfileController@updateAvatar');




/* ----------------------------------------*/
/* --------rutes do date------------*/
/* ---------------------------------------*/
Route::resource('do-date','date\DoDateController');


/* ----------------------------------------*/
/* --------request url by admin------------*/
/* ---------------------------------------*/
Route::resource('request','Request\RequestController');
Route::get('request-close','Request\RequestController@closeRequest');
Route::get('request/close/{id}','Request\RequestController@Actionclose');
Route::get('request/reopen/{id}','Request\RequestController@ActionReopenRequest');
Route::get('request-close/{id}','Request\RequestController@ShowcloseRequest');
/* ----------------------------------------*/
/* --------request url for user------------*/
/* ---------------------------------------*/
Route::resource('request-user','user_request\RequestUserController');
/* ----------------------------------------*/
/* --------request url archives------------*/
/* ---------------------------------------*/
Route::get('archive/delete/{id}','archive\ArchiveController@delete');
Route::post('add/archive','archive\ArchiveController@add');
