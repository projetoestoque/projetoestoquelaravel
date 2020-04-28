@extends('template.site')

@section('titulo','Produtos')
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('conteudo')
<div class="butaoEspaco">
  @if(auth()->user()->is_admin)
    <a href="{{ URL::route('admin.cadastros'); }}" class="waves-effect waves-teal btn-flat cyan-text text-darken-4">
    <i class="large material-icons">arrow_back</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
  @else
    <a href="{{ URL::route('superv.cadastros'); }}" class="waves-effect waves-teal btn-flat cyan-text text-darken-4">
    <i class="large material-icons">arrow_back</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
  </a>
  @endif
</div>
<br>
<h3 class="center-align"><b>Cadastrar novo Produto</h3>
<br>
<div class="container z-depth-2 valing-wrapper">
    <nav class="nav-form blue darken-4"></nav>
    <form action="{{route('produto.cadastrar')}}" method="post">
        {{csrf_field()}}
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mode_edit</i>
                <input required type="text" placeholder="nome"  name="nome">
                <label>Nome <span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">access_time</i>
                <input required type="text" name="vencimento" placeholder="00/00/0000" class="datepicker">
                <label>Vencimento <span class="important">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">plus_one</i>
                <input required type="number" placeholder="5" name="quantidade">
                <label>Quantidade <span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">fitness_center</i>
                <select required="required" id="selectMedida" name="medida">
                <option value="" disabled selected>Choose your option</option>
                    @forelse($medidas as $medida)
                    <option value="{{$medida->medida}}">{{$medida->medida}}</option>
                    @empty
                    <option value="sem medida">Sem Medidas</option>
                    @endforelse
                </select>
                <label>Medida<span class="important">*</span></label>
                @if(auth()->user()->is_admin)
	                  <a data-target="modal2" class="modal-trigger radius white-text">
                      <i class="tiny material-icons ">add_circle_outline</i>
                          <span>Cadastrar Medida</span> </a>
                @endif
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a quantidade de determinado item(Quilo,pacotes,gramas) </span>
            </div>
            </div>
        <div class="mobile-hide"><div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">A medida é a quantidade de determinado item(Quilo,pacotes,gramas)      </span>
            </div></div>
        </div>

        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">domain</i>
                <input required type="number" placeholder="100000002" name="codigo_barra">
                <label>Codigo de barra<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">layers</i>
                <select id="selectTipo" required="required" name="tipo">
                    <option value="" disabled selected>Escolha o tipo do Produto</option>
                    @forelse($tipos as $tipo)
                    <option value="{{$tipo->tipo}}">{{$tipo->tipo}}</option>
                    @empty
                    <option value="sem tipo">Sem Tipos</option>
                    @endforelse
                </select>
                <label>Tipo<span class="important">*</span></label>
                @if(auth()->user()->is_admin)
                 <a data-target="modal3" class="modal-trigger radius white-text">
                      <i class="tiny material-icons ">add_circle_outline</i>
                      <span>Cadastrar Tipo</span></a>
                @endif
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Tipo é a classificação geral do produto(Feijão,arroz,Açúcar) </span>
            </div>
            </div>
            <div class="mobile-hide">
            <div class="tooltip ">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Tipo é a classificação geral do produto(Feijão,arroz,Açúcar)</span>
            </div>
            </div>
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
            </div>
            <div class="col l2">
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">O Doador é de quem recebeu o produto</span>
            </div>
            <div class="desktop-hide">
                <br>
            </div>
            </div>

            <div class="input-field col s12 l4">
            <i class="material-icons prefix"> copyright</i>
                <select required="required" id="selectMarca" name="marca">
                    <option value="" disabled selected>Escolha a marca</option>
                    @forelse($marcas as $marca)
                    <option value="{{$marca->marca}}">{{$marca->marca}}</option>
                    @empty
                    <option value="sem marca">Sem Marcas</option>
                    @endforelse
                </select>
                <label>Marca<span class="important">*</span></label>
                @if(auth()->user()->is_admin)
	                  <a data-target="modal1" class="modal-trigger radius white-text">
                      <i class="tiny material-icons ">add_circle_outline</i>
                      <span>Cadastrar Marca</span> </a>
                @endif
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Marca é a marca específica do produto </span>
            </div>
            </div>
            <div class="mobile-hide">
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Marca é a marca específica do produto </span>
            </div>
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
    </form>
</div>
<br>
<br>
<br>
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Nova Marca</h4>
            <br>
            <div class="input-field col s12">
                <i class="material-icons prefix">font_download</i>
                <input required placeholder="marca" id="modalMarca" type="text">
                <label>Nome da Marca</label>
            </div>
            <br>
            <button class="modal-close btn waves-effect waves-light blue darken-2 " id="marcaBtn">Enviar</button>
    </div>
</div>

<div id="modal2" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Nova Medida</h4>
            <br>
            <div class="input-field col s12">
                <i class="material-icons prefix">font_download</i>
                <input required placeholder="medida" id="modalMedida" type="text">
                <label>Nome da Medida</label>
            </div>
            <br>
            <button class="modal-close btn waves-effect waves-light blue darken-2 " id="medidaBtn">Enviar</button>
    </div>
</div>

<div id="modal3" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Novo Tipo</h4>
            <br>
            <div class="input-field col s12">
                <i class="material-icons prefix">font_download</i>
                <input required placeholder="tipo" id="modalTipo" type="text">
                <label>Nome do Tipo</label>
            </div>
            <br>
            <button class="modal-close btn waves-effect waves-light blue darken-2 " id="tipoBtn">Enviar</button>
    </div>
</div>

<script>
    $("#marcaBtn").click(function(){
	var marca = $("#modalMarca").val();
	if (marca == "") {
		alert("Digite uma marca");
		return false;
	}

  $.get("{{url('/admin/marca/atualizar?marca=')}}" + marca, function(data, status){
    if (data != false) {
	    var newOption = new Option(data.marca, data.marca, false, false);
       $('#selectMarca').append(newOption).trigger('change');
       $('#selectMarca').formSelect();
	    alert ("Marca cadastrada com sucesso !");
	} else {
	    alert("Marca já existe !");
	}
  });
});

$("#medidaBtn").click(function(){
	var medida = $("#modalMedida").val();
	if (medida == "") {
		alert("Digite uma medida");
		return false;
	}

  $.get("{{url('/admin/medida/atualizar?medida=')}}" + medida, function(data, status){
    if (data != false) {
	    var newOption = new Option(data.medida, data.medida, false, false);
       $('#selectMedida').append(newOption).trigger('change');
       $('#selectMedida').formSelect();
	    alert ("Medida cadastrada com sucesso !");
	} else {
	    alert("Medida já existe !");
	}
  });
});

$("#tipoBtn").click(function(){
	var tipo = $("#modalTipo").val();
	if (tipo == "") {
		alert("Digite um tipo!!!");
		return false;
	}

  $.get("{{url('/admin/tipo/atualizar?tipo=')}}" + tipo, function(data, status){
    if (data != false) {
	    var newOption = new Option(data.tipo, data.tipo, false, false);
       $('#selectTipo').append(newOption).trigger('change');
       $('#selectTipo').formSelect();
	    alert ("Tipo cadastrado com sucesso !");
	} else {
	    alert("Tipo já existe !");
	}
  });
});
</script>


@endsection
