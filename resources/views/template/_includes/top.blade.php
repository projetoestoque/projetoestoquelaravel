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
</head>
<body>
<header>
  <nav>
   <div class="nav-wrapper" style="background:linear-gradient(to right, #30cfd0 0%, #330867 100%);"  >
     <div class="container">
       <a href="#!" class="brand-logo">Estoque ONG</a>
       <ul class="right hide-on-med-and-down">  
         @if(Auth::guest())
           <li><a href="/">Home</a></li>
           <li><a href="">Login</a></li>
         @else
           <li><a href=#>Menu</a></li>
           <li><a href=#>Produtos</a></li>
           <li><a href="#">Auditoria</a></li>
           <li><a href="">Sair</a></li>
         @endif

       </ul>
     </div>
   </div>
 </nav>
</header>
