@extends('template.site')
@if(isset($produto_em_estoque))
@section('titulo','Atualizar Produto')
@else
@section('titulo','Novo Produto')
@endif
@section('classBody','Background')
<style>
    .acima{
        margin-top:-10px;
        margin-left:20px;
    }
    .back{
        margin-left:-20px !important;
    }
    .selected-from-lists{
        margin-right:10px !important;
    }
</style>

@section('conteudo')
<div class="butaoEspaco">
@if(isset($produto_em_estoque))
    <a href="{{ URL::route('produtos.listar') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
        <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
@else
    <a href="{{ URL::route('produtos.listar') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
@endif
</div>
<br>
@if(isset($produto_em_estoque))
<h3 class="center-align"><b>Atualizar Produto</h3>
@else
<h3 class="center-align blue-text text-darken-4"><b>Entrada de Produtos</h3>
@endif
<br>
<div class="container z-depth-2 valing-wrapper white">
    <nav class="nav-form blue darken-4"></nav>
    @if(isset($produto_em_estoque))
        <form method="post" action="{{route('admin.entrada.produto.atualizar')}}">
    @else
        <form method="post" action="{{route('entradaProduto')}}">
    @endif
        {{ csrf_field() }}
        <br>
         <h5 class="acima"><b>Dados Principais</b></h5>
         <div class="row"></div>
        <div class="row">
            <div class="col l1"></div> 
            <div class="desktop-hide">
                <div class="input-field col s12 l4">
                @if(isset($produto))
                <i class="material-icons prefix blue-text">style</i>
                <input readonly id="icon_prefix" type="text" value="{{$produto->nome}}">
                <input name="Id_produto" value="{{$produto->id}}" type="hidden">
                <label for="icon_prefix">
                    Produto Selecionado
                </label>
                <a onclick="listarCadastrosProduto()" class="modal-trigger radius white-text">
                <i class="tiny material-icons ">add_circle_outline</i>
                <span>Corrigir Produto</span> </a>
                @else
                <a onclick="listarCadastrosProduto()" class="waves-effect waves-light btn-large gradient left"><i class="material-icons left">style</i>Escolher o Produto</a>
                @endif
                <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O produto serve pra identificar qual produto será inserido </span>
                </div>
                </div>
                </div>
                <div class="mobile-hide">
                <div class="input-field col s12 l4">
                @if(isset($produto))
                <i class="material-icons prefix blue-text">style</i>
                <input readonly id="icon_prefix" type="text" value="{{$produto->nome}}">
                <input name="Id_produto" value="{{$produto->id}}" type="hidden">
                <label for="icon_prefix">
                    Produto Selecionado
                </label>
                <a onclick="listarCadastrosProduto()" class="modal-trigger radius white-text">
                <i class="tiny material-icons ">add_circle_outline</i>
                <span class="selected-from-lists">Corrigir Produto</span> </a>
                @else
                <a onclick="listarCadastrosProduto()" class="waves-effect waves-light btn-large gradient left"><i class="material-icons left">style</i>Escolher o Produto</a>
                @endif
                </div>
            </div>
            <div class="col l2">
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O produto serve pra identificar qual produto será inserido</span>
            </div></div>
            </div>
            <div class="input-field col s12 l4">
            <i class="material-icons prefix">plus_one</i>
                @if(isset($produto_em_estoque))
                    <input required type="number" value="{{$produto_em_estoque->quantidade}}" placeholder="5" name="quantidade">
                @else
                    <input required type="number"  placeholder="5" name="quantidade">
                @endif
                <label>Quantidade <span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quantidade de produtos que será inserida</span>
                </div>
            </div>
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quantidade de produtos que será inserida</span>
            </div></div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="desktop-hide">
             <div class="input-field col s12 l4">
                @if(isset($doador))
                    <i class="material-icons prefix blue-text">style</i>
                    @if($doador->tipo == "fisico" || $doador->tipo != "fisico" )
                    <input readonly id="icon_prefix" id="id_doador" type="text" value="{{$doador->nome}}">
                    <input name="Id_doador" value="{{$doador->id}}" type="hidden">
                    @else
                    <input readonly id="icon_prefix" id="id_doador" type="text" value="{{$doador->instituicao}}">
                    <input name="Id_doador" value="{{$doador->id}}" type="hidden">
                    @endif
                    <label for="icon_prefix">
                        Doador Selecionado
                    </label>
                    <a onclick="listarCadastrosDoador()" class="modal-trigger radius white-text">
                    <i class="tiny material-icons ">add_circle_outline</i>
                    <span>Corrigir Doador</span> </a>
                @else
                <a onclick="listarCadastrosDoador()" class="waves-effect waves-light btn-large gradient"><i class="material-icons left">account_box</i>Escolher o Doador</a>
                @endif
                <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O Doador é de quem recebeu o produto que será inserido</span>
                </div>
                </div>
                </div>
                <div class="mobile-hide">
                <div class="input-field col s12 l4">
                @if(isset($doador))
                    <i class="material-icons prefix blue-text">style</i>
                    @if($doador->tipo == "fisico" || $doador->tipo != "juridico" )
                    <input readonly id="icon_prefix" id="id_doador" type="text" value="{{$doador->nome}}">
                    <input name="Id_doador" value="{{$doador->id}}" type="hidden">
                    @else
                    <input readonly id="icon_prefix" id="id_doador" type="text" value="{{$doador->instituicao}}">
                    <input name="Id_doador" value="{{$doador->id}}" type="hidden">
                    @endif
                    <label for="icon_prefix">
                        Doador Selecionado
                    </label>
                    <a onclick="listarCadastrosDoador()" class="modal-trigger radius white-text">
                    <i class="tiny material-icons ">add_circle_outline</i>
                    <span>Corrigir Doador</span> </a>
                @else
                <a onclick="listarCadastrosDoador()" class="waves-effect waves-light btn-large gradient"><i class="material-icons left">account_box</i>Escolher o Doador</a>
                @endif
                </div>
            </div>
            <div class="col l2">
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O Doador é de quem recebeu o produto que será inserido</span>
            </div></div>
            </div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">view_compact</i>
                <select required="required" id="selectProduto" name="Id_estoque">
                    @if(isset($produto_em_estoque))
                        <option value="{{$produto_em_estoque->estoque->id}}" selected>{{$produto_em_estoque->estoque->estoque}}</option>
                        @forelse($estoques as $estoque)
                        <option value="{{$estoque->id}}">{{$estoque->estoque}}</option>
                        @empty
                        <option value="0">Sem estoques</option>
                        @endforelse
                    @else
                        <option value="" disabled selected>Escolha o Estoque</option>
                        @forelse($estoques as $estoque)
                        <option value="{{$estoque->id}}">{{$estoque->estoque}}</option>
                        @empty
                        <option value="0">Sem estoques</option>
                        @endforelse
                    @endif
                </select>
                <label>Estoque<span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O Estoque é o local onde será armazenado determinados produtos cadastrados</span>
                </div>
            </div>
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O Estoque é o local onde será armazenado determinados produtos cadastrados</span>
            </div></div>
        </div>
        <div class="row">
        <div class="col l1"></div>
        <div class="input-field col s12 l4">
        <i class="material-icons prefix">access_time</i>
                @if(isset($produto_em_estoque))
                    <input required type="text" value="{{$produto_em_estoque->vencimento}}" name="vencimento" placeholder="00/00/0000" class="datepicker">
                @else
                    <input required type="text" name="vencimento" placeholder="00/00/0000" class="datepicker">
                @endif
                <label>Vencimento <span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Data que os produtos vencerá </span>
                </div>
            </div>
            <div class="col l2">
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Data que os produtos vencerá</span>
            </div>
            </div>
            </div>
        </div>
        <h5 style="margin-left:20px;"><b>Dados para Filtragem</b></h5>
        <br>
        <div class="row">
        <div class="col l1 "></div>
        <div class="row">
        <div class="input-field col s12 l4">
                <i class="material-icons prefix">fitness_center</i>
                <select required="required" id="selectMedida" name="Id_medida">
                @if(isset($produto_em_estoque))
                    <option selected value="{{$produto_em_estoque->medida->id}}">{{$produto_em_estoque->medida->medida}}</option>
                    @forelse($medidas as $medida)
                        <option value="{{$medida->id}}">{{$medida->medida}}</option>
                        @empty
                        <option value="1">Sem Medidas</option>
                    @endforelse
                @else
                    <option disabled selected>Escolha a medida</option>
                        @forelse($medidas as $medida)
                        <option value="{{$medida->id}}">{{$medida->medida}}</option>
                        @empty
                        <option value="1">Sem Medidas</option>
                        @endforelse
                @endif
                </select>
                <label for="Id_medida">Medida<span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a unidade de determinado item(Quilo,pacotes,gramas)/span>
                </div>
            </div>
            <div class="col l2">
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a unidade de determinado item(Quilo,pacotes,gramas)</span>
            </div></div>
            </div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">remove_circle</i>
                @if(isset($produto_em_estoque))
                    <input required type="number" value="{{$produto_em_estoque->quantidade_minima}}" placeholder="5" name="quantidade_minima">
                @else
                    <input required type="number"  placeholder="5" name="quantidade_minima">
                @endif
                <label>Quantidade Mínima <span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quantidade Mínima é o valor que junto com a unidade representa quanto o estoque tem que ter no mínimo.Csaso esteja abaixo desse valor será notificado</span>
                </div>
            </div>
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quantidade Mínima é o valor que junto com a unidade representa quanto o estoque tem que ter no mínimo.Caso esteja abaixo desse valor será notificado</span>
            </div></div>
        </div>
        </div>
        <br>
        <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-4"><b>Submit
                    <i class="material-icons right">send</i>
            </button>
            <br>
            <br>
            <label ><span class="important">*</span> Campos Obrigatórios</label>
        </div>
        <br>
        @if(isset($produto))
            <input type="hidden" name="id" value="{{$produto->id}}"/>
        @endif
    </form>
</div>
<br>
<br>

<script>
    function listarCadastrosProduto() {
        window.location.href = "{{route('admin.listarCadastros')}}?tipo=produto"
    }

    function listarCadastrosDoador() {
        window.location.href = "{{route('admin.listarCadastros')}}?tipo=doador"
    }
</script>

@endsection
