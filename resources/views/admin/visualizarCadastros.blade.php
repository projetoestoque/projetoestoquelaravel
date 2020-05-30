@extends('template.site')

@section('titulo','Listagem')

<style>
 .chips-chips{
     margin-bottom:10px;
 }
</style>

@section('conteudo')
<div class="butaoEspaco">
    <a href="{{ URL::route('admin.MenuCadastros') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<div class="container">
<h4><b>Visualizar Cadastros</b></h4>
<br>
<div class="chips-chips">
<a id="All" class="waves-effect waves-light btn-flat gradient" onclick="changeFilter(id)">Todos</a>
<a id="Produto" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">free_breakfast</i>Produto</a>
<a id="Doador" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">face</i>Doador</a>
<a id="Tipo" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">layers</i>Tipo</a>
<a id="Medida" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">fitness_center</i>Medida</a>
<a id="Marca" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">copyright</i>Marca</a>
<a id="Estoque" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">view_compact</i>Estoque</a>
</div>
</div>
<div class="container z-depth-2 ">
<table  id="listEstoque">
          <br>
          <br>
            <img src="{{asset('empty.png')}}" class="empty-image" >
            <p class="center-align">Ops! Você ainda não fez nenhum cadastro.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui: 
            <a href="{{route('admin.cadastros')}} "class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
            </p>
            <br>
            <br>
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
    function changeFilter(id){
        switch(id){
            case "All":
                if(!document.getElementById(id).classList.contains("gradient")){
                  document.getElementById("Produto").classList.remove("gradient");
                  document.getElementById("Doador").classList.remove("gradient");
                  document.getElementById("Tipo").classList.remove("gradient");
                  document.getElementById("Medida").classList.remove("gradient");
                  document.getElementById("Marca").classList.remove("gradient");
                  document.getElementById("Estoque").classList.remove("gradient");
                   document.getElementById(id).classList.add("gradient");
                }
            break;
            case "Produto":
                if(!document.getElementById(id).classList.contains("gradient")){
                  document.getElementById("All").classList.remove("gradient");
                  document.getElementById("Doador").classList.remove("gradient");
                  document.getElementById("Tipo").classList.remove("gradient");
                  document.getElementById("Medida").classList.remove("gradient");
                  document.getElementById("Marca").classList.remove("gradient");
                  document.getElementById("Estoque").classList.remove("gradient");
                   document.getElementById(id).classList.add("gradient");
                }
            break;
            case "Doador":
                if(!document.getElementById(id).classList.contains("gradient")){
                  document.getElementById("All").classList.remove("gradient");
                  document.getElementById("Produto").classList.remove("gradient");
                  document.getElementById("Tipo").classList.remove("gradient");
                  document.getElementById("Medida").classList.remove("gradient");
                  document.getElementById("Marca").classList.remove("gradient");
                  document.getElementById("Estoque").classList.remove("gradient");
                   document.getElementById(id).classList.add("gradient");
                }
            break;
            case "Tipo":
                if(!document.getElementById(id).classList.contains("gradient")){
                  document.getElementById("All").classList.remove("gradient");
                  document.getElementById("Produto").classList.remove("gradient");
                  document.getElementById("Doador").classList.remove("gradient");
                  document.getElementById("Medida").classList.remove("gradient");
                  document.getElementById("Marca").classList.remove("gradient");
                  document.getElementById("Estoque").classList.remove("gradient");
                   document.getElementById(id).classList.add("gradient");
                }
            break;
            case "Medida":
                if(!document.getElementById(id).classList.contains("gradient")){
                  document.getElementById("All").classList.remove("gradient");
                  document.getElementById("Produto").classList.remove("gradient");
                  document.getElementById("Doador").classList.remove("gradient");
                  document.getElementById("Tipo").classList.remove("gradient");
                  document.getElementById("Marca").classList.remove("gradient");
                  document.getElementById("Estoque").classList.remove("gradient");
                   document.getElementById(id).classList.add("gradient");
                }
            break;
            case "Marca":
                if(!document.getElementById(id).classList.contains("gradient")){
                  document.getElementById("All").classList.remove("gradient");
                  document.getElementById("Produto").classList.remove("gradient");
                  document.getElementById("Doador").classList.remove("gradient");
                  document.getElementById("Tipo").classList.remove("gradient");
                  document.getElementById("Medida").classList.remove("gradient");
                  document.getElementById("Estoque").classList.remove("gradient");
                   document.getElementById(id).classList.add("gradient");
                }
            break;
            case "Estoque":
                if(!document.getElementById(id).classList.contains("gradient")){
                  document.getElementById("All").classList.remove("gradient");
                  document.getElementById("Produto").classList.remove("gradient");
                  document.getElementById("Doador").classList.remove("gradient");
                  document.getElementById("Tipo").classList.remove("gradient");
                  document.getElementById("Medida").classList.remove("gradient");
                  document.getElementById("Marca").classList.remove("gradient");
                   document.getElementById(id).classList.add("gradient");
                }
            break;
        }
    }
</script>
@endsection

