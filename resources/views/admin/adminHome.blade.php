@extends('template.site')

@section('titulo','Menu')

@section('conteudo')

<br>
<h3 class="center-align"><b>Olá, Admin </h3>
<h5 class="center-align">Escolha uma das opções abaixo </h3>
<br>
<br>
<div class="container ">
<div class="row white-text ">
            <a href="#" class="white-text">
                <div class=" card-panel blue accent-1 col s5  ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">format_list_bulleted</i>
                            <h6 class="no-padding txt-md">Listagem</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s2">
            </div>
            <a href="{{ route('admin.cadastros')}}" class="white-text">
                <div class=" card-panel blue accent-2 col s5">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">playlist_add</i>
                            <h6>Cadastros</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
</div>
<div class="row white text">
<a href="#" class="white-text">
                <div class=" card-panel  light-blue darken-3 col s5">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">report_problem</i>
                            <h6 class="no-padding txt-md">Produtos faltando</h6>
                        </div>
                        <span class="row"></span>
                        </div>
                </div>
            </a>
            <span class="col s2"></span>
            <a href="#" class="white-text hide-on-small-only">
                <div class=" card-panel blue darken-4 col s5">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">assignment</i>
                            <h6 class="no-padding txt-md">Auditoria</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <span class="col s1"></span>
</div>      
</div>
</div>
@endsection


