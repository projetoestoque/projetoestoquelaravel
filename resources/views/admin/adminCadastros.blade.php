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
<div class="row white-text ">
            <a class="white-text modal-trigger" data-target="modal1">
                <div class=" card-panel blue accent-2 col s5 hoverable ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">copyright</i>
                            <h6 class="no-padding txt-md">Cadastros de Marcas</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s2">
            </div>
            <a class="white-text modal-trigger" data-target="modal2">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">layers</i>
                            <h6>Cadastros de Tipos</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
</div>
<div class="row white text ">
<a class="white-text modal-trigger" data-target="modal3">
                <div class=" card-panel blue accent-2 col s5 hoverable">
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
            <span class="col s2"></span>
            <a class="white-text modal-trigger" data-target="modal4">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">restaurant</i>
                            <h6 class="no-padding txt-md">Cadastros de Refeições</h6>
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
<div id="modal4" class="modal">
<div class="modal-content">
    <h4>Cadastro de Refeições</h4>
    <form method="post" action="{{route('admin.refeicao.cadastrar')}}">
        {{ csrf_field() }}
        <br>
        <div class="input-field">
        <i class="material-icons prefix">restaurant_menu</i>
                <select id="selectTipo" required="required"  name="refeicao">
                    <option value="" disabled selected>Escolha a Refeição</option>
                    <option value="Cafe">Café da Manhã</option>
                    <option value="LancheManha">Lanche da Manhã</option>
                    <option value="Almoco">Almoço</option>
                    <option value="LancheTarde">Lanche da Tarde</option>
                </select>
            <label for="refeicao">Refeição do dia</label>
        </div>
        <div class="input-field">
            <i class="material-icons prefix">archive</i>
            <input required="required" id="desperdicio" name="desperdicio" step="0.1" placeholder="2.5" type="number">
            <label for="desperdicio">Desperdício em Kg </label>
        </div>
        <div class="input-field">
            <i class="material-icons prefix">plus_one</i>
            <input required="required" id="quantidade" name="quantidade" type="number" placeholder="10">
            <label for="quantidade">Quantidade servida</label>
        </div>
        <br>
        <button class="btn waves-effect waves-light blue darken-2 ">Enviar</button>
    </form>
    <button class="modal-close waves-effect waves-teal btn-flat">Fechar</button>
    </div>
  </div>
</div>
</div>
@endsection
    
