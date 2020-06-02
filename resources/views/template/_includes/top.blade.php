<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>@yield('titulo')</title>
  <!--Import Google Icon Font-->
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!--  linkando o template ao css -->
  <link href="{{asset('css/general.css')}}" rel="stylesheet">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0">
</head>
<body class="@yield('classBody')">
<header>
  @guest
  <nav>
   <div class="nav-wrapper" >
     <div class="container">
     <a href="/" class="brand-logo">
       SysONG<i class="material-icons ">filter_drama</i>
       </a>
       <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
       <ul class="right hide-on-med-and-down">  
           <li><a href="/">Home</a></li>
           <li><a href="{{route('login')}}">Login</a></li>
       </ul>
       @elseif(Auth::user()->is_admin==true)
        <nav>
        <div class="nav-wrapper" style="background:linear-gradient(to right, #30cfd0 0%, #330867 100%);"  >
     <div class="container">
     <a href="/" class="brand-logo">
       SysONG<i class="material-icons ">filter_drama</i>
       </a>
       <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
       <ul class="right hide-on-med-and-down">  
       <li><a href="{{route ('admin.home') }}">Início</a></li>
       <li><a class="dropdown-trigger" href="#" data-target="dropdown1" >Menu<i class="material-icons right">arrow_drop_down</i></a></li>
       <li>
       <a class="dropdown-trigger"href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
       Logout<i class="material-icons right">power_settings_new</i>
                                    </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
       </ul>                           
       @else
       <nav>
        <div class="nav-wrapper" style="background:linear-gradient(to right, #30cfd0 0%, #330867 100%);"  >
     <div class="container">
     <a href="/" class="brand-logo">
       SysONG<i class="material-icons ">filter_drama</i>
       </a>
       <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
       <ul class="right hide-on-med-and-down">  
       <li><a href="{{ route('home') }}">Início</a></li>
       <li><a class="dropdown-trigger" href="#" data-target="dropdown2">Menu<i class="material-icons right">arrow_drop_down</i></a></li>
       <li>
       <a class="dropdown-trigger"href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
       Logout<i class="material-icons right">power_settings_new</i>
                                    </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
       @endguest
       </ul>
     </div>
   </div>
 </nav>
 @guest
 <ul class="sidenav" id="mobile-demo">
    <li><a href="/">Home</a></li>
    <li><a href="{{route('login')}}">Login</a></li>
  </ul>
  @elseif(Auth::user()->is_admin==true)
  <ul class="sidenav" id="mobile-demo">
  <li><a href="{{route ('admin.home') }}">Menu</a></li>
  <li ><a href="{{route('produtos.listar')}}">Visualizar Estoque</a></li>
  <li ><a href="{{route('admin.listarCadastros')}}">Visualizar Cadastros</a></li>
  <li><a href="{{ route('admin.cadastros')}}">Cadastrar</a></li>
  <li><a href="{{ route('admin.insercoes')}}">Entradas</a></li>
  <li><a href="#">Relatório</a></li>
       <li>
       <a class="dropdown-trigger"href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
       Logout<i class="material-icons right">power_settings_new</i>
                                    </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
  </ul>
  @else
  <ul class="sidenav" id="mobile-demo">
  <li><a href="{{ route('home') }}">Menu</a></li>
  <li ><a href="{{route('produtos.listar')}}">Visualizar Estoque</a></li>
  <li><a href="{{ route('superv.cadastros')}}">Cadastrar</a></li>
  <li><a href="{{ route('superv.cadastros')}}">Entradas</a></li>
  <li><a href="#">Relatório</a></li>
  <li>
  <a class="dropdown-trigger"href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
  Logout<i class="material-icons right">power_settings_new</i>
  </a>
  </li>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
  </ul> 
 @endguest
 <ul id="dropdown1" class="dropdown-content"  >
    <li ><a href="{{route('produtos.listar')}}">Visualizar Estoque</a></li>
    <li ><a href="{{route('admin.listarCadastros')}}">Visualizar Cadastros</a></li>
    <li><a href="{{ route('admin.cadastros')}}">Cadastrar</a></li>
    <li><a href="{{ route('admin.insercoes')}}">Entradas</a></li>
    <li><a href="#">Relatório</a></li>
  </ul> 
  <ul id="dropdown2" class="dropdown-content"  >
    <li ><a href="{{route('produtos.listar')}}">Visualizar Estoque</a></li>
    <li><a href="{{ route('superv.cadastros')}}">Cadastrar</a></li>
    <li><a href="{{ route('superv.cadastros')}}">Entradas</a></li>
    <li><a href="#">Relatório</a></li>
  </ul> 
</header>
