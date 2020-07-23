@extends('template.site')

@section('titulo','Menu')

<script>

 function fazerRequisicao() {
    data = document.getElementById('data').value
    tipo = document.getElementById('tipo').value

    // Exemplo de requisição POST
    var ajax = new XMLHttpRequest();
    const url = "{{route('relatorio.gerar')}}"

    // Seta tipo de requisição: Post e a URL da API
    ajax.open("POST", url, true);
    
    ajax.setRequestHeader('X-CSRF-TOKEN', document.getElementById('token').content);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Seta paramêtros da requisição e envia a requisição
    ajax.send("data=" + data + "&tipo=" + tipo);

    // Cria um evento para receber o retorno.
    ajax.onreadystatechange = function() {
    // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
        if (ajax.readyState == 4 && ajax.status == 200) {
            var data = ajax.responseText;
        // Retorno do Ajax
            document.getElementById('texto_relatorio').value = data;
        }
    }
 }
</script>

<style>
.row{
    margin-bottom:0 !important;
}
.container.z-depth-2{
   height:50vh;
}
select{
  border:1px solid rgba(142, 142, 142, 0.39) !important;
  border-radius: 8px !important;
}
.waves-effect.waves-light.btn-flat.gradient{
    margin-top:20px;
}
</style>
<meta id="token" name="csrf-token" content="{{ csrf_token() }}">
@section('conteudo')
@if(auth()->user()->is_admin)
    <a href="{{ URL::route('admin.home') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
    @else
    <a href="{{ URL::route('home')}}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
@endif
<br>
<br>
<div class="container">
    <h4><b>Relatório</b></h4>
    {{csrf_field()}}
    <div class="row">
    <div class="input-field col l3">
        <select class="date" id="data" name="data">
            <option value="hoje" >Hoje</option>
            <option value="semana">Essa Semana</option>
            <option value="mes">Esse Mês</option>
            <option value="ano">Esse Ano</option>
        </select>
        <label for="data">Período</label>
    </div>
    <div class="input-field col l3">
        <select class="date" id="tipo" name="tipo">
            <option value="geral" >Geral</option>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
            <option value="vencimento">Vencimento</option>
            <option value="baixa">Quantidade baixa</option>
        </select>
        <label for="data">Tipo de relatório</label>
    </div>
    <div class="col l3">
        <a onclick="fazerRequisicao()" class="waves-effect waves-light btn-flat gradient">Gerar Relatório</a>
    </div>

    <div class="col l1"></div>
        <a class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">print</i></a>
        <a class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">picture_as_pdf</i></a>
    </div>
</div>

<div class="container z-depth-2 ">
<nav class="nav-form blue lighten-1"></nav>
<textarea id="texto_relatorio" cols="300" rows="300"></textarea>
</div>
@endsection
