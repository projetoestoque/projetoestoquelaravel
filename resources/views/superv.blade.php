<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HOME</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        
    </head>
    <body>
        <button><a href="{{route('produto')}}">cadastro de produtos</a></button><br/>
        <button><a href="{{route('doador')}}">cadastro de doadores</a></button><br/>
        <button><a href="{{route('home')}}">home</a></button><br/>

    </body>
</html>
