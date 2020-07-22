@extends('template.site')

@section('titulo','Menu')

<style>
.container.z-depth-2{
   height:50vh;
}
</style>
@section('conteudo')
<div class="butaoEspaco">
    <a href="{{ URL::route('admin.home') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<div class="container">
    <h4><b>Saída de Produtos</b></h4>
</div>
<div class="container z-depth-2 ">
<nav class="nav-form blue lighten-1"></nav>
    <table class="highlight centered responsive-table">
        <thead class="grey-text text-darken-4">
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Vencimento</th>
                <th>Retirar</th>
            </tr>
          </thead>
          <tbody>
              @foreach($produtos_estoque as $produto)
              <tr>
                <td>{{$produto->nome}}</td>
                <td>{{$produto->quantidade}}</td>
                <td>{{$produto->tipo}}</td>
                <td>{{$produto->marca}}</td>
                <td>{{$produto->vencimento}}</td>
                <td><a onclick="abrirModal('{{$produto->id}}')" class="btn-floating waves-effect waves-light gradient"><i class="material-icons">add</i></a></td>
              </tr>
              @endforeach
          </tbody>
    </table>
</div>
<div id="modal10" class="modal">
    <div class="modal-content">
    <form action="{{route('saida.post')}}" method="post">
        {{ csrf_field() }}
        @if(isset($entrada))
        <h4>Quanto de {{$entrada->nome}} deseja retirar?</h4>
        @endif
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input required min="1" placeholder="10" id="qtd" name="quantidade" type="number" >
                <label for="qtd">Quantidade</label>
            </div>
            <div class="input-field col s6">
            @if(isset($entrada))
            <p>{{$entrada->medida}}</p>
            @endif
            </div>
            <!-- Tipo de unidade de medida que foi inserida nesse produto-->
        </div>
        @if(isset($entrada))
            <input type="hidden" name="Id_produto" value="{{$entrada->Id_produto}}">
            <input type="hidden" name="Id_doador" value="{{$entrada->Id_doador}}">
            <input type="hidden" name="Id_entrada" value="{{$entrada->id}}">
        @endif
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      <button class="modal-close btn waves-effect waves-light red darken-2 " type="submit">Retirar</button>
    </div>
    </form>
</div>

<input type="hidden" id="id_entrada">

<script>
    function abrirModal(id) {
        window.location.href="/saida?id=" + id
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

    function postModal(produto, doador){
        dados = [produto,doador];
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{route('saida.post')}}");
        xhr.addEventListener("load", function() {
            if (xhr.status == 200) {
                console.log('sucesso: ' + xhr);
                //sucesso!
            } else {
                console.log("erro");
            }
        });

        xhr.send(dados);
    }
</script>

@if(isset($entrada))
    <script>
        exibirModal('modal10')
    </script>
@endif

@endsection
