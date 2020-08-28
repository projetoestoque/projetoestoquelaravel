@extends('template.site')

@section('titulo','Listagem')

<style>
    .chips-chips{
     margin-bottom:10px;
 }
 .listAcima{
    display:none !important;;
 }
 .listAbaixo{
    display:none !important;;
 }
 .listSem{
    display:none !important;; 
 }
 .sem-fundo{
    margin-bottom:0 ;
 }
 .btn.waves-effect.waves-light.gradient{
    margin-top:8px !important;
    border-radius:30px !important;
 }
 @media only screen and (max-width: 400px){
  .container .waves-effect.waves-light.btn-flat.gradient{
    display:Flex;
  }
 }
 .row:after{
   clear:none !important;
 }
</style>
@section('conteudo')
<!-- nao me apagar vlw -->
<input type="hidden" id="produto_id">

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
<div class="mobile-hide">
  <div class="container">
    <h4><b>Visualizar Estoque</b>
      <a class="btn waves-effect waves-light gradient right" href="{{route('entradaProduto')}}">Dar Entrada No Estoque
      <i class="material-icons right">add_circle_outline</i>
      </a>
    </h4>
  </div>
</div>
<div class="desktop-hide">
<h4 class="center"><b>Visualizar Estoque</b>
      <a class="btn waves-effect waves-light gradient" href="{{route('entradaProduto')}}">Dar Entrada No Estoque
      <i class="material-icons right">add_circle_outline</i>
      </a>
    </h4>
</div>
<div class="container">
<div class="row sem-fundo">
<div class="input-field col s12 input-outlined">
        <i class="material-icons prefix right">search</i>
        <input onkeydown="digitandoEntrada()" id="icon_prefix" type="text" placeholder="Pesquisar...">
        <div id="resultados" class="z-depth-2">
          <table id="tabela_resultados" class="highlight centered responsive-table">
          </table>
        </div>
    </div>
</div>
<div class="chips-chips" id="chips">
<a id="listEstoque" class="waves-effect waves-light btn-flat gradient" onclick="changeFilter(id)" >Em Estoque</a>
<a id="listAcima" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)" ><i class="material-icons left">add_circle</i>Em dia</a>
<a id="listAbaixo" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)"><i class="material-icons left">remove_circle</i>Em Alerta</a>
<a id="listSem" class="waves-effect waves-light btn-flat" onclick="changeFilter(id)" "><i class="material-icons left">cancel</i>Sem Estoque</a>
</div>
</div>
</div>
<div class="container z-depth-2 ">
<table id="tabela_estoque" class="listEstoque highlight centered responsive-table">
        <thead>
        <nav class="nav-form blue lighten-1"></nav>
        </thead>
          @if( empty($produtos_estoque))
          <div class="listEstoque">
          <br>
          <br>
            <img src="{{asset('caixa.png')}}" class="list-image" >
            <p class="center-align">Ops! Você ainda não deu entrada de nenhum produto.</p>
            <p class="center-align">Mas não se preocupe! Você pode fazer isso aqui:
            <a href="{{route('entradaProduto')}}"class="btn-floating btn-medium waves-effect waves-light blue"><i class="material-icons">add</i></a>
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
            </tr>
          </thead>
          <tbody>
            <!-- não remover pois é necessario! -->
              <tr style="display: none;">
                  <td>nome</td>
                  <td>marca</td>
                  <td class="grey-text text-darken-3">
                  
                  produto->quantidade / produto->abreviacao
                  
                  </td>
                  <td class="grey-text text-darken-3">produto->estoque->estoque</td>
                  <td class="grey-text text-darken-3">
                  
                    produto->vencimento
                  
                  </td>
              </tr>
            <!-- não remover pois é necessario! -->
          </tbody>
          @endif
      </table>
      <table id="tabela_acima" class="listAcima highlight centered responsive-table">
      @if(empty($produtos_acima))
      <div class="listAcima">
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
            </tr>
          </thead>
          <tbody>
          <!-- não remover pois é necessario! -->
              <tr style="display: none;">
                  <td>nome</td>
                  <td>marca</td>
                  <td class="grey-text text-darken-3">
                  quantidade abreviacao
                  </td>
                  <td class="grey-text text-darken-3">estoque</td>
                  <td class="grey-text text-darken-3">vencimento}}</td>
              </tr>
          <!-- não remover pois é necessario! -->
          </tbody>
          @endif
      </table>
      <table id="tabela_abaixo" class="listAbaixo highlight centered responsive-table">
      @if(empty($produtos_abaixo))
      <div class="listAbaixo">
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
            </tr>
          </thead>
          <tbody>
          <!-- não remover pois é necessario! -->
              <tr style="display: none">
                  <td>nome</td>
                  <td>marca</td>
                  <td class="grey-text text-darken-3">
                    quantidade abreviacao
                  </td>
                  <td class="grey-text text-darken-3">estoque</td>
                  <td class="grey-text text-darken-3">
                    vencimento
                  </td>
              </tr>
          <!-- não remover pois é necessario! -->
          </tbody>
          @endif
      </table>
      <table id="tabela_sem" class="listSem highlight centered responsive-table">
      @if(empty($produtos_sem))
      <div class="listSem">
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
            </tr>
          </thead>
          <tbody>
          <!-- não remover pois é necessario! -->
              <tr style="display: none">
                  <td>nome</td>
                  <td>marca</td>
                  <td class="grey-text text-darken-3">codigo_barra</td>
                  <td class="grey-text text-darken-3">tipo</td>
              </tr>
          <!-- não remover pois é necessario! -->
          </tbody>
          @endif
      </table>
