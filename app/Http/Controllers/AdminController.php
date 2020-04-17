<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
  	public function __construct() 
  	{
         $this->middleware('auth:admin');
  	}

  	public function index()
  	{
        return 1;
    }
    public function login()
    {
        return view('adminlogin');
    }
    public function postLogin(Request $request)
    {
        $validator = validator($request->all(), [
        	'nome' => 'required|min:3|max:100',
          'senha' => 'required',
        ]);

        

        if ($validator->fails() ) {
        	return redirect('/admin/login')
        	->withErrors($validator)
        	->withInput();

        }

        $credentiails = [
          'Usuario' => $request->get("nome"),
          'password' => $request->get('senha'),
        ];

        if (auth()->guard('admin')->attempt($credentiails)) {
          return redirect()->route('admin');
        } else {
          return redirect('/admin/login')
            ->withErrors(['erros' => 'Login inválido !'])
            ->withInput();
        }

    }

    public function logado () {
	    dd(auth()->guard('admin')->check());
        return view('admin');
    }

     public function sair(){
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
   
}
