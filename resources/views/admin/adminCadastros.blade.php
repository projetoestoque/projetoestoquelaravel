@extends('template.site')

@section('titulo','Menu de Cadastros')
@section('classBody','Background')
@section('conteudo')


<div class="butaoEspaco">
    <a href="{{ URL::route('admin.listarCadastros') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>

<br>
<br>
<div class="mobile-hide"><h4 class="cadastros-align"><b>Cadastros<b></h5></div>
<div class="mobile"><div class="desktop-hide"><h4 class="center-align"><b>Cadastros<b></h5></div>
<div class="mobile-hide">
<div class="container">
<div class="row white-text ">
            <a href="{{route('produto')}}" class="white-text">
                <div class="card-panel blue darken-3 col s3 hoverable ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col cadastro">
                            <i class="material-icons large white-text">free_breakfast</i>
                            <h6 class="back">Produtos</h6>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
            <a class="white-text modal-trigger" href="" data-target="modal2">
                <div class=" card-panel col s3 hoverable">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col cadastro">
                            <i class="material-icons large blue-text text-darken-3 pt-5">layers</i>
                            <h6 class="back blue-text text-darken-3"> Tipos</h6>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
            <a class="white-text modal-trigger" href="" data-target="modal1">
                <div class=" card-panel col s3 hoverable ">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col cadastro">
                            <i class="material-icons large blue-text text-darken-3 pt-5">copyright</i>
                            <h6 class="back blue-text text-darken-3"> Marcas</h6>
                        </div>
                    </div>
                </div>
            </a>
</div>
<div class="row white-text ">
            <a href="{{route('doador')}}" href="" class="white-text">
                <div class=" card-panel blue darken-3 col s3 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col cadastro">
                            <i class="material-icons large white-text pt-5">face</i>
                            <h6 class="back"> Doadores</h6>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
            <a class="white-text modal-trigger" href="" data-target="modal3">
                <div class=" card-panel col s3 hoverable">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col cadastro">
                            <i class="material-icons large blue-text text-darken-3 ">fitness_center</i>
                            <h6 class="back blue-text text-darken-3"> Medidas</h6>
                        </div>
                        </div>
                </div>
            </a>
            <span class="col s1"></span>
            <a class="white-text modal-trigger" href="" data-target="modal5">
                <div class=" card-panel col s3 l3 hoverable">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col cadastro">
                            <i class="material-icons large blue-text text-darken-3 ">view_compact</i>
                            <h6 class="back blue-text text-darken-3"> Estoque</h6>
                        </div>
                        </div>
                </div>
            </a>
</div>
<div class="row">
<a href="{{route('admin.cadastroUsuario')}}" class="white-text">
                <div class="card-panel blue darken-3 col s3 hoverable ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col cadastro">
                            <i class="material-icons large white-text">account_circle</i>
                            <h6 class="back">Usuários</h6>
                        </div>
                    </div>
                </div>
            </a>
</div>
</div>
</div>
<div class="mobile"><div class="desktop-hide">
<div class="container">
<div class="row white-text ">
            <a href="{{route('produto')}}" class="white-text">
                <div class="card-panel blue darken-3 col s5 hoverable mobile ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text">free_breakfast</i>
                            <h6>Produtos</h6>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
            <a href="{{route('doador')}}" href="" class="white-text">
                <div class="card-panel blue darken-3 col s5 hoverable mobile">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text pt-5">face</i>
                            <h6> Doadores</h6>
                        </div>
                    </div>
                </div>
            </a>
</div>
<div class="row white-text ">
<a class="white-text modal-trigger" href="" data-target="modal1">
                <div class=" card-panel col s5 hoverable mobile">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col">
                            <i class="material-icons medium blue-text text-darken-3 pt-5">copyright</i>
                            <h6 class="blue-text text-darken-3"> Marcas</h6>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
            <a class="white-text modal-trigger" href="" data-target="modal2">
            <div class=" card-panel col s5 hoverable mobile">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col">
                            <i class="material-icons medium blue-text text-darken-3 pt-5">layers</i>
                            <h6 class="blue-text text-darken-3"> Tipos</h6>
                        </div>
                    </div>
                </div>
            </a>
</div>
<div class="row white-text ">
            <a class="white-text modal-trigger" href="" data-target="modal3">
                <div class=" card-panel col s5 hoverable mobile">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col">
                            <i class="material-icons medium blue-text text-darken-3 ">fitness_center</i>
                            <h6 class="blue-text text-darken-3"> Medidas</h6>
                        </div>
                        </div>
                </div>
            </a>
            <span class="col s1"></span>
            <a class="white-text modal-trigger" href="" data-target="modal5">
                <div class=" card-panel col s5 hoverable mobile">
                    <div class="row">
                    <span class="row"></span>
                    <div class="col">
                            <i class="material-icons medium blue-text text-darken-3 ">view_compact</i>
                            <h6 class="blue-text text-darken-3"> Estoque</h6>
                        </div>
                        </div>
                </div>
            </a>
</div></div></div>
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Nova Marca</h4>
      <form method="post" action="{{route('admin.marca.cadastrar')}}">
            {{ csrf_field() }}
            <br>
            <div class="input-field" >
                <i class="material-icons prefix">font_download</i>
                @if(isset($marca))
                    <input value="{{$marca->marca}}" required="required" placeholder="marca" name="marca" id="marcaInput" type="text">
                    <input value="{{$marca->id}}" type="hidden" name="id">
                @else
                    <input required="required" placeholder="marca" name="marca" id="marcaInput" type="text">
                @endif
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
        <div class="row">
        <div class="input-field col s11">
            <i class="material-icons prefix">linear_scale</i>
                <input required="required" id="medida" name="medida" type="text" placeholder="Quilo(kg)">
                <label for="medida">Nova Medida
                <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a unidade de determinado item(Quilo,pacotes,gramas) </span>
                </div>
                </label>
                </div>
                </div>
                <div class="row">
                <div class="input-field col s4">
                <i class="material-icons prefix">font_download</i>
                <input minlength="2" maxlength="2" required="required" id="abreviacao" name="abreviacao" type="text" placeholder="kg">
                <label for="unidade">Abreviação
                <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A abreviação de determinada unidade(kg,cx,pct) </span>
                </div>
                </label>
                </div>
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

@if(session('update'))
    <script>
        alert("{{session('update')}}");
        window.location.href = "{{route('admin.listarCadastros')}}"
    </script>
@endif
@endsection
