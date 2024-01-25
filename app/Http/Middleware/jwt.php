<?php

namespace App\Http\Middleware;

use App\Http\Controllers\userController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class jwt
{
    protected $userController;

    public function __construct(UserController $userController){
        $this->userController = $userController;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if(!$this->userController->decodeToken($request->bearerToken())){
            $this->userController->sendNotify("Se intento acceder a una ruta sin authorizacion");
            return response()->json([
                "msg" => "Token no authorizado"
            ], 401);
        }
        return $next($request);
    }   
}