</div>
@if(!empty($produtos_abaixo))
<div class="container">
<p class="red-text" id="description"><i class="tiny material-icons">brightness_1</i> Indica que o produto está abaixo do esperado</p>
</div>
@endif
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
  function changeFilter(id){
        switch(id){
            case "listEstoque":
                changeStateElements(id);
                showMessage(true);
            break;
            case "listAcima":
                changeStateElements(id);
                showMessage(false);
            break;
            case "listAbaixo":
                changeStateElements(id);
                showMessage(true);
            break;
            case "listSem":
                changeStateElements(id);
                showMessage(false);
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
    function showMessage(state){
      if(document.getElementById("description")!=null){
        if(state){
          document.getElementById("description").style.display="block";
        }
        else{
          document.getElementById("description").style.display="none";
        }
      }
    }
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

  let query

  var typingTimer; //timer identifier
  var doneTypingInterval = 1000; //time in ms, 1 second for example

  //on keyup, start the countdown
  function digitandoEntrada() {
    clearTimeout(typingTimer); 
    typingTimer = setTimeout(buscarEntrada, doneTypingInterval);
  }

  function limparTabelas() {
    let tabela_estoque = document.getElementById('tabela_estoque')
    let tabela_acima = document.getElementById('tabela_acima')
    let tabela_abaixo = document.getElementById('tabela_abaixo')
    let tabela_sem = document.getElementById('tabela_sem')

    let tabelas = [tabela_estoque, tabela_acima, tabela_abaixo, tabela_sem]
    tabelas.forEach(tabela => {
      let numero_de_linhas = tabela.rows.length
      let linha = 2
      while (numero_de_linhas != 2) {
        tabela.deleteRow(linha)
        numero_de_linhas = tabela.rows.length
      }
    })
  }

  function buscarEntrada() {
    input = document.getElementById('icon_prefix')
    query = input.value

    if(query == "") {
      limparTabelas()
      carregarVariaveis()
    } else {
    
      $.get("{{url('/admin/buscar/entrada?query=')}}" + query, (data, status) => {
        
        limparTabelas()

        for(let item in data) {
              data[item].forEach(value => {
              let array = Object.values(value)
              let tabela = document.getElementById("tabela_" + item)
              let numero_de_linhas = tabela.rows.length
              let numero_de_colunas = tabela.rows[numero_de_linhas-1].cells.length;
              let nova_linha = tabela.insertRow(numero_de_linhas);

              for (var j = 0; j < numero_de_colunas; j++) {
                // Insere uma coluna na nova linha 
                novo_item = nova_linha.insertCell(j);
                // Insere um conteúdo na coluna
                if(item != "sem" && item != "acima" && j == 2) {
                  if(value.acabando) {
                    novo_item.innerHTML = `${array[j]}<i class="tiny material-icons red-text">brightness_1</i>`
                  } else {
                    novo_item.innerHTML = array[j]
                  }
                } else if(item != "sem" && item != "acima" && j == 4) {
                  if(value.vencendo) {
                    novo_item.innerHTML = `${array[j]}<i class="tiny material-icons red-text">brightness_1</i>`
                  } else {
                    novo_item.innerHTML = array[j]
                  }
                } else {
                  novo_item.innerHTML = array[j]
                }
               
              }
        
            })
          }
      });    
    }      
  }

    function carregarVariaveis() {
      $.get("{{route('produtos.listar.atualizar')}}",(data, status) => {
        for(let item in data) {
          data[item].forEach(value => {
            let array = Object.values(value)
            let tabela = document.getElementById("tabela_" + item)
            let numero_de_linhas = tabela.rows.length
            let numero_de_colunas = tabela.rows[numero_de_linhas-1].cells.length;
            let nova_linha = tabela.insertRow(numero_de_linhas);

            for (var j = 0; j < numero_de_colunas; j++) {
              // Insere uma coluna na nova linha 
              novo_item = nova_linha.insertCell(j);
              // Insere um conteúdo na coluna
              if(item != "sem" && item != "acima" && j == 2) {
                if(value.acabando) {
                  novo_item.innerHTML = `${array[j]}<i class="tiny material-icons red-text">brightness_1</i>`
                } else {
                  novo_item.innerHTML = array[j]
                }
                
              } else if(item != "sem" && item != "acima" && j == 4) {
                if(value.vencendo) {
                  novo_item.innerHTML = `${array[j]}<i class="tiny material-icons red-text">brightness_1</i>`
                } else {
                  novo_item.innerHTML = array[j]
                }
              } else {
                novo_item.innerHTML = array[j]
              }
              
            }
      
          })
        }
        
      }); 
    
    }

    window.onload = function () {
    carregarVariaveis()
  }
</script>

@endsection
