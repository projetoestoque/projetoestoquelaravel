@extends('template.site')

@section('titulo','Menu')

@section('conteudo')
<div class="mobile-hide"><img class="fluid1" src="{{asset('fluid1.png')}}"></div>
<br>
<h3 class="alinhamento blue-text text-darken-4"><b>Olá, Supervisor! </h3>
<h5 class="alinhamento blue-text text-darken-4 ">Escolha uma das opções abaixo: </h3>
<br>
<br>
<div class="container ">
<div class="row white-text ">
            <a href="{{route('produtos.listar')}}" class="white-text">
                <div class=" card-panel blue accent-1 col s5 hoverable  ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">view_compact</i>
                            <h6 class="no-padding txt-md">Estoque</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s2">
            </div>
            <a href="{{route('saida.menu')}}" class="white-text">   
                <div class=" card-panel blue darken-4 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">exit_to_app</i>
                            <h6>Saídas do Sistema</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
</div>     
</div>
</div>
<div class="mobile-hide"><img class="ipanema" src="{{asset('fluid2.png')}}"></div>
@endsection
