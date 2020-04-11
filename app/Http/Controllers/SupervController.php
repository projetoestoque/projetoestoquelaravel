<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervController extends Controller
{
    public function __construct() 
    {

    }

    public function index()
    {
        return 1;
    }
    public function login()
    {
        return view('supervlogin');
    }
    public function postLogin(Request $request)
    {
        $validator = validator($request->all(), [
            'nome' => 'required|min:3|max:100',
            'senha' => 'required',
        ]);

        

        if ($validator->fails() ) {
            return redirect('/superv/login')
            ->withErrors($validator)
            ->withInput();

        }

        $credentiails = [
          'Usuario' => $request->get("nome"),
          'password' => $request->get('senha'),
        ];

        if (auth()->guard('superv')->attempt($credentiails)) {
          return redirect()->route('superv');
        } else {
          return redirect('/superv/login')
            ->withErrors(['erros' => 'Login inválido !'])
            ->withInput();
        }

    }

    public function sair(){
        auth()->guard('superv')->logout();
        return redirect()->route('superv.login');
    }

    public function logado () {
        return view('superv');
    }
}
