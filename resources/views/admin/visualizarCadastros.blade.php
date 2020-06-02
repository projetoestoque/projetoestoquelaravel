@extends('template.site')

@section('titulo','Listagem')

<style>
 .chips-chips{
     margin-bottom:10px;
 }
 .Produto{
     display:none !important;
 }
 .Doador{
    display:none;
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
<div class="chips-chips" id="chips">
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
              <tr>
                  <td class="grey-text text-darken-3">{{$produto->nome}}</td>
                  <td class="grey-text text-darken-2">{{$produto->marca}}</td>
                  <td class="grey-text text-darken-2">{{$produto->tipo}}</td>
                  <td class="grey-text text-darken-2">{{$produto->codigo_barra}}</td>
                  @if(auth()->user()->is_admin)
                  <td><a class="btn-floating waves-effect waves-light blue" onclick="atualizarCadastro({{$produto->id}})"><i class="material-icons">edit</i></a>
                  <button onclick="confirmarEntrada({{$produto->id}})" class="btn-floating waves-effect waves-light red darken-2 modal-trigger" data-target="modal2"><i class="material-icons">delete</i></button>
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
              <tr>
              @if($doador->tipo=="fisico")
                <td class="grey-text text-darken-3">{{$doador->nome}}</td>
                <td class="grey-text text-darken-3">{{$doador->cpf}}</td>
                <td class="grey-text text-darken-2">{{$doador->telefone}}</td>
                <td class="grey-text text-darken-2">{{$doador->email}}</td>
              @elseif($doador->tipo=="juridico")
                <td class="grey-text text-darken-3">{{$doador->instituicao}}</td>
                <td class="grey-text text-darken-3">{{$doador->cnpj}}</td>
                <td class="grey-text text-darken-2">{{$doador->telefone}}</td>
                <td class="grey-text text-darken-2">{{$doador->email}}</td>
              @else
              <td class="grey-text text-darken-3">{{$doador->nome}}</td>
              <td class="grey-text text-darken-3">N/A</td>
              <td class="grey-text text-darken-3">N/A</td>
              <td class="grey-text text-darken-3">N/A</td>
              @endif
                  
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
              <tr>
                <td class="grey-text text-darken-3">{{$tipo->tipo}}</td>
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
              <tr>
                <td class="grey-text text-darken-3">{{$medida->medida}}</td>
                @if(empty($medida->abreviacao))
                <td class="grey-text text-darken-3">N/A</td>
                @else
                <td class="grey-text text-darken-3">{{$medida->abreviacao}}</td>
                @endif
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
              <tr>
                <td class="grey-text text-darken-3">{{$marca->marca}}</td>
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
              <tr>
              @if($estoque->estoque=="sem estoque")
                @continue
              @else
                <td class="grey-text text-darken-3">{{$estoque->estoque}}</td>
              @endif
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
    
</script>
@endsection

