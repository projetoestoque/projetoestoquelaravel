<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Marca</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        
    </head>
    <body>
        <h1>Página temporaria</h1>
        <form method="post" action="{{route('admin.marca.cadastrar')}}">
            {{ csrf_field() }}
            Nome da marca: <input type="text" name="marca">
            <button>Enviar</button>
            <button><a href="{{route('home')}}">home</a></button><br/>
        </form>

    </body>
</html>
