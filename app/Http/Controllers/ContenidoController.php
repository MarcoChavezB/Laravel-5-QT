<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\userController;




class ContenidoController extends Controller
{
    protected $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    public function index()
    {
        $users = User::all();
        return view('principal.users', ['users' => $users]);
    }

    public function create()
    {
        return view('principal.register');
    }

    public function edit(){
        $users = User::all();
        return view('principal.editUser', ['users' => $users]);
    }
    
    public function about(){
        return view('principal.about');
    }
    public function destroy($userId){
        $user = User::find($userId);
        $user->delete();
        $this->userController->sendNotify("Se elimino el usuario " . $user->name . " correctamente");
        return redirect("/");
    }

}
