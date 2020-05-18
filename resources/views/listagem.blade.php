@extends('template.site')

@section('titulo','Listagem')

@section('conteudo')
<div class="butaoEspaco">
@if(auth()->user()->is_admin)
    <a href="{{ URL::route('admin.home') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
  @else
    <a href="{{ URL::route('home') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4 ">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
  </a>
  @endif
</div>
<br>
<br>
<br>
<div class="container z-depth-2 valing-wrapper">
<table class="highlight centered responsive-table">
        <thead>
        <nav class="nav-form blue lighten-1"></nav>
        </thead>
        <h5 class="header"><b>Listagem de Produtos em estoque<b></h5>
        <thead class="grey-text ">
          <tr>
              <th>Nome</th>
              <th>Quantidade</th>
              <th>Medida</th>
              <th>Estoque</th>
              <th>Vencimento</th>
              <th>Codigo de barras</th>
              <th>Tipo</th>
              <th>Marca</th>
              @if(auth()->user()->is_admin)
              <th>Ações</th>
              @endif
          </tr>
        </thead>
        <tbody>
        @foreach($produtos_estoque as $produto)
            <tr>
                <td>{{$produto->nome}}</td>
                <td class="grey-text text-darken-3">
                 @if($produto->quantidade<=4)
                 <div>{{$produto->quantidade}}<i class="tiny material-icons red-text">brightness_1</i></div>
                 @else
                 {{$produto->quantidade}}
                 @endif
                 </td>
                 <td class="grey-text text-darken-3">{{$produto->medida}}</td>
                <td class="grey-text text-darken-3">{{$produto->estoque->estoque}}</td>
                <td class="grey-text text-darken-3">{{$produto->vencimento}}</td>
                <td>{{$produto->codigo_barra}}</td>
                <td>{{$produto->tipo}}</td>
                <td>{{$produto->marca}}</td>
                @if(auth()->user()->is_admin)
                <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarEntrada({{$produto->id}})"><i class="material-icons">edit</i></a>
                <button onclick="confirmarEntrada({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" data-target="modal2"><i class="material-icons">delete</i></button>
                </td>
                @endif
                
            </tr>
        @endforeach
        </tbody>
      </table>
      <div class="container">
<div class="row right">
{{$produtos_estoque->links('pagination::default')}}
</div>
</div>
      <br/><br/><br/><br/><br/>
      
      <table class="highlight centered responsive-table">
        <thead>
        <nav class="nav-form blue lighten-1"></nav>
        </thead>
        <h5 class="header"><b>Listagem de Produtos cadastrados<b></h5>
        <thead class="grey-text ">
          <tr>
              <th>Nome</th>
              <th>Codigo de barras</th>
              <th>Tipo</th>
              <th>Marca</th>
              @if(auth()->user()->is_admin)
              <th>Ações</th>
              @endif
          </tr>
        </thead>
        <tbody>
        @foreach($produtos_cadastrados as $produto)
            <tr>
                <td>{{$produto->nome}}</td>
                <td class="grey-text text-darken-3">
                 {{$produto->codigo_barra}}
                 </td>
                <td class="grey-text text-darken-3">{{$produto->tipo}}</td>
                <td class="grey-text text-darken-3">{{$produto->marca}}</td>
                @if(auth()->user()->is_admin)
                <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarProduto({{$produto->id}})"><i class="material-icons">edit</i></a>
                <button onclick="confirmarProduto({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" data-target="modal1"><i class="material-icons">delete</i></button>
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
        <input type="hidden" id="produto_id"/>
      </table>
      
</div>
<br>
<div class="container">
<div class="row right">
{{$produtos_estoque->links('pagination::default')}}
</div>
</div>

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
      <h4>Tem certeza que deseja deletar o Produto?</h4>
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
  function confirmarProduto(id) {
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