<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Administrador</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        
    </head>
    <body>
        <h1>Página temporaria do admin</h1>
        <button><a href="{{route('produto')}}">cadastro de produtos</a></button><br/>
        <button><a href="{{route('doador')}}">cadastro de doadores</a></button><br/>
        <button><a href="{{route('admin.marca')}}">cadastro de marcas</a></button><br/>
        <button><a href="{{route('admin.tipo')}}">cardastro de tipos</a></button><br/>
        <button><a href="{{route('admin.medida')}}">cadastro de medidas</a></button>
        <button><a href="{{route('home')}}">home</a></button><br/>
        <button><a href="{{route('admin.login.sair')}}">logout</a></button><br/>


    </body>
</html>
