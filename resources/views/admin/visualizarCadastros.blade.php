@extends('template.site')

@section('titulo','Listagem')

<style>
 .chips-chips{
     margin-bottom:10px;
 }
 .All{
     display:none;
 }
 .Doador{
    display:none !important;
 }
 .Tipo{
    display:none;
 }
 .Medida{
    display:none;
 }
 .Marca{
    display:none;
 }
 .Estoque{
    display:none;
 }
 .sem-fundo{
    margin-bottom:0 !important;
 }
 .btn.waves-effect.waves-light.gradient{
    margin-top:8px !important;
    border-radius:30px !important;
 }

</style>

@section('conteudo')

<input type="hidden" id="produto_id" name="id"/>

<div class="butaoEspaco">
    <a href="{{ URL::route('admin.home') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<div class="mobile-hide">
    <div class="container">
    <h4><b>Visualizar Cadastros</b>
    <a class="btn waves-effect waves-light gradient right" href="{{route('admin.cadastros')}}">Cadastrar 
    <i class="material-icons right">add_circle_outline</i>
    </a>
    </h4>
  </div>
</div>
<div class="desktop-hide">
    <h4 class="center"><b>Visualizar Cadastros</b>
      @if(auth()->user()->is_admin)
      <a class="btn waves-effect waves-light gradient" href="{{route('admin.insercoes')}}">Cadastrar 
      <i class="material-icons right">add_circle_outline</i>
      @else
      <a class="btn waves-effect waves-light gradient" href="{{route('estoqueMenu')}}">Cadastrar
      <i class="material-icons right">add_circle_outline</i>
      @endif
      </a>
    </h4>
</div>
<div class="container">
<div class="row sem-fundo">
<div class="input-field col s12 input-outlined">
        <a class="material-icons prefix right">search</a>
        <input onkeydown="digitandoCadastros()" id="icon_prefix" type="text" placeholder="Pesquisar...">
        <div id="resultados" class="z-depth-2">
          <table id="tabela_resultados" class="highlight centered responsive-table">

          </table>
        </div>

    </div>
</div>
<div class="chips-chips" id="chips">
<a id="All" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)">Todos</a>
<a id="Produto" class="waves-effect waves-light btn-flat gradient" onclick="changeFilter(id)"><i class="material-icons left">free_breakfast</i>Produto</a>
<a id="Doador" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">face</i>Doador</a>
<a id="Tipo" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">layers</i>Tipo</a>
<a id="Medida" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">fitness_center</i>Medida</a>
<a id="Marca" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">copyright</i>Marca</a>
<a id="Estoque" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">view_compact</i>Estoque</a>
</div>
</div>
<div class="container z-depth-2 ">
<nav class="nav-form blue lighten-1"></nav>
<table class="All highlight centered ">
@if(empty($all))
<div class="All ">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez nenhum cadastro.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
</div>
@else
<thead class="grey-text text-darken-4">
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                @if(auth()->user()->is_admin)
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($all as $allItem)
              <tr>
                  <td class="grey-text text-darken-3">{{$allItem['nome']}}</td>
                  @if($allItem['tipo']=="produto/Alimento")
                  <td><span class="new badge red" data-badge-caption="">{{$allItem['tipo']}}</span></td>
                  @elseif($allItem['tipo']=="produto/Escritorio")
                  <td><span class="new badge blue" data-badge-caption="">{{$allItem['tipo']}}</span></td>
                  @elseif($allItem['tipo']=="tipo")
                  <td><span class="new badge green" data-badge-caption="">{{$allItem['tipo']}}</span></td>
                  @elseif($allItem['tipo']=="medida")
                  <td><span class="new badge orange" data-badge-caption="">{{$allItem['tipo']}}</span></td>
                  @elseif($allItem['tipo']=="marca")
                  <td><span class="new badge teal" data-badge-caption="">{{$allItem['tipo']}}</span></td>
                  @elseif($allItem['tipo']=="estoque")
                  <td><span class="new badge pink darken-3" data-badge-caption="">{{$allItem['tipo']}}</span></td>

                  @else
                  <td class="grey-text text-darken-2">{{$allItem['tipo']}}</td>
                  @endif
              </tr>
          @endforeach
          </tbody>
