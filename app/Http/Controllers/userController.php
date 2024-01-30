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
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use PhpOption\None;

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


    function edit($id, Request $request ){

        $validate = Validator::make($request->all(), [
            'name' => 'min:4|max:255|regex:/^[^0-9]+$/|nullable',
            'email' => 'email|max:255|nullable',
            'phone' => 'min:10|max:10|nullable',
            'role' => 'in:admin,user|nullable',
        ], [

            'name.regex' => 'El nombre no puede contener numeros',
            'name.min' => 'El nombre debe tener al menos 4 caracteres',
            'name.max' => 'El nombre debe tener menos de 255 caracteres',

            'email.email' => 'El email no es valido',
            'email.max' => 'El email debe tener menos de 255 caracteres',

            'phone.min' => 'El telefono debe tener 10 caracteres',
            'phone.max' => 'El telefono debe tener 10 caracteres',

            'role.in' => 'El rol debe ser admin o usuario',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user = User::where('id', $id)->first();

        $user->name = $request->input('name') ?? $user->name;
        $user->phone = $request->input('phone') ?? $user->phone;
        $user->email = $request->input('email') ?? $user->email;
        $user->role = $request->input('role') ?? $user->role;
        $user->is_active = $request->input('is_active') ?? $user->is_active;
        
        $user->save();
        $this->sendNotify("Se edito el usuario de nombre ".$user->name);
        return redirect('/edit')->with('status', 'User created successfully!');

    }



    function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255|alpha',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/',
            'phone' => 'required|min:10|max:10',
        ], [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 4 caracteres',
            'name.max' => 'El nombre debe tener menos de 255 caracteres',
            'name.alpha' => 'El nombre no puede contener caracteres especiales',

            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es valido',
            'email.unique' => 'El email ya esta registrado',
            'email.max' => 'El email debe tener menos de 255 caracteres',
            
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres ',
            'password.regex' => ' la contraseña debe contener al menos una letra mayúscula y un carácter especial (@, #, $,%, ^, &, *, (,))',

            
            'phone.required' => 'El telefono es requerido',
            'phone.min' => 'El telefono debe tener 10 caracteres',
            'phone.max' => 'El telefono debe tener 10 caracteres',
            'phone.regex' => 'El telefono debe tener el formato +52 1 55 5555 5555',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role') ?? 'user';
        $user->phone = $request->input('phone');
        $user->is_active = $request->input('is_active') ?? false;
        $user->save();

        $this->sendNotify("Se registro el usuario");
        return redirect('/')->with('status', 'User created successfully!');
    }

}
