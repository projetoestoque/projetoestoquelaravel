@extends('template.site')

@section('titulo','Menu')
@section('classBody','Background')
@section('conteudo')
<div class="butaoEspaco">
    <a href="{{ URL::route('admin.home') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<div class="container ">
<br>
<br>
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
            <h5><b>Visualisar Estoque</b><div class="mobile-hide"> <i class="material-icons small right">send</i></div></h5>          
            </div>
        </div>
        </div>
    </a>
  </div>
  </div>
<br>

<div class="row">
<div class="col l12">
    <a href="{{route('estoqueEntradas')}}" class="black-text">
    <div class="card horizontal">
    <div class="card-image-fade">
      <div class="row"></div>
      <div class="row"></div>
      <div class="col l1"></div>
      <div class="col l2"><i class="material-icons medium white-text pt-5">add_shopping_cart</i></div>
      <div class="col l2"></div>
      <div class="row"></div>
      <div class="row"></div>
      </div>
      <div class="card-stacked white">
      <div class="mobile-hide"><div class="row"></div></div>
        <div class="card-content white">
          <h5><b>Entrada no Estoque</b> <div class="mobile-hide"><i class="material-icons small right">send</i></div></h5>
        </div>
      </div>
    </div>
    </a>
  </div>
  </div>
  </div>
</div>
@endsection