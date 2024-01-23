<?php

use App\Http\Controllers\filesController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\userController;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

//* Autenticación con JWT
Route::get('/userJWT', [userController::class, 'userJWT']);

//* Authentificacion con Sanctum
Route::get('/usuarioSanctum', [userController::class, 'usuarioSanctum'])->middleware('auth:sanctum');

//* Mandando notificacion por slack
Route::get('/sendNotification', [notificationController::class, 'sendNotification']);
Route::get('/testError', [notificationController::class, 'testError']);

Route::post('/register', [userController::class, 'register']);
Route::post('/loginJWT', [userController::class, 'loginJWT']);
Route::post('/loginSan', [userController::class, 'loginSanctum']);


Route::post('/sendFile', [filesController::class, 'sendFile']);

// * regresar el nombre de todos los archovos que se tienen guardados - ruta 2
Route::get('/getAllfiles', [filesController::class, 'getAllfiles']);

// * pasar el parametro el nombre y ese archivo mostrarlo en insomnia  - ruta 3
Route::get('/getFile/{fileName}', [filesController::class, 'getFile']);

