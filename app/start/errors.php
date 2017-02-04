<?php

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

function show_error_page($msg,$code) {
	return Response::view('errors.error', compact('msg','code'));
}

//App::error(function(Exception $exception, $code)
//{
//	Log::error($exception);
//
//	return show_error_page($exception->getMessage().". Line: ".$exception->getLine(),$code);
//});
//
//App::error(function(\Illuminate\Database\Eloquent\ModelNotFoundException $exception, $code)
//{
//	Log::error($exception);
//	return show_error_page('Entidade não encontrada',$code);
//
//});

