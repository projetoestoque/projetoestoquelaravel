@extends('template.site')

@section('titulo','SysONG')
@section('classBody','Background3')
@section('conteudo')
<div ><img class="welcomeImg"src="{{asset('SYsong.png')}}"></div>
<div class="welcomeButton"><a class="btn-large waves-effect waves-light grey lighten-5 blue-text " href="{{route('login')}}">
<b>Login
<i class="material-icons blue-text right ">person</i>
</a></div>
@endsection
        
