@extends('template.site')

@section('titulo','SysONG')
@section('classBody','Background3')
@section('conteudo')
<div class="mobile-hide"><img class="welcomeImg"src="{{asset('SYsong.png')}}"><div class="welcomeButton"><a class="btn-large waves-effect waves-light grey lighten-5 blue-text " href="{{route('login')}}">
<b>Login
<i class="material-icons blue-text right ">person</i>
</a></div></div>
<div class="mobile"><div class="desktop-hide"><div class="FlexContainer"><img class="welcomeImgMobile"src="{{asset('SYsongAlt.png')}}"></div></div></div>
<div class="mobile"><div class="desktop-hide"><div class="FlexContainer"><h3 class="white-text center-align mobile">Bem vindo ao SysONG</h3><div></div></div>
<div class="FlexContainer"><div class="mobile"><div class="desktop-hide"><div class="welcomeButton"><a class="btn-large waves-effect waves-light grey lighten-5 blue-text " href="{{route('login')}}">
<b>Login
<i class="material-icons blue-text right ">person</i>
</a></div></div></div></div>


@endsection
        
