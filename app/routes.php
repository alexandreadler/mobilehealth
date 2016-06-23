<?php

Route::get( 'users/create',                 'UsersController@getCreate');
Route::get( 'users/login',                  'UsersController@getLogin');
Route::post('users/login',                  'UsersController@postLogin');

Route::post('users',                        'UsersController@postIndex');
Route::get( 'users/logout',                 'UsersController@getLogout');

Route::controller( 'users', 'UsersController');
Route::controller( 'supervisor', 'SupervisorController');
Route::controller( 'supervisor/locuraA', 'SupervisorController');



// Rota para um arquivo
Route::get("grafico", 
	function() {  ob_start();
		require("grafico.php");
		return ob_get_clean(); 

	}
);


Route::group(array('before' => 'auth'), function()
{
	Route::get( '/','AppController@getHome');
	
	Route::controller( 'app', 'AppController');
	
	Route::controller( 'profile', 'ProfileController');
	Route::controller( 'phr', 'PhrController');
	
	
	Route::get('{resource}/{method}/{param1?}/{param2?}/{param3?}/{param4?}', function($resource, $method)
	{
		$controllerName = ucfirst($resource).'Controller';
		$controller = new $controllerName;
		return $controller->{$method}();
	});

});

//Confide RESTful route
Route::get('users/confirm/{code}', 'UsersController@getConfirm');
Route::get('users/reset_password/{token}', 'UsersController@getReset');
Route::get('users/reset_password', 'UsersController@postReset');

