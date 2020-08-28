@extends('template.site')

@section('titulo','Menu')
@section('conteudo')
<br>
<h3 class="blue-text text-darken-4 center"><b>Olá, Admin! </h3>
<h5 class="blue-text text-darken-4 center">Escolha uma das opções abaixo: </h3>
<br>
<div class="container ">
<div class="row white-text ">
            <a href="{{route('produtos.listar')}}" class="white-text ">
                <div class=" card-panel blue accent-1 col s5 hoverable ">
                    <div class="row ">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">view_compact</i>
                            <h6 class="no-padding txt-md">Estoque</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s2">
            </div>
            <a href="{{route('admin.listarCadastros')}}" class="white-text">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">playlist_add</i>
                            <h6>Cadastros </h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
</div>
<div class="row white-text ">
            <a href="{{route('saida.menu')}}" class="white-text">
                <div class=" card-panel blue darken-3 col s5 hoverable">
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
            <div class="col s2">
            </div>
            <a href="{{route('relatorio')}}" class="white-text">
                <div class=" card-panel blue darken-4 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">assignment</i>
                            <h6>Auditoria e Relatório</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
</div>
</div>
@endsection
