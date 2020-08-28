@extends('template.site')

@section('titulo','Menu')

@section('conteudo')
<br>
<h3 class="blue-text text-darken-4 center"><b>Olá, Supervisor! </h3>
<h5 class="blue-text text-darken-4 center">Escolha uma das opções abaixo: </h3>
<br>
<br>
<div class="container ">
<div class="row">
<div class="col l12">
    <a href="{{route('produtos.listar')}}" class="black-text">
        <div class="card horizontal">
            <div class="card-image-fade">
                <div class="row"></div>
                <div class="row"></div>
                <div class="col l1"></div>
                <div class="col l4"><i class="material-icons medium white-text pt-5">format_list_bulleted</i></div>
                <div class="col l2"></div>
                <div class="row"></div>
                <div class="row"></div>
            </div>
        <div class="card-stacked white">
        <div class="mobile-hide"><div class="row"></div></div>
            <div class="card-content white">
            <div class="row valign-wrapper">
                <div class="col l6">
                    <h5>
                        <b>Visualisar Estoque</b>
                    </h5> 
                </div>
                <div class="col l6">
                    <div class="mobile-hide"> 
                        <i class="material-icons small right">send</i>
                    </div>
                </div>
            </div>         
        </div>
        </div>
        </div>
    </a>
  </div>
  </div>
  <br>
  <div class="row">
<div class="col l12">
    <a href="{{route('saida.menu')}}" class="black-text">
        <div class="card horizontal">
            <div class="card-image-fade">
                <div class="row"></div>
                <div class="row"></div>
                <div class="col l1"></div>
                <div class="col l4"><i class="material-icons medium white-text pt-5">format_list_bulleted</i></div>
                <div class="col l2"></div>
                <div class="row"></div>
                <div class="row"></div>
            </div>
        <div class="card-stacked white">
        <div class="mobile-hide"><div class="row"></div></div>
            <div class="card-content white">
            <div class="row valign-wrapper">
                <div class="col l6">
                    <h5>
                        <b>Saídas no Sistema</b>
                    </h5> 
                </div>
                <div class="col l6">
                    <div class="mobile-hide"> 
                        <i class="material-icons small right">send</i>
                    </div>
                </div>
            </div>         
            </div>
        </div>
        </div>
    </a>
  </div>
  </div>

</div>
@endsection
