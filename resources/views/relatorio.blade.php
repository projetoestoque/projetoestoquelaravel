@extends('template.site')

@section('titulo','Menu')

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
    <div class="row">
    <div class="input-field col l3">
        <select class="date" id="data">
            <option value="hoje" >Hoje</option>
            <option value="semana">Essa Semana</option>
            <option value="mes">Esse Mês</option>
            <option value="ano">Esse Ano</option>
        </select>
        <label for="data">Período</label>
    </div>
    <div class="input-field col l3">
        <select class="date" id="data">
            <option value="hoje" >Geral</option>
            <option value="semana">Entrada</option>
            <option value="mes">Saída</option>
            <option value="mes">Vencimento</option>
            <option value="ano">Quantidade baixa</option>
        </select>
        <label for="data">Tipo de relatório</label>
    </div>
    <div class="col l3">
        <a class="waves-effect waves-light btn-flat gradient">Gerar Relatório</a>
    </div>

    <div class="col l1"></div>
    <a class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">print</i></a>
    <a class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">picture_as_pdf</i></a>
    </div>
</div>

<div class="container z-depth-2 ">
<nav class="nav-form blue lighten-1"></nav>
<textarea cols="30" rows="10"></textarea>
</div>
@endsection
