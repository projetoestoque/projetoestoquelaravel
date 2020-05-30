@extends('template.site')

@section('titulo','Listagem')

<style>
    #listAcima {
      display: none;
    }
    #listAbaixo {
      display: none;
    }
    #listSem {
      display: none;
    }
    #emptyAcima{
      display:none; 
    }
    #emptyAbaixo{
      display:none; 
    }
    #emptySem{
      display:none; 
    }
    .select-wrapper input.select-dropdown{
      border-bottom:none !important;
      font-family:'Noto Sans JP' !important;
      text-align:center;
    }
    .select-wrapper .caret{
      right:10px !important;
    }
    @media only screen and (max-width: 450px) {
      .select-wrapper input.select-dropdown{
      border-bottom:none !important;
      font-family:'Noto Sans JP' !important;
      text-align:left;
    }
    .select-wrapper .caret{
      right:100px !important;
    }
    }
</style>
@section('conteudo')
<!-- nao me apagar vlw -->
<input type="hidden" id="produto_id">

<div class="butaoEspaco">
@if(auth()->user()->is_admin)
    <a href="{{ URL::route('admin.MenuEstoque') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
  @else
    <a href="{{ URL::route('estoqueMenu') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4 ">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
  </a>
  @endif
</div>
<br>
<br>
<br>
<div class="container z-depth-2 ">
<table class="highlight centered responsive-table" id="listEstoque">
        <thead>
        <nav class="nav-form blue lighten-1"></nav>
        </thead>
        <h5 class="header"><b>Visualizar Estoque</b>
        <div class="mobile-hide">
        <div class="alinhado-a-direita"> 
        <div class="input-field">
          <select id="filter" onchange="show()">
            <option value="0" selected>Produtos em Estoque</option>
            <option value="1" >Produtos em ordem</option>
            <option value="2">Produtos em baixa</option>
            <option value="3">Produtos sem estoque</option>
          </select>
        </div>
        </div>
        </div>
        <div class="mobile"><div class="desktop-hide">
        <div class="input-field">
          <select id="filter" onchange="show()">
            <option value="0" selected>Produtos em Estoque</option>
            <option value="1" >Produtos em ordem</option>
            <option value="2">Produtos em baixa</option>
            <option value="3">Produtos sem estoque</option>
          </select>
        </div>
        </div>
        </div>
        </h5>
          @if( empty($produtos_estoque))
          <div id="emptyEstoque">
          <br>
          <br>
            <img src="{{asset('caixa.png')}}" class="list-image" >
            <p class="center-align">Ops! Você ainda não deu entrada de nenhum produto.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui: 
            <a class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
          </div>
          @else
          <thead class="grey-text ">
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Quantidade</th>
                <th>Estoque</th>
                <th>Vencimento</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($produtos_estoque as $produto)
              <tr>
                  <td>{{$produto->nome}}</td>
                  <td>{{$produto->marca}}</td>
                  <td class="grey-text text-darken-3">
                  @if($produto->quantidade<=4)
                  <div>{{$produto->quantidade}} {{$produto->abreviacao}}<i class="tiny material-icons red-text">brightness_1</i></div>
                  @else
                  {{$produto->quantidade}} {{$produto->abreviacao}}
                  @endif
                  </td>
                  <td class="grey-text text-darken-3">{{$produto->estoque->estoque}}</td>
                  <td class="grey-text text-darken-3">{{$produto->vencimento}}</td>
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarEntrada({{$produto->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarEntrada({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" data-target="modal2"><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
          @endif 
      </table>
      <table class="highlight centered responsive-table" id="listAcima">
      @if(empty($produtos_acima))
      <div id="emptyAcima">
      <br>
      <br>
      <img src="{{asset('caixa.png')}}" class="list-image" >
      <p class="center-align">Ops! Os produtos estão em baixa quantidade no estoque.</p>
      <br>
      <br>
      </div>
     
          @else
          <thead class="grey-text ">
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Quantidade</th>
                <th>Estoque</th>
                <th>Vencimento</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($produtos_acima as $produto)
              <tr>
                  <td>{{$produto->nome}}</td>
                  <td>{{$produto->marca}}</td>
                  <td class="grey-text text-darken-3">
                  @if($produto->quantidade<=4)
                  <div>{{$produto->quantidade}} {{$produto->abreviacao}}<i class="tiny material-icons red-text">brightness_1</i></div>
                  @else
                  {{$produto->quantidade}} {{$produto->abreviacao}}
                  @endif
                  </td>
                  <td class="grey-text text-darken-3">{{$produto->estoque->estoque}}</td>
                  <td class="grey-text text-darken-3">{{$produto->vencimento}}</td>
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarEntrada({{$produto->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarEntrada({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" data-target="modal2"><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
          @endif 
      </table>
      <table class="highlight centered responsive-table" id="listAbaixo">
      @if( empty($produtos_abaixo))
      <div id="emptyAbaixo">
      <br>
      <br>
      <img src="{{asset('paper.png')}}" class="list-image" >
      <p class="center-align">Não há nenhum produto abaixo do previsto! Bom trabalho.</p>
      <br>
      <br>
      </div>
          @else
          <thead class="grey-text ">
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Quantidade</th>
                <th>Estoque</th>
                <th>Vencimento</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($produtos_abaixo as $produto)
              <tr>
                  <td>{{$produto->nome}}</td>
                  <td>{{$produto->marca}}</td>
                  <td class="grey-text text-darken-3">
                  @if($produto->quantidade<=4)
                  <div>{{$produto->quantidade}} {{$produto->abreviacao}}<i class="tiny material-icons red-text">brightness_1</i></div>
                  @else
                  {{$produto->quantidade}} {{$produto->abreviacao}}
                  @endif
                  </td>
                  <td class="grey-text text-darken-3">{{$produto->estoque->estoque}}</td>
                  <td class="grey-text text-darken-3">{{$produto->vencimento}}</td>
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarEntrada({{$produto->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarEntrada({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" data-target="modal2"><i class="material-icons">delete</i></button>
                  </td>
                  @endif
              </tr>
          @endforeach
          </tbody>
          @endif 
      </table>
      <table class="highlight centered responsive-table" id="listSem">
      @if(empty($produtos_sem))
      <div id="emptySem">
      <br>
      <br>
      <img src="{{asset('paper.png')}}" class="list-image" >
      <p class="center-align">Não há nenhum produto cadastrado sem estoque! Bom trabalho.</p>
      <br>
      <br>
      </div>
          @else
          <thead class="grey-text ">
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Código de Barra</th>
                <th>tipo</th>
                @if(auth()->user()->is_admin)
                <th>Ações</th>
                @endif
            </tr>
          </thead>
          <tbody>
          @foreach($produtos_sem as $produto)
              <tr>
                  <td>{{$produto->nome}}</td>
                  <td>{{$produto->marca}}</td>
                  <td class="grey-text text-darken-3">{{$produto->codigo_barra}}</td>
                  <td class="grey-text text-darken-3">{{$produto->tipo}}</td>
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarProduto({{$produto->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarProduto({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger"><i class="material-icons">delete</i></button>
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
      <h4>Tem certeza que deseja deletar a Entrada?</h4>
        <br>
        <div class="row right">
            <input type="hidden" id="modalid"/>
            <button class="btn-flat waves-effect waves-light modal-close" ><b>Cancelar</button>
            <a class="btn waves-effect waves-light red darken-2 modal-close" onclick="deletarEntrada()"><b>Deletar</a>
            <br>
    </div>
    </div>
</div>

<script>
  function show(){
    if( document.getElementById("filter").value==0){
      document.getElementById("listAcima").style.display = "none";
      document.getElementById("listAbaixo").style.display = "none";
      document.getElementById("listSem").style.display = "none";
      document.getElementById("listEstoque").style.display = "table";
      if(document.getElementById("emptyAcima")!=null){
        document.getElementById("emptyAcima").style.display="none";
      }
      if(document.getElementById("emptyAbaixo")!=null){
        document.getElementById("emptyAbaixo").style.display="none";
      }
      if(document.getElementById("emptySem")!=null){
        document.getElementById("emptySem").style.display="none";
      }
      if(document.getElementById("emptyEstoque")!=null){
        document.getElementById("emptyEstoque").style.display="block";
      }
    }else if( document.getElementById("filter").value==1){
      document.getElementById("listEstoque").style.display = "none";
      document.getElementById("listAbaixo").style.display = "none";
      document.getElementById("listSem").style.display = "none";
      document.getElementById("listAcima").style.display = "table";
      if(document.getElementById("emptyEstoque")!=null){
        document.getElementById("emptyEstoque").style.display="none";
      }
      if(document.getElementById("emptyAbaixo")!=null){
        document.getElementById("emptyAbaixo").style.display="none";
      }
      if(document.getElementById("emptySem")!=null){
        document.getElementById("emptySem").style.display="none";
      }
      if(document.getElementById("emptyAcima")!=null){
        document.getElementById("emptyAcima").style.display="block";
      }
    }else if( document.getElementById("filter").value==2){
      document.getElementById("listEstoque").style.display = "none";
      document.getElementById("listAcima").style.display = "none";
      document.getElementById("listSem").style.display = "none";
      document.getElementById("listAbaixo").style.display = "table";
      if(document.getElementById("emptyEstoque")!=null){
        document.getElementById("emptyEstoque").style.display="none";
      }
      if(document.getElementById("emptyAcima")!=null){
        document.getElementById("emptyAcima").style.display="none";
      }
      if(document.getElementById("emptySem")!=null){
        document.getElementById("emptySem").style.display="none";
      }
      if(document.getElementById("emptyAbaixo")!=null){
        document.getElementById("emptyAbaixo").style.display="block";
      }
    }else if( document.getElementById("filter").value==3){
      document.getElementById("listEstoque").style.display = "none";
      document.getElementById("listAcima").style.display = "none";
      document.getElementById("listAbaixo").style.display = "none";
      document.getElementById("listSem").style.display = "table";
      if(document.getElementById("emptyEstoque")!=null){
        document.getElementById("emptyEstoque").style.display="none";
      }
      if(document.getElementById("emptyAcima")!=null){
        document.getElementById("emptyAcima").style.display="none";
      }
      if(document.getElementById("emptyAbaixo")!=null){
        document.getElementById("emptyAbaixo").style.display="none";
      }
      if(document.getElementById("emptySem")!=null){
        document.getElementById("emptySem").style.display="block";
      }
    }
    
  }
  function confirmarProduto(id) {
    alert('chegueeeeeeeeei')
    document.getElementById('produto_id').value = id;
    const elem = document.getElementById('modal1');
    const instance = M.Modal.init(elem, {dismissible: false});
    instance.open();
  }

  function confirmarEntrada(id) {
    document.getElementById('produto_id').value = id;
    const elem = document.getElementById('modal2');
    const instance = M.Modal.init(elem, {dismissible: false});
    instance.open();
  }

  function deletarProduto() {
    var id = document.getElementById('produto_id').value;
    window.location.href = "{{route('produto.deletar')}}?id=" + id;
  }

  function deletarEntrada() {
    var id = document.getElementById('produto_id').value;
    window.location.href = "{{route('entrada.deletar')}}?id=" + id;
  }
  
  function atualizarEntrada(id) {
    document.getElementById('produto_id').value = id;
    window.location.href = "{{route('entradaProduto')}}?id=" + id;
  }

  function atualizarProduto(id) {
    document.getElementById('produto_id').value = id;
    window.location.href = "{{route('produto')}}?id=" + id;
  }
</script>
@endsection

