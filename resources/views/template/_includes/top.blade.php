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
<body>
<header>
  <nav>
  <!-- por diferente o degrade para guest e demais-->
   <div class="nav-wrapper" style="background:linear-gradient(to right, #30cfd0 0%, #330867 100%);"  >
     <div class="container">
       <a href="#!" class="brand-logo">SysONG</a>
       <ul class="right hide-on-med-and-down">  
       @guest
           <li><a href="/">Home</a></li>
           <li><a href="{{route('login')}}">Login</a></li>
       @elseif(Auth::user()->is_admin==true)
       <li><a href="{{route ('admin.home') }}">Menu</a></li>
       <li><a href="{{ route('admin.cadastros')}}">Cadastros</a></li>
       <li>
       <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
       @else
       <li><a href="{{ route('home') }}">Menu</a></li>
       <li><a href="{{route('superv.cadastros')}}">Cadastros</a></li>
       <li>
       <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
