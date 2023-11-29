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
        $req=$request->except('_token');
        $req['password'] =trim($request->password);
        Auth::attempt($req);
        return redirect('/produtos');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
