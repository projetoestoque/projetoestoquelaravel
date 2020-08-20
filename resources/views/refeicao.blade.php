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
    <a href="{{ URL::route('saida.menu') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
  @else
    <a href="{{ URL::route('saida.menu') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4 ">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
  </a>
  @endif
</div>
<br>
<h3 class="center-align"><b>Inserir Refeição</h3>
<br>
<div class="container z-depth-2 valing-wrapper">
    <nav class="nav-form blue darken-4"></nav>
    <form method="post" action="{{route('admin.refeicao.cadastrar')}}">
        {{ csrf_field() }}
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">restaurant_menu</i>
                <select required="required" id="selectTipo" name="refeicao">
                    <option value="" disabled selected>Escolha a Refeição</option>
                    <option value="Cafe">Café da Manhã</option>
                    <option value="LancheManha">Lanche da Manhã</option>
                    <option value="Almoco">Almoço</option>
                    <option value="LancheTarde">Lanche da Tarde</option>
                </select>
                <label>Refeição <span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Qual das refeições do dia esta sendo registrada </span>
                </div>
            </div>
            <div class="col l2">
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Qual das refeições do dia esta sendo registrada</span>
            </div></div>
            </div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">access_time</i>
                <input required type="text" name="data" placeholder="00/00/0000" class="datepicker">
                <label>Data da Refeição <span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A data que a refeição foi servida</span>
                </div>
            </div>
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A data que a refeição foi servida</span>
            </div></div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
            <i class="material-icons prefix">plus_one</i>
                <input required="required" id="quantidade" name="quantidade" type="number" placeholder="10">
                <label for="quantidade">Porções servidas (em unidade)<span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quantas refeições foram postas Ex:5 porções</span>
                </div>
            </div>
            <div class="col l2">
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Quantas refeições foram postas Ex:5 porções</span>
            </div></div>
            </div>
                <div class="input-field col s12 l4">
                <i class="material-icons prefix">archive</i>
                <input required step="0.1" placeholder="2.5" type="number"  name="desperdicio">
                <label> Desperdício em Kg<span class="important">*</span></label>
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Em quilos,quanto da refeição posta foi desperdiçada </span>
                </div>
            </div>
            <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Em quilos,quanto da refeição posta foi desperdiçada</span>
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
@endsection