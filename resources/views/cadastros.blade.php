@extends('template.site')

@section('titulo','Menu de Cadastros')
@section('classBody','Background')
@section('conteudo')
<div class="butaoEspaco">
    <a href="{{ URL::route('home') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<br>
<div class="mobile-hide"><h4 class="cadastros-align"><b>Cadastros<b></h5></div>
<div class="mobile"><div class="desktop-hide"><h4 class="center-align"><b>Cadastros<b></h5></div>
<div class="mobile-hide">
<br>
<div class="container ">
<div class="row white-text ">
            <a href="{{route('produto')}}" class="white-text">
                <div class="card-panel blue darken-3 col s5 mobile hoverable ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons large white-text">free_breakfast</i>
                            <h6 >Produtos</h6>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col s2">
            </div>
            <a href="{{route('doador')}}" href="" class="white-text">
                <div class=" card-panel blue darken-3 col s5 hoverable mobile">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons large white-text pt-5">face</i>
                            <h6> Doadores</h6>
                        </div>
                    </div>
                </div>
            </a>
</div>
<br>
<br>

@endsection
