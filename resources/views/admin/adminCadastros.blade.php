@extends('template.site')

@section('titulo','Menu de Cadastros')
@section('classBody','Background')
@section('conteudo')
@if($errors->any())
  <script>
    alert("{{$errors->first()}}");
  </script>
@endif
<div class="butaoEspaco">
    <a href="{{ URL::route('admin.MenuCadastros') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<br>
<div class="container ">
<div class="row white-text ">
            <a href="{{route('produto')}}" class="white-text">
                <div class="card-panel blue darken-3 col s5 hoverable ">
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
                <div class=" card-panel blue darken-3 col s5 hoverable">
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
                <div class=" card-panel blue darken-3 col s5 hoverable ">
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
                <div class=" card-panel blue darken-3 col s5 hoverable">
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
                <div class=" card-panel blue darken-3 col s5 hoverable">
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
            <a class="white-text modal-trigger" data-target="modal5">
                <div class=" card-panel blue darken-3 col s5 l5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">view_compact</i>
                            <h6 class="no-padding txt-md">Cadastros de Estoque</h6>
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
            <div class="input-field" >
                <i class="material-icons prefix">font_download</i>
                <input required="required" placeholder="marca" name="marca" id="marcaInput" type="text">
                <label for="marcaInput">Nova marca
                <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Marca é a marca específica do produto </span>
            </div>
                </label>

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
            <label for="tipo">Novo tipo de Produto
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Tipo é a categoria do produto(Alimento,higiene,escritório) </span>
            </div>
            </label>
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
            <label for="medida">Nova Medida
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a unidade de determinado item(Quilo,pacotes,gramas) </span>
            </div>
            </label>
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
            <label for="refeicao">Refeição do dia
            <div class="tooltip">
                <i class="tiny material-icons">info_outline</i>
                <span class="tooltiptext">Qual das refeições do dia esta sendo registrada </span>
            </div>
            </label>
        </div>
        <div class="input-field">
            <i class="material-icons prefix">archive</i>
            <input required="required" id="desperdicio" name="desperdicio" step="0.1" placeholder="2.5" type="number">
            <label for="desperdicio">Desperdício em Kg
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quanto em quilos da refeição posta foi desperdiçada </span>
            </div>
            </label>
        </div>
        <div class="input-field">
            <i class="material-icons prefix">plus_one</i>
            <input required="required" id="quantidade" name="quantidade" type="number" placeholder="10">
            <label for="quantidade">Quantidade servida
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quantas refeições foram posta </span>
            </div>
            </label>
        </div>
        <div class="input-field">
                <i class="material-icons prefix">access_time</i>
                <input required type="text" id="data" name="data" placeholder="00/00/0000" class="datepicker">
                <label for="data">Data da Refeição
                <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A data que a refeição foi servida</span>
                 </div>
                </label>
            </div>
        <br>
        <button class="btn waves-effect waves-light blue darken-2 ">Enviar</button>
    </form>
    <button class="modal-close waves-effect waves-teal btn-flat">Fechar</button>
    </div>
  </div>
</div>
<div id="modal5" class="modal">
<div class="modal-content">
    <h4>Cadastro de Estoque</h4>
    <form method="post" action="{{route('admin.estoque.cadastrar')}}">
        {{ csrf_field() }}
        <br>
        <div class="input-field">
            <i class="material-icons prefix">view_compact</i>
            <input required="required" id="estoque" name="estoque" type="text" placeholder="Almoxarifado">
            <label for="estoque">Novo Estoque
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O Estoque é o local onde será armazenado determinados produtos cadastrados </span>
            </div>
            </label>
        </div>
        <br>
        <button class="btn waves-effect waves-light blue darken-2 ">Enviar</button>
    </form>
    <button class="modal-close waves-effect waves-teal btn-flat">Fechar</button>
    </div>
  </div>
</div>
@endsection
