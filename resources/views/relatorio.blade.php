@extends('template.site')

@section('titulo','Menu')

<style>

#section-to-print {
    font-weight: normal;
    display: none;
}
.row{
    margin-bottom:0 !important;
}
.waves-effect.waves-light.btn-flat.gradient{
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
<a href="{{ URL::previous() }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
</a>
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
    <form id="form1" method="post" action="{{route('relatorio.gerar')}}" target="_blank">
        {{ csrf_field() }}
        <div class="row">
        <br>
            <div class="input-field col s12 l4 offset-l1">
                <i class="material-icons prefix">date_range</i>
                <input required type="text" class="datepicker" id="data_inicial" name="data_inicial">
                <label for="data">Data Inicial</label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">date_range</i>
                <input required type="text" class="datepicker" id="data_final" name="data_final">
                <label for="data">Data final</label>
            </div>
        </div>
        <div class="row">
        <div class="input-field col s12 l4 offset-l1">
            <i class="material-icons prefix">reorder</i>
            <select class="date" id="tipo" name="tipo" multiple>
                <option value="geral" selected >Geral</option>
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
            <select class="date" id="usuario" name="usuario" multiple>
                <option value="ambos" selected>Ambos</option>
                <option value="admin" >Admin</option>
                <option value="supervisor">Supervisor</option>
            </select>
            <label for="data">Usuário</label>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s12 l5 offset-l1">
            <i class="material-icons prefix">portrait</i>
            @if(isset($_GET['produto']))
                <select name="produto" id="produto" multiple>
                    <option value="todos" selected>Todos os produtos</option>
                    @foreach($produtos as $produto )
                        <option value="{{$produto['id']}}">{{$produto['nome']}}</option>
                    @endforeach
                </select>
                <a href="{{route('admin.listarCadastros')}}?acao=relatorio&tipo=produto&produto=2" class="modal-trigger radius white-text">
                      <i class="tiny material-icons">add_circle_outline</i>
                      <span>Escolher outro Produto</span>
                </a>   
            @else
                <select name="produto" id="produto">
                    <option value="todos">Todos os produtos</option>
                </select>
                <label for="produto">Produto</label>
                <a href="{{route('admin.listarCadastros')}}?acao=relatorio&tipo=produto" class="modal-trigger radius white-text">
                      <i class="tiny material-icons ">add_circle_outline</i>
                      <span>Escolher Produto</span>
                </a>     
            @endif
        </div>
        </div>
        <br>
        <div class="row valign center">
            <button type="submit" class="btn waves-effect waves-light btn-flat gradient">
                <b>Gerar Relatório<i class="material-icons right">send</i></b> 
            </button>
        </div>
    </form>
    <br>
</div>
</div>
<br>
<br>
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

