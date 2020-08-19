@extends('template.site')

@section('titulo','Produtos')
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('conteudo')

@if(session('update'))
    <script>
        alert("{{session('update')}}");
        window.location.href = "{{route('admin.listarCadastros')}}"
    </script>
@endif

<div class="butaoEspaco">

@if(isset($produto))
    <a href="{{ URL::route('admin.listarCadastros')}}?rel=produto" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
@else
    @if(auth()->user()->is_admin)
        <a href="{{ URL::route('admin.cadastros') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
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
@if(isset($produto))
<h3 class="center-align"><b>Atualizar Produto</h3>
@else
<h3 class="center-align"><b>Cadastrar novo Produto</h3>
@endif
<br>
<div class="container z-depth-2 valing-wrapper">
    <nav class="nav-form blue darken-4"></nav>
    @if(isset($produto))
        <form action="{{route('admin.produto.atualizar')}}" method="post">
    @else
        <form action="{{route('produto.cadastrar')}}" method="post">
    @endif
        {{csrf_field()}}
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mode_edit</i>
                @if(isset($produto))
                    <input required type="text" value="{{$produto->nome}}" placeholder="nome"  name="nome">
                @else
                    <input required type="text" placeholder="nome"  name="nome">
                @endif
                <label>Nome <span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">domain</i>
                @if(isset($produto))
                    <input type="text" value="{{$produto->codigo_barra}}" maxlength="12" minlength="12" onkeypress='return SomenteNumero(event)' placeholder="999999999999" name="codigo_barra">
                @else
                    <input type="text" placeholder="999999999999" maxlength="12" minlength="12" onkeypress='return SomenteNumero(event)' name="codigo_barra">
                @endif
                <label>Codigo de barra</label>
            </div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">layers</i>
                <select id="selectTipo" required="required" name="tipo">
                    @if(isset($produto))
                        <option value="{{$produto->tipo}}"  selected>{{$produto->tipo}}</option>
                        @forelse($tipos as $tipo)
                        <option value="{{$tipo->tipo}}">{{$tipo->tipo}}</option>
                        @empty
                        <option value="sem tipo">Sem Tipos</option>
                        @endforelse
                    @else
                        <option value="" disabled selected>Escolha o tipo do Produto</option>
                        @forelse($tipos as $tipo)
                        <option value="{{$tipo->tipo}}">{{$tipo->tipo}}</option>
                        @empty
                        <option value="sem tipo">Sem Tipos</option>
                        @endforelse
                    @endif
                </select>
                <label>Tipo<span class="important">*</span></label>
                @if(auth()->user()->is_admin)
                 <a data-target="modal2" class="modal-trigger radius white-text">
                      <i class="tiny material-icons ">add_circle_outline</i>
                      <span>Cadastrar Tipo</span></a>
                @endif
                <div class="tooltip desktop-hide">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Tipo é a categoria do produto(Alimento,higiene,escritório) </span>
                </div>
                </div>
            <div class="col l2">
            <div class="mobile-hide">
            <div class="tooltip">
                <i class="material-icons">info_outline</i>
                <span class="tooltiptext">Tipo é a categoria do produto(Alimento,higiene,escritório) </span>
            </div>
            </div>
            </div>
            <div class="input-field col s12 l4">
            <i class="material-icons prefix"> copyright</i>
                <select required="required" id="selectMarca" name="marca">
                    @if(isset($produto))
                        <option value="{{$produto->marca}}" selected>{{$produto->marca}}</option>
                        @forelse($marcas as $marca)
                        <option value="{{$marca->marca}}">{{$marca->marca}}</option>
                        @empty
                        <option value="sem marca">Sem Marcas</option>
                        @endforelse
                    @else
                        <option value="" disabled selected>Escolha a marca</option>
                        @forelse($marcas as $marca)
                        <option value="{{$marca->marca}}">{{$marca->marca}}</option>
                        @empty
                        <option value="sem marca">Sem Marcas</option>
                        @endforelse
                    @endif
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
        <div class="row">
        <div class="col l1 "></div>
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
            <button class="modal-close waves-effect waves-black btn-flat right">Fechar</button>
    </div>
</div>

<div id="modal2" class="modal">
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
            <button class="modal-close waves-effect waves-black btn-flat right">Fechar</button>
    </div>
</div>

<script>
     function SomenteNumero(e){
        var tecla=(window.event)?event.keyCode:e.which;
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
        else  return false;
        }
    }

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


$("#estoqueBtn").click(function(){
	var estoque = $("#modalEstoque").val();
	if (estoque == "") {
		alert("Digite um Estoque!!!");
		return false;
	}

  $.get("{{url('/admin/estoque/atualizar?estoque=')}}" + estoque, function(data, status){
    if (data != false) {
	    var newOption = new Option(data.estoque, data.estoque, false, false);
       $('#selectEstoque').append(newOption).trigger('change');
       $('#selectEstoque').formSelect();
	    alert ("Estoque cadastrado com sucesso !");
	} else {
	    alert("Estoque já existe !");
	}
  });
});
</script>


@endsection