@endif
</table>
<table class="Produto highlight centered responsive-table">
@if(empty($produtos_cadastrados))
<div class="Produto">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez cadastro de produto.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
</div>
@else
<thead class="grey-text text-darken-4">
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Código de barra</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($produtos_cadastrados as $produto)
              <tr name="{{$produto->nome}}{{$produto->id}}">
                  <td class="grey-text text-darken-3" name="{{$produto->nome}}">{{$produto->nome}}</td>
                  <td class="grey-text text-darken-2">{{$produto->marca}}</td>
                  <td class="grey-text text-darken-2">{{$produto->tipo}}</td>
                  <td class="grey-text text-darken-2">{{$produto->codigo_barra}}</td>
                  @if(auth()->user()->is_admin && isset($_GET['tipo']) && $_GET['tipo'] == "produto")
                  <td><a onclick="adicionarProduto({{$produto->id}})" class="btn-floating waves-effect waves-light gradient"><i class="material-icons">add</i></a></td>
                  @elseif(auth()->user()->is_admin )
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarProduto({{$produto->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarProduto({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger"><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
@endif
</table>
<table class="Doador highlight centered responsive-table">
@if(empty($doadores))
<div class="Doador">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez cadastro de Doador.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
</div>
@else
<thead class="grey-text text-darken-4">
            <tr>
                <th>Nome/Instituição</th>
                <th>CPF/CNPJ</th>
                <th>Telefone</th>
                <th>email</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($doadores as $doador)
            @if($doador->tipo == 'fisico' || $doador->tipo != 'juridico')
            <tr name="{{$doador->nome}}{{$doador->id}}">
            @else
            <tr name="{{$doador->instituicao}}{{$doador->id}}}">
            
            @endif
              @if($doador->tipo=="fisico")
                <td class="grey-text text-darken-3" name="{{$doador->nome}}">{{$doador->nome}}</td>
                <td class="grey-text text-darken-3">{{$doador->cpf}}</td>
                <td class="grey-text text-darken-2">{{$doador->telefone}}</td>
                <td class="grey-text text-darken-2">{{$doador->email}}</td>
              @elseif($doador->tipo=="juridico")
                <td class="grey-text text-darken-3" name="{{$doador->instituicao}}">{{$doador->instituicao}}</td>
                <td class="grey-text text-darken-3">{{$doador->cnpj}}</td>
                <td class="grey-text text-darken-2">{{$doador->telefone}}</td>
                <td class="grey-text text-darken-2">{{$doador->email}}</td>
              @else
              <td class="grey-text text-darken-3" name="{{$doador->nome}}">{{$doador->nome}}</td>
              <td class="grey-text text-darken-3">N/A</td>
              <td class="grey-text text-darken-3">N/A</td>
              <td class="grey-text text-darken-3">N/A</td>
              @endif
                  @if(auth()->user()->is_admin && isset($_GET['tipo']) && $_GET['tipo'] == "doador")
                  <td><a onclick="adicionarDoador({{$doador->id}})" class="btn-floating waves-effect waves-light gradient"><i class="material-icons">add</i></a></td>
                  @elseif(auth()->user()->is_admin )
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarDoador({{$doador->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarDoador({{$doador->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" ><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
@endif
</table>
<table class="Tipo highlight centered ">
@if(empty($tipos))
<div class="Tipo">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez cadastro de Tipo.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
</div>
@else
<thead class="grey-text text-darken-4">
            <tr>
                <th>Tipo</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($tipos as $tipo)
              <tr name="{{$tipo->tipo}}{{$tipo->id}}">
                <td class="grey-text text-darken-3">{{$tipo->tipo}}</td>
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarTipo({{$tipo->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarTipo({{$tipo->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger"><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
@endif

</table>
<table class="Medida highlight centered ">
@if(empty($medidas))
<div class="Medida">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez cadastro de Medida.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
</div>
@else
<thead class="grey-text text-darken-4">
            <tr>
                <th>Medida</th>
                <th>Abreviação</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($medidas as $medida)
              <tr name="{{$medida->medida}}{{$medida->id}}">
                <td class="grey-text text-darken-3">{{$medida->medida}}</td>
                @if(empty($medida->abreviacao))
                <td class="grey-text text-darken-3">N/A</td>
                @else
                <td class="grey-text text-darken-3">{{$medida->abreviacao}}</td>
                @endif
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarMedida({{$medida->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarMedida({{$medida->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" ><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
@endif
</table>
<table class="Marca highlight centered ">
@if(empty($marcas))
<div class="Marca">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez cadastro de Marca.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
</div>
@else
<thead class="grey-text text-darken-4">
            <tr>
                <th>Marca</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($marcas as $marca)
              <tr name="{{$marca->marca}}{{$marca->id}}">
                <td class="grey-text text-darken-3">{{$marca->marca}}</td>
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarMarca({{$marca->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarMarca({{$marca->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" ><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
@endif
</table>
<table class="Estoque highlight centered ">
@if(empty($estoques_disponiveis))
<div class="Estoque">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez cadastro de Estoque.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
</div>
@else
<thead class="grey-text text-darken-4">
            <tr>
                <th>Estoque</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($estoques_disponiveis as $estoque)
              <tr name="{{$estoque->estoque}}{{$estoque->id}}">
              @if($estoque->estoque=="sem estoque")
                @continue
              @else
                <td class="grey-text text-darken-3">{{$estoque->estoque}}</td>
              @endif
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarEstoque({{$estoque->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarEstoque({{$estoque->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" ><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
@endif
</table>
</div>
<br>
<br>
<br>

<div id="modal1" class="modal confirm">
    <div class="modal-content">
      <h4>Tem certeza que deseja deletar o Produto?</h4>
        <br>
        <div class="row right">
            <input type="hidden" id="modalid"/>
            <button class="btn-flat waves-effect waves-light modal-close" ><b>Cancelar</button>
            <a class="btn waves-effect waves-light red darken-2 modal-close" onclick="deletarProduto()"><b>Deletar</a>
            <br>
    </div>
    </div>
</div>

<div id="modal2" class="modal confirm">
    <div class="modal-content">
      <h4>Tem certeza que deseja deletar o Doador?</h4>
        <br>
        <div class="row right">
            <input type="hidden" id="modalid"/>
            <button class="btn-flat waves-effect waves-light modal-close" ><b>Cancelar</button>
            <a class="btn waves-effect waves-light red darken-2 modal-close" onclick="deletarDoador()"><b>Deletar</a>
            <br>
    </div>
    </div>
</div>

<div id="modal3" class="modal confirm">
    <div class="modal-content">
      <h4>Tem certeza que deseja deletar o Tipo?</h4>
        <br>
        <div class="row right">
            <input type="hidden" id="modalid"/>
            <button class="btn-flat waves-effect waves-light modal-close" ><b>Cancelar</button>
            <a class="btn waves-effect waves-light red darken-2 modal-close" onclick="deletarTipo()"><b>Deletar</a>
            <br>
    </div>
    </div>
</div>

<div id="modal4" class="modal confirm">
    <div class="modal-content">
      <h4>Tem certeza que deseja deletar a Medida?</h4>
        <br>
        <div class="row right">
            <input type="hidden" id="modalid"/>
            <button class="btn-flat waves-effect waves-light modal-close" ><b>Cancelar</button>
            <a class="btn waves-effect waves-light red darken-2 modal-close" onclick="deletarMedida()"><b>Deletar</a>
            <br>
    </div>
    </div>
</div>

<div id="modal5" class="modal confirm">
    <div class="modal-content">
      <h4>Tem certeza que deseja deletar a Marca?</h4>
        <br>
        <div class="row right">
            <input type="hidden" id="modalid"/>
            <button class="btn-flat waves-effect waves-light modal-close" ><b>Cancelar</button>
            <a class="btn waves-effect waves-light red darken-2 modal-close" onclick="deletarMarca()"><b>Deletar</a>
            <br>
    </div>
    </div>
</div>

<div id="modal6" class="modal confirm">
    <div class="modal-content">
      <h4>Tem certeza que deseja deletar o Estoque?</h4>
        <br>
        <div class="row right">
            <input type="hidden" id="modalid"/>
            <button class="btn-flat waves-effect waves-light modal-close" ><b>Cancelar</button>
            <a class="btn waves-effect waves-light red darken-2 modal-close" onclick="deletarEstoque()"><b>Deletar</a>
            <br>
    </div>
    </div>
</div>

<div id="modal7" class="modal">
    <div class="modal-content">
      <h4>Atualizar Marca</h4>
      <form method="POST" action="{{route('admin.marca.atualizar')}}">
            {{ csrf_field() }}
            <br>
            <div class="input-field" >
                <i class="material-icons prefix">font_download</i>
                @if($marca_antiga != null)
                    <input value="{{$marca_antiga->marca}}" required="required" placeholder="marca" name="marca" id="marcaInput" type="text">
                    <input value="{{$marca_antiga->id}}" type="hidden" name="id">
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

<div id="modal8" class="modal">
 <div class="modal-content">
    <h4>Atualizar Tipo</h4>
    <form method="get" action="{{route('admin.tipo.atualizar')}}">
        {{ csrf_field() }}
        <br>
        <div class="input-field">
            <i class="material-icons prefix">label</i>
            @if($tipo_antigo != null)
                <input type="hidden" name="id" value="{{$tipo_antigo->id}}">
                <input value="{{$tipo_antigo->tipo}}" required="required" placeholder="tipo" id="tipo" name="tipo" type="text">
            @endif
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

<div id="modal9" class="modal">
<div class="modal-content">
    <h4>Atualizar Medida</h4>
    <form method="post" action="{{route('admin.medida.atualizar')}}">
        {{ csrf_field() }}
        <br>
        <div class="row">
        <div class="input-field col s11">
            <i class="material-icons prefix">linear_scale</i>
            @if($medida_antiga != null)
                <input type="hidden" name="id" value="{{$medida_antiga->id}}">
                <input value="{{$medida_antiga->medida}}" required="required" id="medida" name="medida" type="text" placeholder="Quilo">
            @endif
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
                @if($medida_antiga != null)
                <input value="{{$medida_antiga->abreviacao}}" minlength="2" maxlength="2" required="required" id="abreviacao" name="abreviacao" type="text" placeholder="kg">
                <label for="unidade">Abreviação
                @endif
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

<div id="modal10" class="modal">
<div class="modal-content">
    <h4>Atualizar Estoque</h4>
    <form method="post" action="{{route('admin.estoque.atualizar')}}">
        {{ csrf_field() }}
        <br>
        <div class="input-field">
            <i class="material-icons prefix">view_compact</i>
            @if($estoque_antigo)
                <input type="hidden" name="id" value="{{$estoque_antigo->id}}">
                <input value="{{$estoque_antigo->estoque}}" required="required" id="estoque" name="estoque" type="text" placeholder="Almoxarifado">
            @endif    
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

<script>

    var typingTimer; //timer identifier
    var doneTypingInterval = 1000; //time in ms, 1 second for example

    //on keyup, start the countdown
    function digitandoCadastros() {
        clearTimeout(typingTimer); 
        typingTimer = setTimeout(buscarCadastros, doneTypingInterval);
    }

    function buscarCadastros() {
            input = document.getElementById('icon_prefix')
            query = input.value
            tabela = document.getElementById('tabela_resultados')
            tabela.innerHTML = "" 

            //verificar se é codigo de barras
            if(!isNaN(parseFloat(query)) && isFinite(query)) {

                $.get("{{url('/admin/buscar/codigo_barra?query=')}}" + query, (data, status) => {
                    for(let i = 0; i < data.length; i++) {
                        if(document.getElementById(data[i]['nome']) == null) {
                            var tr = document.getElementsByName(data[i]['nome'] + data[i]['id'])[0].outerHTML
                            tabela.innerHTML += tr
                        }
                    }
                });

            } else {
                $.get("{{url('/admin/buscar/cadastros?query=')}}" + query, (data, status) => {
                    console.log("testando...") 
                    console.log(data)
                    
                    for(let i = 0; i < data.length; i++) {
                        if(data[i]['tipo'] == 'juridico') {
                            if(document.getElementById(data[i]['instituicao']) == null) {
                                var tr = document.getElementsByName(data[i]['instituicao'] + data[i]['id'])[0].outerHTML
                                tabela.innerHTML += tr
                            }
                        } else {
                            if(document.getElementById(data[i]['nome']) == null) {
                                var tr = document.getElementsByName(data[i]['nome'] + data[i]['id'])[0].outerHTML
                                tabela.innerHTML += tr
                            }
                        }
                        
                    }
                }); 
            }

    }


    function changeFilter(id){
        switch(id){
            case "All":
                changeStateElements(id);
            break;
            case "Produto":
                changeStateElements(id);
            break;
            case "Doador":
                changeStateElements(id);
            break;
            case "Tipo":
                changeStateElements(id);
            break;
            case "Medida":
                changeStateElements(id);
            break;
            case "Marca":
                changeStateElements(id);
            break;
            case "Estoque":
                changeStateElements(id);
            break;
        }
    }
    function changeStateElements(id){
        if(!document.getElementById(id).classList.contains("gradient")){
                let list=document.getElementById("chips").getElementsByTagName("A");
                for(item of list){
                    if(item.className.includes("gradient")){
                        item.classList.remove("gradient");
                        document.getElementsByClassName(item.id)[0].style="display:none !important;";
                        if(document.getElementsByClassName(item.id)[1]!=null){
                            document.getElementsByClassName(item.id)[1].style.display="none";
                        }
                        break;
                    }
                }
                document.getElementById(id).classList.add("gradient");
                if(document.getElementsByClassName(id)[0].classList.contains("responsive-table") && window.innerWidth<=400){
                    document.getElementsByClassName(document.getElementById(id).id)[0].style="display:block!important;";
                    if(document.getElementsByClassName(document.getElementById(id).id).lenght>1){
                        document.getElementsByClassName(item.id)[1].style.display="block";
                    }
                }
                else{
                    document.getElementsByClassName(document.getElementById(id).id)[0].style="display:table!important;";
                    if(document.getElementsByClassName(document.getElementById(id).id).lenght>1){
                        document.getElementsByClassName(item.id)[1].style.display="block";
                    }
                }
                }

    }
    

    function sleep (time) {
        return new Promise((resolve) => setTimeout(resolve, time));
    }
    function exibirModal(modal) {
        sleep(500, 1).then(() => {
            const elem = document.getElementById(modal);
            const instance = M.Modal.init(elem, {dismissible: false});
            instance.open();
        });
    }

    //produto
    function atualizarProduto(id) {
        document.getElementById('produto_id').value = id;
        window.location.href = "{{route('produto')}}?id=" + id;
    }

    function confirmarProduto(id) {
        document.getElementById('produto_id').value = id;
        const elem = document.getElementById('modal1');
        const instance = M.Modal.init(elem, {dismissible: false});
        instance.open();
    }

    function deletarProduto() {
        var id = document.getElementById('produto_id').value;
        window.location.href = "{{route('produto.deletar')}}?id=" + id;
    }

    //doador
    function atualizarDoador(id) {
        document.getElementById('produto_id').value = id;
        window.location.href = "{{route('doador')}}?id=" + id;
    }

    function confirmarDoador(id) {
        document.getElementById('produto_id').value = id;
        const elem = document.getElementById('modal2');
        const instance = M.Modal.init(elem, {dismissible: false});
        instance.open();
    }

    function deletarDoador() {
        var id = document.getElementById('produto_id').value;
        window.location.href = "{{route('admin.doador.deletar')}}?id=" + id;
    }

    //tipo
    function atualizarTipo(id) {
        document.getElementById('produto_id').value = id;
        window.location.href = "{{route('admin.listarCadastros')}}?tipo_id=" + id;
    }

    function confirmarTipo(id) {
        document.getElementById('produto_id').value = id;
        const elem = document.getElementById('modal3');
        const instance = M.Modal.init(elem, {dismissible: false});
        instance.open();
    }

    function deletarTipo() {
        var id = document.getElementById('produto_id').value;
        window.location.href = "{{route('admin.tipo.deletar')}}?id=" + id;
    }

    //medida
    function atualizarMedida(id) {
        document.getElementById('produto_id').value = id;
        window.location.href = "{{route('admin.listarCadastros')}}?medida_id=" + id;
    }

    function confirmarMedida(id) {
        document.getElementById('produto_id').value = id;
        const elem = document.getElementById('modal4');
        const instance = M.Modal.init(elem, {dismissible: false});
        instance.open();
    }

    function deletarMedida() {
        var id = document.getElementById('produto_id').value;
        window.location.href = "{{route('admin.medida.deletar')}}?id=" + id;
    }

    //marca
    function atualizarMarca(id) {
        document.getElementById('produto_id').value = id;
        window.location.href = "{{route('admin.listarCadastros')}}?marca_id=" + id;
    }

    function confirmarMarca(id) {
        document.getElementById('produto_id').value = id;
        const elem = document.getElementById('modal5');
        const instance = M.Modal.init(elem, {dismissible: false});
        instance.open();
    }

    function deletarMarca() {
        var id = document.getElementById('produto_id').value;
        window.location.href = "{{route('admin.marca.deletar')}}?id=" + id;
    }

    //estoque
    function atualizarEstoque(id) {
        document.getElementById('produto_id').value = id;
        window.location.href = "{{route('admin.listarCadastros')}}?estoque_id=" + id;
    }

    function confirmarEstoque(id) {
        document.getElementById('produto_id').value = id;
        const elem = document.getElementById('modal6');
        const instance = M.Modal.init(elem, {dismissible: false});
        instance.open();
    }

    function deletarEstoque() {
        var id = document.getElementById('produto_id').value;
        window.location.href = "{{route('admin.estoque.deletar')}}?id=" + id;
    }

    function adicionarProduto(id) {
        url_anterior = "{{$_SERVER['HTTP_REFERER']}}"
        if(url_anterior.indexOf('produto') != -1) {
            let url=new URL(url_anterior);
            let productId=url.searchParams.get("produto");
            window.location.href = url_anterior.replace(`produto=${productId}`,`produto=${id}`)
        } else if(url_anterior.indexOf('doador') != -1){
            window.location.href = url_anterior + "&produto=" + id;
        }else{
            window.location.href = "{{route('entradaProduto')}}?produto=" + id;
        }
        
    }

    function adicionarDoador(id) {
        url_anterior = "{{$_SERVER['HTTP_REFERER']}}"
        if(url_anterior.indexOf('doador') != -1) {
            let url=new URL(url_anterior);
            console.log(url_anterior)
            let productId=url.searchParams.get("doador");
            window.location.href = url_anterior.replace(`doador=${productId}`,`doador=${id}`)
        } else if(url_anterior.indexOf('produto') != -1){
            window.location.href = url_anterior + "&doador=" + id;
        }else{
            window.location.href = "{{route('entradaProduto')}}?doador=" + id;
        }
        
        
    }
</script>
@if(isset($_GET['tipo']) && $_GET['tipo'] == "doador")
<script>
    changeFilter("Doador");
</script>
@endif

@if(isset($_GET['rel']))
<script>
   let tipos = [
       'Produto',
       'Doador',
       'Tipo',
       'Marca',
       'Medida',
       'Estoque'
   ]

    var query = location.search.slice(1);
    var partes = query.split('&');
    var data = {};
    partes.forEach(function (parte) {
        var chaveValor = parte.split('=');
        var chave = chaveValor[0];
        var valor = chaveValor[1];
        data[chave] = valor;
    });

   for(let i = 0; i < tipos.length; i++) {
       if(data.rel == tipos[i].toLowerCase()) {
           changeFilter(tipos[i])
           break;
       }
   }

</script>
@endif

@if($marca_antiga != null)
 <script>
    exibirModal('modal7')
 </script>
@endif

@if($tipo_antigo != null)
 <script>
    exibirModal('modal8')
 </script>
@endif

@if($medida_antiga != null)
 <script>
    exibirModal('modal9')
 </script>
@endif

@if($estoque_antigo != null)
 <script>
    exibirModal('modal10')
 </script>
@endif

@endsection
