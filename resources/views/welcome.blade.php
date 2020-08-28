@extends('template.site')

@section('titulo','SysONG')
@section('cssLinks')
<link href="{{asset('css/welcome.css')}}" rel="stylesheet">
@endsection('cssLinks')
@section('classBody','Background3')
@section('conteudo')
<div class="container innerdiv">
    <div class="row valign-wrapper">
        <div class="col s12 l6">
            <h1>Bem vindo ao Sysong, o Sistema que  te ajuda a ajudar outros.</h1>
        </div>
        <div class="col s12 l6 hide-on-small-only">
            <img class="welcomeImg" src="{{asset('welcomeImg.svg')}}" alt="Pessoas usando o sistema">
        </div>
    </div>
    <div class="row">
            <div class="col s12">
            <a class="btn-large waves-effect waves-light grey lighten-5 blue-text " href="{{route('login')}}">
                <b>Login
                <i class="material-icons blue-text right ">person</i>
            </a>
            </div>
        </div>
</div>

@endsection
        
