<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UsersController extends Controller
{

 
    public function register(Request $request){
        $user=new User();
        $user->name=$request->nom;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect('/')->with('success','Compte créer');

    }

    public function create(){
        return view('users.create');

    }

    public function login(){
        return view('users.login');
    }

    public function auth(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
        return redirect('/');}
        else{
            return redirect()->route('users.login')->with('fail','Email ou mot de passe est incorrecte');
        }
    }

    public function logout(Request $request){

        Auth::logout();
        return redirect('/');

    }
}
