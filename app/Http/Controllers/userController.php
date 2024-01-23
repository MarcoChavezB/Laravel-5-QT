<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use App\Notifications\SlackNotification;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class userController extends Controller
{

    // ! Herramientas 

    public function sendNotify($message)
    {
        Notification::route('slack', env('SLACK_WEBHOOK_URL'))
            ->notify(new SlackNotification($message));
    }

    public function decodeToken($jwt){
        try {
             JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    } 

    public function getTokenId($jwt){
        $decodedUser = JWT::decode($jwt, new Key(env('JWT_SECRET'), 'HS256'));
        $userId = $decodedUser->id;
        $user = User::find($userId);
        return $user;
    } 


    // !


    function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $this->sendNotify("Se registro el usuario");

        return response()->json(['user' => $user, 'msg' => 'User created successfully!', 200]);
    }

    function loginJWT(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            $this->sendNotify("Wrong email or passwod");

            return response()->json(['msg' => 'Wrong email or password!'], 404);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            $this->sendNotify("Wrong email or passwod");

            return response()->json(['msg' => 'Wrong email or password!'], 404);
        }

        $jwt = JWT::encode(['id' => $user->id], env('JWT_SECRET'), 'HS256');
        $this->sendNotify("Usuario logeado con JWT");

        return response()->json(['token' => $jwt, 'msg' => 'User logged in successfully!']);
    }

    function loginSanctum(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            $this->sendNotify("Wrong email or passwod");

            return response()->json(['msg' => 'Wrong email or password!'], 404);
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            $this->sendNotify("Wrong email or passwod");
            return response()->json(['msg' => 'Wrong email or password!'], 404);
        }

        $token = $user->createToken('TOKEN')->plainTextToken;

        $this->sendNotify("Usuario logeado con Sanctum");
        return response()->json(['token' => $token, 'msg' => 'User logged in successfully with Sanctum!']);
    }

    function usuarioSanctum(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $pat = PersonalAccessToken::findToken($token);


            $userId = $pat->tokenable_id;

            $user = DB::table('users')->where('id', $userId)->first();

            $this->sendNotify("Se mostró la información del usuario");

            return response()->json(['user' => $user]);
        } catch (\Throwable $th) {
            $this->sendNotify("Token Sanctum no valido");
            return response()->json(['msg' => 'Invalid token!'], 401);
        }
    }

    function userJWT(Request $request)
    {
        $jwt = $request->bearerToken();

        try {
            $user = $this->decodeToken($jwt);

            $this->sendNotify("Se mostro la inforamcion del usuario");
            return response()->json(['user' => $user]);
        } catch (\Throwable $th) {
            $this->sendNotify("Token JWT no valido");
            return response()->json(['msg' => 'Invalid token!'], 401);
        }
    }
}
