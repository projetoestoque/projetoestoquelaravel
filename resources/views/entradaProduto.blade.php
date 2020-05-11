@extends('template.site')

@section('titulo','Refeição')
@section('classBody','Background')
@section('conteudo')
@if($errors->any())
  <script>
    alert("{{$errors->first()}}");
  </script>
@endif
<div class="butaoEspaco">
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
</div>
<br>
<h3 class="center-align"><b>Inserir Produto</h3>
<br>
<div class="container z-depth-2 valing-wrapper">
    <nav class="nav-form blue darken-4"></nav>
    <form method="post" action="#">
        {{ csrf_field() }}
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">style</i>
                <select required="required" id="selectProduto" name="produto">
                    <option value="" disabled selected>Escolha o Produto</option>
                    <option value="Cafe">Feijão</option>
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
                <select required="required" id="selectMedida" name="medida">
                <option value="" disabled selected>Escolha a medida</option>
                    @forelse($medidas as $medida)
                    <option value="{{$medida->medida}}">{{$medida->medida}}</option>
                    @empty
                    <option value="sem medida">Sem Medidas</option>
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
                <select required="required" name="doador">
                    <option value="" disabled selected>Escolha o doador</option>
                    <option value="anonimo">Doador Anônimo</option>
                    <option value="recursos proprios">Recursos Próprios</option>
                    @forelse($doadoresFisicos as $doador)
                    <option value="{{$doador->nome}}">{{$doador->id}} | {{$doador->nome}}</option>
                    @empty
                    <option value="sem doador">Sem doadores físicos</option>
                    @endforelse
                    @forelse($doadoresJuridicos as $doador)
                    <option value="{{$doador->instituicao}}">{{$doador->id}} | {{$doador->instituicao}}</option>
                    @empty
                    <option value="sem doador">Sem doadores jurídicos</option>
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