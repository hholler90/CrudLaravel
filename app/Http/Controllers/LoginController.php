<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $redirectTo = '/';
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('auth.login');
        
    }
    public function formulario($id)
    {
        
    }
    public function login(Request $request)
    {
        //dd($request->except('_token'));
        //Auth::attempt($credenciais);
        Auth::attempt($request->except('_token'));
    }
    public function logout()
    {
        Auth::logout();
    }
}
