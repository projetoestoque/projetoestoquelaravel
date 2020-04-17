@extends('template.site')

@section('titulo','Menu de Cadastros')

@section('conteudo')
<br>
<br>
<br>
<div class="container ">
<div class="row white-text ">
            <a href="{{route('produto')}}" class="white-text">
                <div class=" card-panel blue accent-1 col s5  ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">free_breakfast</i>
                            <h6 class="no-padding txt-md">Cadastros de Produtos</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s2">
            </div>
            <a href="{{route('doador')}}" class="white-text">
                <div class=" card-panel blue accent-2 col s5">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">face</i>
                            <h6>Cadastros de Doadores</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
</div>
</div>
@endsection