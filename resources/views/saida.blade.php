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
                <th>Adicionar</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td>Coca cola</td>
                <td>10</td>
                <td>Alimento</td>
                <td>Coca cola</td>
                <td>20/10/2020</td>
                <td><a class="btn-floating waves-effect waves-light modal-trigger gradient" href="#modal10"><i class="material-icons">add</i></a></td>
              </tr>
          </tbody>
    </table>
</div>
<div id="modal10" class="modal">
    <div class="modal-content">
        <h4>Quanto de Coca-cola deseja retirar?</h4>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input placeholder="10" id="qtd" type="number" >
                <label for="qtd">Quantidade</label>
            </div>
            <div class="input-field col s6">
            <p>Latas</p>
            </div>
            <!-- Tipo de unidade que foi inserida nesse produto-->
        </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      <button class="modal-close btn waves-effect waves-light red darken-2 ">Retirar</button>
    </div>
</div>
@endsection
