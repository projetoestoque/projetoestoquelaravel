@extends('template.site')

@section('titulo','Menu de Inserções')
@section('classBody','Background')
@section('conteudo')
@if($_SERVER['HTTP_REFERER']==URL::route('produtos.listar'))
<div class="butaoEspaco">
    <a href="{{ URL::route('produtos.listar') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
@else
<div class="butaoEspaco">
    <a href="{{ URL::route('admin.home') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
@endif
<br>
<br>
<div class="mobile-hide"><h4 class="cadastros-align"><b>Entradas<b></h5></div>
<div class="mobile"><div class="desktop-hide"><h4 class="center-align"><b>Entradas<b></h5></div>
<br>
<div class="container">
<div class="row white text ">
<a href="{{route('saida')}}" class="white-text">
                <div class=" card-panel blue darken-3 col s5 hoverable mobile">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons large white-text pt-5">kitchen</i>
                            <h6>Saída de Produtos</h6>
                        </div>
                    </div>
                </div>
            </a>
<div class="col s2"></div>
<a class="white-text" href="{{route('refeicao')}}">
            <div class="card-panel col s5 hoverable mobile">
                <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons large blue-text text-darken-3 ">restaurant</i>
                            <h6 class="no-padding txt-md blue-text text-darken-3"><b>Saída por Refeição</b></h6>
                        </div>
                </div>
            </div>
        </a>

</div>
@endsection
