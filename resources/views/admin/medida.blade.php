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
        <h1>Página temporaria</h1>
        <form method="post" action="{{route('admin.medida.cadastrar')}}">
            Nome da medida: <input type="text" name="nome">
            Sigla: <input type="text" name="sigla">
            <button>Enviar</button>
            <button><a href="{{route('home')}}">home</a></button><br/>
        </form>

    </body>
</html>
