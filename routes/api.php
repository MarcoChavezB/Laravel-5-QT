<?php

use App\Http\Controllers\filesController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\userController;
use App\Http\Middleware\jwt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas API para tu aplicación. Estas
| rutas son cargadas por RouteServiceProvider dentro de un grupo que
| se asigna al grupo de middleware "api". ¡Disfruta construyendo tu API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// * AUTH JWT
Route::middleware([jwt::class])->group(function () {
    Route::get('/userJWT', [userController::class, 'userJWT']);
    Route::get("/tryToken", [UserController::class, 'getInfo']);
    Route::post('/sendFile', [filesController::class, 'sendFile']);
    Route::get('/getAllfiles', [filesController::class, 'getAllfiles']);
});

Route::get('/getFile/{filePath}', [filesController::class, 'getFile']);


Route::middleware([jwt::class])->group(function (){
    Route::get('/usuarioSanctum', [userController::class, 'usuarioSanctum']);
});


//* Mandando notificacion por slack
Route::get('/sendNotification', [notificationController::class, 'sendNotification']);
Route::get('/testError', [notificationController::class, 'testError']);
Route::post('/register', [userController::class, 'register']);
Route::post('/loginJWT', [userController::class, 'loginJWT']);
Route::post('/loginSan', [userController::class, 'loginSanctum']);



