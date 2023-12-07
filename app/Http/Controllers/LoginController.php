<?php

namespace App\Http\Controllers;
use App\Models\LoginLog;
use Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    protected $redirectTo = '/';
    private $log;
    public function __construct()
    {
        $this->log =new LoginLog();
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
        $this->log->registrar('Login');
        return redirect('/carrinho');
    }
    public function logout()
    {
        $this->log->registrar('Logout');
        Auth::logout();
        return redirect('/login');
    }
}
