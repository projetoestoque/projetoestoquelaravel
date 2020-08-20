@extends('template.site')

@section('titulo','Menu')

@section('conteudo')
<style>
.gradient{
    background: linear-gradient(to left, #cb2d3e, #ef473a);;
}
</style>
<div class="butaoEspaco">
    <a href="{{ URL::route('saida.menu') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<div class="container">
    <h4><b>Saída de Produtos</b></h4>
</div>
<div class="container">
<div class="row sem-fundo">
<div class="input-field col s12 input-outlined">
        <i class="material-icons prefix right">search</i>
        <input onkeydown="digitandoEntrada()" id="icon_prefix" type="text" placeholder="Pesquisar...">
    </div>
</div>
</div>
<div class="container z-depth-2 ">
<nav class="nav-form blue lighten-1"></nav>
    <table id="tabela_saida" class="highlight centered responsive-table">
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
              
              <tr style="display: none">
                <td>nome</td>
                <td>quantidade</td>
                <td>tipo</td>
                <td>marca</td>
                <td>vencimento</td>
                <td>
                
                </td>
              </tr>
              
          </tbody>
    </table>
</div>
<div id="modal10" class="modal">
    <div class="modal-content">
    <form action="{{route('saida.post')}}" method="post">
        {{ csrf_field() }}
        @if(isset($entrada))
        <h5><b>Insira as informações de {{$entrada->nome}} para retirá-lo:</b></h5>
        @endif
        <p>Quanto será retirado?</p>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                @if(isset($entrada))
                <input required min="1" max="{{$entrada->quantidade}}" placeholder="10" id="qtd" name="quantidade" type="number" >
                @endif
                <label for="qtd">Quantidade</label>
            </div>
            <div class="input-field col s6">
            @if(isset($entrada))
            <p>{{$entrada->medida}}</p>
            @endif
            </div>
            <!-- Tipo de unidade de medida que foi inserida nesse produto-->
        </div>
        <p>Para que será retirado?</p>
        <div class="row">
        <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                @if(isset($entrada))
                <select name="type_saida" >
                    <option value="doacao">Doação</option>
                    <option value="vencimento">Vencimento</option>
                    <option value="uso">Uso</option>     
                </select>
                @endif
                <label for="qtd">Tipo de Saída</label>
            </div>
        </div>
        @if(isset($entrada))
            <input type="hidden" name="Id_produto" value="{{$entrada->Id_produto}}">
            <input type="hidden" name="Id_doador" value="{{$entrada->Id_doador}}">
            <input type="hidden" name="Id_entrada" value="{{$entrada->id}}">
        @endif
        <button class="btn waves-effect waves-light red darken-2 " type="submit">Retirar</button>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
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

    function limparTabelas() {
        let tabela_saida = document.getElementById('tabela_saida')

        let tabelas = [tabela_saida]
        tabelas.forEach(tabela => {
        let numero_de_linhas = tabela.rows.length
        let linha = 2
        while (numero_de_linhas != 2) {
            tabela.deleteRow(linha)
            numero_de_linhas = tabela.rows.length
        }
        })
  }

    let query

    var typingTimer; //timer identifier
    var doneTypingInterval = 1000; //time in ms, 1 second for example

    //on keyup, start the countdown
    function digitandoEntrada() {
        clearTimeout(typingTimer); 
        typingTimer = setTimeout(buscarEntrada, doneTypingInterval);
    }

    function buscarEntrada() {
        input = document.getElementById('icon_prefix')
        query = input.value

        if(query == "") {
        limparTabelas()
        carregarVariaveis()
        } else {
        
        $.get("{{url('/buscar/saida?query=')}}" + query, (data, status) => {
            
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
                    if(j == 5) {
                        novo_item.innerHTML = `<a onclick="abrirModal('${array[j]}')" class="btn-floating waves-effect waves-light gradient"><i class="material-icons">remove</i></a>`
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
      $.get("{{route('saida.carregar')}}",(data, status) => {
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
              if(j == 5) {
                novo_item.innerHTML = `<a onclick="abrirModal('${array[j]}')" class="btn-floating waves-effect waves-light gradient"><i class="material-icons">remove</i></a>`
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

@if(isset($entrada))
    <script>
        exibirModal('modal10')
    </script>
@endif

@endsection
