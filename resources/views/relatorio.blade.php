@extends('template.site')

@section('titulo','Menu')

<script>

function baixarPdf() {
    let form = document.getElementById('form1')
    form.action = "{{route('relatorio.pdf')}}"
    document.formulario.submit()
    form.action = "{{route('relatorio.print')}}"
}

 function fazerRequisicao(rota) {
    data = document.getElementById('data').value
    tipo = document.getElementById('tipo').value

    // Exemplo de requisição POST
    var ajax = new XMLHttpRequest();
    let url = ""
    if(rota == 'gerar') {
        url = "{{route('relatorio.gerar')}}"
    } else if(rota == 'pdf') {
        url = "{{route('relatorio.pdf')}}"
    }

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
            removeBackground()
            document.getElementById('texto_relatorio').value = data;
        }
    }
 }
</script>

<style>

#section-to-print {
    font-weight: normal;
    display: none;
}
.row{
    margin-bottom:0 !important;
}
.waves-effect.waves-light.btn-flat.gradient{
    margin-top:20px;
}
textarea {
  outline: none;
  height:50% !important;
  resize:none;
  font:16px 'Noto Sans JP',sans-serif !important;
  background: url({{asset('relatorio.png')}}) center center no-repeat;
  background-size: 500px 200px;
}
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
<meta id="token" name="csrf-token" content="{{ csrf_token() }}"/>
@section('conteudo')

<div class="butaoEspaco">
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
</div>
<br>
<br>
<div class="container">
    <h4><b>Relatório</b></h4>
    <div class="row">
    <form id="form1" name="formulario" method="post" action="{{route('relatorio.print')}}">
    {{csrf_field()}}
    <div class="input-field col l3">
        <select class="date" id="data" name="data">
            <option value="hoje" >Hoje</option>
            <option value="semana">Semana</option>
            <option value="mes">Mês</option>
            <option value="ano">Ano</option>
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
        <a onclick="fazerRequisicao('gerar')" class="waves-effect waves-light btn-flat gradient">Gerar Relatório</a>
    </div>

    <div class="col l1"></div>
        <button type="submit" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">print</i></button>
        <a onclick="baixarPdf()" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">picture_as_pdf</i></a>
    </div>
    </form>
</div>

<div class="container z-depth-2">
<nav class="nav-form blue lighten-1"></nav>
<textarea id="texto_relatorio" cols="50" rows="10" onchange="removeBackground()"></textarea>
</div>

@if(isset($print))
<div id="section-to-print">
    @foreach($print as $item)
        <b>{{$item['tipo']}}</b><br/>
        @foreach($item['texto'] as $texto)
        {{$texto}}<br/><br/>
        @endforeach
        <br/>
    @endforeach
</div>
@endif

@if(isset($print))
<script>
   window.print()
</script>
@endif

@endsection
<script>
    function removeBackground(){
        document.querySelector('textarea').style.background='none';
    }
</script>
