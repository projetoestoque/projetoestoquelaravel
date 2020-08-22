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
h4{
    text-align:center;
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
<h4><b>Relatório</b></h4>
    <!-- <div class="col l1"></div>
        <button type="submit" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">print</i></button>
        <a onclick="baixarPdf()" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">picture_as_pdf</i></a>
    </div> -->
    <br>
<div class="container">
<div class="container z-depth-2 ">
<nav class="nav-form blue lighten-1"></nav>
    <div class="row">
    <div class="col l1"></div>
    <form id="form1" method="post" action="{{route('relatorio.gerar')}}">
        {{csrf_field()}}
        <div class="input-field col s12 l4">
            <i class="material-icons prefix">date_range</i>
            <input required type="text" class="datepicker" id="data" name="data_inicial">
            <label for="data">Data Inicial</label>
        </div>
        <div class="col l2"></div>
        <div class="input-field col s12 l4">
            <i class="material-icons prefix">date_range</i>
            <input required type="text" class="datepicker" id="data" name="data_final">
            <label for="data">Data final</label>
        </div>
        </div>
        <div class="row">
        <div class="col l1"></div>
        <div class="input-field col s12 l4">
            <i class="material-icons prefix">reorder</i>
            <select class="date" id="tipo" name="tipo">
                <option value="geral" >Geral</option>
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
                <option value="vencimento">Vencimento</option>
                <option value="baixa">Quantidade baixa</option>
            </select>
            <label for="data">Tipo de relatório</label>
        </div>
        <div class="col l2"></div>
        <div class="input-field col s12 l4">
            <i class="material-icons prefix">portrait</i>
            <select class="date" id="usuario" name="usuario">
                <option value="ambos" >Ambos</option>
                <option value="admin" >Admin</option>
                <option value="super">Supervisor</option>
            </select>
            <label for="data">Usuário</label>
        </div>
        </div>
        <div class="row">
        <div class="col l1"></div>
        <div class="input-field col s12 l4">
            <i class="material-icons prefix">portrait</i>
            <select class="date" id="produto" name="produto">
                <option value="ambos">Todos</option>
                <option value="Produto1" >Produto1</option>
                <option value="Produto2">Produto2</option>
            </select>
            <label for="data">Produto</label>
        </div>
        </div>
        <div class="row valign center">
            <button type="submit" class="btn waves-effect waves-light btn-flat gradient">
                Gerar Relatório<i class="material-icons right">send</i>  
            </button>
        </div>
    </form>
    <br>
</div>
</div>
<div class="desktop-hide">
<br>
<br>
<br>
<br>
<br>
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

