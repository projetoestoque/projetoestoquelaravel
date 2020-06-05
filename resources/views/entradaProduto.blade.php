@extends('template.site')
@if(isset($produto_em_estoque))
@section('titulo','Atualizar Produto')
@else
@section('titulo','Novo Produto')
@endif
@section('classBody','Background')
@section('conteudo')
<div class="butaoEspaco">
@if(isset($produto_em_estoque))
    <a href="{{ URL::route('produtos.listar') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
        <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
@else
    @if(auth()->user()->is_admin)
        <a href="{{ URL::route('admin.insercoes') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
        <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
        </a>
    @else
        <a href="{{ URL::route('superv.cadastros') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4 ">
        <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
    @endif
@endif
</div>
<br>
@if(isset($produto_em_estoque))
<h3 class="center-align"><b>Atualizar Produto</h3>
@else
<h3 class="center-align"><b>Entrada de Produtos</h3>
@endif
<br>
<div class="container z-depth-2 valing-wrapper">
    <nav class="nav-form blue darken-4"></nav>
    @if(isset($produto_em_estoque))
        <form method="post" action="{{route('admin.entrada.produto.atualizar')}}">
    @else
        <form method="post" action="{{route('entradaProduto')}}">
    @endif
        {{ csrf_field() }}
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">style</i>
                <select required="required" id="selectProduto" name="Id_produto">
                    @if(isset($produto_em_estoque))
                        <option value="{{$produto_em_estoque->Id_produto}}">{{$produto_em_estoque->nome}} | {{$produto_em_estoque->marca}}</option>
                    @else
                    <option value="" disabled selected>Escolha o Produto</option>
                        @forelse($produtos as $produto)
                        <option value="{{$produto->id}}">{{$produto->nome}} | {{$produto->marca}}</option>
                        @empty
                        <option value="0">Sem produtos</option>
                        @endforelse
                    @endif
                </select>
                <label>Produto<span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O produto serve pra identificar qual produto será inserido </span>
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
                <span class="tooltiptext">Data que os produtos serão inseridos </span>
                </div>
            </div>
            <div class="col l2">
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Data que os produtos serão inseridos</span>
            </div></div>
            </div>
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
                <label for="quantidade">Medida<span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a unidade de determinado item(Quilo,pacotes,gramas)/span>
                </div>
            </div>
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a unidade de determinado item(Quilo,pacotes,gramas)</span>
            </div></div>
        </div>
        <div class="row">
        <div class="col l1"></div>
        <div class="input-field col s12 l4">
        <i class="material-icons prefix"> account_box</i>
                <select required="required" name="Id_doador">
                @if(isset($produto_em_estoque))
                    @if($produto_em_estoque->doador->tipo != "juridico")
                        <option value="{{$produto_em_estoque->doador->id}}" >{{$produto_em_estoque->doador->nome}}</option>
                    @else
                        <option value="{{$produto_em_estoque->doador->id}}" >{{$produto_em_estoque->doador->instituicao}}</option>
                    @endif
                        @forelse($doadores as $doador)
                            @if($doador->tipo != "juridico")
                                <option value="{{$doador->id}}" >{{$doador->nome}}</option>
                            @else
                                <option value="{{$doador->id}}" >{{$doador->instituicao}}</option>
                            @endif
                        @empty
                        @endforelse
                @else
                    <option selected disabled >Escolha o doador</option>
                    @forelse($doadores as $doador)
                            @if($doador->tipo != "juridico")
                                <option value="{{$doador->id}}" >{{$doador->nome}}</option>
                            @else
                                <option value="{{$doador->id}}" >{{$doador->instituicao}}</option>
                            @endif
                        @empty
                    @endforelse
                @endif
                </select>
                <label>Doador<span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O Doador é de quem recebeu o produto que será inserido</span>
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
        <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-4"><b>Submit
                    <i class="material-icons right">send</i>
            </button>
            <br>
            <label ><span class="important">*</span> Campos Obrigatórios</label>
        </div>
        <br>
        @if(isset($produto_em_estoque))
        <input type="hidden" name="id" value="{{$produto_em_estoque->id}}"/>
        @endif
    </form>
</div>
<br>
<br>
@endsection
