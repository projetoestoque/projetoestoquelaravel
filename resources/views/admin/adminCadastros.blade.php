@extends('template.site')

@section('titulo','Menu de Cadastros')
@section('classBody','Background')
@section('conteudo')
@if($errors->any())
  <script>
    alert("{{$errors->first()}}");
  </script>
@endif
<br>
<br>
<br>
<div class="container ">
<div class="row white-text ">
            <a href="{{route('produto')}}" class="white-text">
                <div class=" card-panel blue accent-2 col s5 hoverable ">
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
                <div class=" card-panel blue accent-2 col s5 hoverable">
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
<div class="row white text">
<a class="white-text modal-trigger" data-target="modal1">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">copyright</i>
                            <h6 class="no-padding txt-md">Cadastros de Marcas</h6>
                        </div>
                        <span class="row"></span>
                        </div>
                </div>
        </a>
            <span class="col s2"></span>
            <a class="white-text hide-on-small-only modal-trigger" data-target="modal2">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">layers</i>
                            <h6 class="no-padding txt-md">Cadastros de Tipos</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <span class="col s1"></span>
</div>
<div class="row white text ">
<span class="col s4"></span>
<a class="white-text modal-trigger" data-target="modal3">
                <div class=" card-panel blue accent-2 col s4 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">fitness_center</i>
                            <h6 class="no-padding txt-md">Cadastros de Medidas</h6>
                        </div>
                        <span class="row"></span>
                        </div>
                </div>
            </a>
</div>
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Nova Marca</h4>
      <form method="post" action="{{route('admin.marca.cadastrar')}}">
            {{ csrf_field() }}
            <br>
            <div class="input-field " >
                <i class="material-icons prefix">font_download</i>
                <input required="required" placeholder="marca" name="marca" id="marcaInput" type="text">
                <label for="marcaInput">First Name</label>
            </div>
            <br>
            <button class="btn waves-effect waves-light blue darken-2 ">Enviar</button>
        </form>
        <button class="modal-close waves-effect waves-teal btn-flat">Fechar</button>
    </div>
</div>
<div id="modal2" class="modal">
<div class="modal-content">
    <h4>Cadastro de Novo Tipo</h4>
    <form method="post" action="{{route('admin.tipo.cadastrar')}}">
        {{ csrf_field() }}
        <br>
        <div class="input-field">
            <i class="material-icons prefix">label</i>
            <input required="required" placeholder="tipo" id="tipo" name="tipo" type="text">
            <label for="tipo">Novo tipo de Produto</label>
        </div>
        <br>
        <button class="btn waves-effect waves-light blue darken-2 ">Enviar</button>
    </form>
    <button class="modal-close waves-effect waves-teal btn-flat">Fechar</button>
    </div>
  </div>
<div id="modal3" class="modal">
<div class="modal-content">
    <h4>Cadastro de Medida</h4>
    <form method="post" action="{{route('admin.medida.cadastrar')}}">
        {{ csrf_field() }}
        <br>
        <div class="input-field">
            <i class="material-icons prefix">linear_scale</i>
            <input required="required" id="medida" name="medida" type="text" placeholder="Quilo(kg)">
            <label for="medida">Nova Medida</label>
        </div>
        <br>
        <button class="btn waves-effect waves-light blue darken-2 ">Enviar</button>
    </form>
    <button class="modal-close waves-effect waves-teal btn-flat">Fechar</button>
    </div>
  </div>
</div>
@endsection
    
