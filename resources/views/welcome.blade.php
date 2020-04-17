@extends('template.site')

@section('titulo','SysONG')

@section('conteudo')
<div class="parallax-container">
      <div class="parallax"><img src="{{asset('SYsong.png')}}"></div>
      <div class="fixed"><a class="btn-large waves-effect waves-light grey lighten-5 blue-text " href="{{route('login')}}">
      <b>Login
    <i class="material-icons blue-text  right ">person</i>
  </a></div>
</div>
@endsection
        
