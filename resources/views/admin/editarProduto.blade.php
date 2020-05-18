@extends('template.site')

@section('titulo','Editar Produtos')

@section('conteudo')
<div class="butaoEspaco">
    <a href="{{ URL::route('produtos.listar') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">arrow_back</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<h3 class="center-align"><b>Editar Produto</h3>
<br>
<div class="container z-depth-2 valing-wrapper">
    <nav class="nav-form blue darken-4"></nav>
    <form action="{{route('admin.produto.atualizar',$registro->id)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">style</i>
                <select required="required" id="selectProduto" name="Id_produto">
                    <option value="" disabled selected>Escolha o Produto</option>
                    @forelse($produtos as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                    @empty
                    <option value="0">Sem produtos</option>
                    @endforelse
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
                <input required type="number" placeholder="5" name="quantidade">
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
                <input required type="text" name="vencimento" placeholder="00/00/0000" class="datepicker">
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
                <option value="" disabled selected>Escolha a medida</option>
                    @forelse($medidas as $medida)
                    <option value="{{$medida->id}}">{{$medida->medida}}</option>
                    @empty
                    <option value="0">Sem Medidas</option>
                    @endforelse
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
                    <option value="" disabled selected>Escolha o doador</option>
                    <option value="0">Doador Anônimo</option>
                    <option value="1">Recursos Próprios</option>
                    @forelse($doadores as $doador)
                    @if($doador->tipo == "fisico")
                    <option value="{{$doador->id}}">{{$doador->id}} | {{$doador->nome}}</option>
                    @else
                    <option value="{{$doador->id}}">{{$doador->id}} | {{$doador->instituicao}}</option>
                    @endif
                    @empty
                    <option value="0">Sem doadores</option>
                    @endforelse
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
                    <option value="" disabled selected>Escolha o Estoque</option>
                    @forelse($estoques as $estoque)
                    <option value="{{$estoque->id}}">{{$estoque->estoque}}</option>
                    @empty
                    <option value="0">Sem estoques</option>
                    @endforelse
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
    </form>
</div>
<br>
<br>
@endsection