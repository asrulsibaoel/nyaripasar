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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::match(['POST', 'GET'], '/register-user', function (\Illuminate\Http\Request $request) {
    if ($request->getMethod() == "POST") {
        try {
            /** @var \App\Jobs\AddUserCommand $command ; */
            $command = \App\Jobs\AddUserCommand::createFromHttpRequest($request);
//            Log::debug(print_r($command, true));
            dispatch($command);
        } catch (Exception $e) {
            \Log::debug($e->getMessage());
        }
        return "hooray";
    }
});

Route::post('get-login', function (\Illuminate\Http\Request $request) {

    $user = [];

    try {
        $command = \App\Jobs\UserLogin::createFromHttpRequest($request);
        dispatch($command);
    } catch (\Exception $e) {
        return new \Illuminate\Http\JsonResponse([
            'error' => $e->getMessage()
        ]);
    }

    return new \Illuminate\Http\JsonResponse([
        'error' => 0,
        'user' => $user
    ]);
});