@extends('template.site')

@section('titulo','Menu')

<style>

#section-to-print {
    font-weight: normal;
    display: none;
}
.row{
    margin-bottom:0 !important;
}
.waves-effect.waves-light.btn-flat.gradient{
}
textarea {
  outline: none;
  height:50% !important;
  resize:none;
  font:16px 'Noto Sans JP',sans-serif !important;
  background: url({{asset('relatorio.png')}}) center center no-repeat;
  background-size: 500px 200px;
}
h4{
    text-align:center;
}
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
<meta id="token" name="csrf-token" content="{{ csrf_token() }}"/>
@section('conteudo')

<div class="butaoEspaco">
<a href="{{ URL::previous() }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
</a>
</div>
<br>
<h4><b>Relatório</b></h4>
    <!-- <div class="col l1"></div>
        <button type="submit" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">print</i></button>
        <a onclick="baixarPdf()" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">picture_as_pdf</i></a>
    </div> -->
    <br>
<div class="container">
<div class="container z-depth-2 ">
<nav class="nav-form blue lighten-1"></nav>
    <form name="form1" method="post" action="{{route('relatorio.gerar')}}" target="_blank">
        {{ csrf_field() }}
        <div class="row">
        <br>
            <div class="input-field col s12 l4 offset-l1">
                <i class="material-icons prefix">date_range</i>
                <input required type="text" class="datepicker" id="data_inicial" name="data_inicial" placeholder="20/02/2020">
                <label for="data">Data Inicial</label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">date_range</i>
                <input required type="text" class="datepicker" id="data_final" name="data_final" placeholder="20/02/2020">
                <label for="data">Data final</label>
            </div>
        </div>
        <div class="row">
        <div class="input-field col s12 l4 offset-l1">
            <i class="material-icons prefix">reorder</i>
            <select class="date" id="tipo" name="tipo[]" multiple>
                <option id="opc_geral" value="geral" selected >Geral</option>
                <option id="opc_entrada" value="entrada">Entrada</option>
                <option id="opc_saida" value="saida">Saída</option>
                <option id="opc_vencimento" value="vencimento">Vencimento</option>
                <option id="opc_baixa" value="baixa">Quantidade baixa</option>
                <option id="opc_em_dia" value="baixa">Em dia</option>
                <option id="opc_sem_estoque" value="baixa">Sem estoque</option>
            </select>
            <label for="data">Tipo de relatório</label>
        </div>
        <div class="col l2"></div>
        <div class="input-field col s12 l4">
            <i class="material-icons prefix">portrait</i>
            <select class="date" id="usuario" name="usuario[]" multiple>
                <option selected id="opc_ambos" value="ambos">Ambos</option>
                <option id="opc_admin" value="admin" >Admin</option>
                <option id="opc_superv" value="supervisor">Supervisor</option>
            </select>
            <label for="data">Usuário</label>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s12 l5 offset-l1">
            <i class="material-icons prefix">portrait</i>
            @if(isset($_GET['produto']))
                <select name="produto[]" id="produto" multiple>
                    <option id="opc_todos" value="todos">Todos os produtos</option>
                    @foreach($produtos as $produto )
                        <option class="opc_produto" selected value="{{$produto['id']}}">{{$produto['nome']}}</option>
                    @endforeach
                </select>
                <a href="{{route('admin.listarCadastros')}}?acao=relatorio&tipo=produto&produto=2" class="modal-trigger radius white-text">
                      <i class="tiny material-icons">add_circle_outline</i>
                      <span>Escolher outro Produto</span>
                </a>   
            @else
                <select name="produto[]" id="produto">
                    <option value="todos" selected>Todos os produtos</option>
                </select>
                <label for="produto">Produto</label>
                <a href="{{route('admin.listarCadastros')}}?acao=relatorio&tipo=produto" class="modal-trigger radius white-text">
                      <i class="tiny material-icons ">add_circle_outline</i>
                      <span>Escolher Produto</span>
                </a>     
            @endif
        </div>
        </div>
        <br>
        
    </form>
        <div class="row valign center">
            <button onclick="submitForm()" class="btn waves-effect waves-light btn-flat gradient">
                <b>Gerar Relatório<i class="material-icons right">send</i></b> 
            </button>
        </div>
    <br>
</div>
</div>
<br>
<br>

<script>
    function submitForm() {
        
        if(document.getElementById('data_final').value == "" || document.getElementById('data_inicial').value == "") {
            alert("Preencha as datas!")
        } else {
            if(ambos() && geral() && todos()) {
                document.form1.submit()
            }
        }
    }

    function ambos() {
        let ambos = document.getElementById('opc_ambos')
        let superv = document.getElementById('opc_superv')
        let admin = document.getElementById('opc_admin')
        let retorno = true

        if(ambos.selected && (superv.selected || admin.selected)) {
            alert("Selecione apenas AMBOS ou outro usuário!")
            retorno = false
        }

        return retorno
    }

    function geral() {
        let geral = document.getElementById('opc_geral')
        let entrada = document.getElementById('opc_entrada')
        let saida = document.getElementById('opc_saida')
        let vencimento = document.getElementById('opc_vencimento')
        let baixa = document.getElementById('opc_baixa')
        let em_dia = document.getElementById('opc_em_dia')
        let sem_estoque = document.getElementById('opc_sem_estoque')
        let retorno = true

        if(geral.selected) {
            if(entrada.selected || saida.selected || vencimento.selected || baixa.selected || em_dia.selected || sem_estoque.selected) {
                alert("Selecione apenas GERAL ou outro tipo de filtragem!")
                retorno = false
            }
        }

        return retorno

    }

    function todos() {
        let todos = document.getElementById('opc_todos')
        let elementos = document.getElementsByClassName('opc_produto')
        let selecionado = false
        let retorno = true

        if(todos==null){
            return true;
        }else{
            for(let i = 0; i < elementos.length; i++) {
                if(elementos[i].selected) {
                    selecionado = true
                }
            }

            if(todos.selected && selecionado) {
                alert("Selecione apenas TODOS OS PRODUTOS ou outros produtos!")
                retorno = false
            }

        }
        return retorno
    }
</script>

@endsection

