<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <form action="{{route('produto.cadastrar')}}" method="post">
            {{csrf_field()}}
        <h1>Nome</h1>
        <input type="text" name="nome"> 
        <label>Nome</label>
        <h1>Vencimento</h1>
        <input type="text" name="vencimento"> 
        <label>Vencimento</label>
        <h1>Quantidade</h1>
        <input type="number" name="quantidade"> 
        <label>Quantidade</label>
        <h1>Medida</h1>
        <input type="text" name="medida"> 
        <label>Medida</label>
        <h1>Codigo_barra</h1>
        <input type="number" name="codigo_barra"> 
        <label>Codigo_barro</label>
        <h1>Tipo</h1>
        <input type="text" name="tipo"> 
        <label>Tipo</label>
        <h1>Marca</h1>
        <input type="text" name="marca"> 
        <label>Marca</label>
        <h1>Doador</h1>
        <input type="text" name="doador"> 
        <label>Doador</label>

        <button>Cadastrar</button>
    </form>
    </body>
</html>
