<!DOCTYPE html>
<html>
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
       <ul class="right hide-on-med-and-down">  
           <li><a href="/">Home</a></li>
           <li><a href="{{route('login')}}">Login</a></li>
       @elseif(Auth::user()->is_admin==true)
        <nav>
        <div class="nav-wrapper" style="background:linear-gradient(to right, #30cfd0 0%, #330867 100%);"  >
     <div class="container">
     <a href="/" class="brand-logo">
       SysONG<i class="material-icons ">filter_drama</i>
       </a>
       <ul class="right hide-on-med-and-down">  
       <li><a href="{{route ('admin.home') }}">Menu</a></li>
       <li><a href="{{ route('admin.cadastros')}}">Cadastros</a></li>
       <li>
       <a class="dropdown-trigger"href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
       Logout<i class="material-icons right">power_settings_new</i>
                                    </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
       @else
       <nav>
        <div class="nav-wrapper" style="background:linear-gradient(to right, #30cfd0 0%, #330867 100%);"  >
     <div class="container">
     <a href="/" class="brand-logo">
       SysONG<i class="material-icons ">filter_drama</i>
       </a>
       <ul class="right hide-on-med-and-down">  
       <li><a href="{{ route('home') }}">Menu</a></li>
       <li><a href="{{route('superv.cadastros')}}">Cadastros</a></li>
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
</header>
