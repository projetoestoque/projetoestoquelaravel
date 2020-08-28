<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>@yield('titulo')</title>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet" type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  @yield('cssLinks')
</head>
<body>
@yield('cabecalho')
@yield('conteudo')
</body>
</html>