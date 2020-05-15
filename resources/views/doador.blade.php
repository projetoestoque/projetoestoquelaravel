@extends('template.site')

@section('titulo','Doador')

<style>
    #formJuridico {
        display: none;
    }
</style>

@section('conteudo')
@if($errors->any())
<script>
    alert("{{$errors->first()}}");
</script>
@endif
<div class="butaoEspaco">
    @if(auth()->user()->is_admin)
    <a href="{{ URL::route('admin.cadastros') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
        <i class="large material-icons">arrow_back</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
    @else
    <a href="{{ URL::route('superv.cadastros')}}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
        <i class="large material-icons">arrow_back</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
    @endif
</div>
<br>
<input type="checkbox">
<h3 class="center-align"><b>Cadastrar novo Doador</h3>
<br>
<button onclick="showFisico()" id="btnFisico" class="butaoAtivado">
    <i class="material-icons medium pt-5">face</i>
    <span class="butaoText"><b>Cadastrar Doador Físico</span>
</button>
<button onclick="showJuridico()" id="btnJuridico" class="butao">
    <i class="material-icons medium  pt-5">business_center</i>
    <span class="butaoText"><b>Cadastrar Doador Jurídico</span></button>
<div class="container z-depth-2 valing-wrapper">
    <nav id="nav" class="nav-form blue darken-4"></nav>

    <form action="{{route('doador.fisico')}}" method="post" id="formFisico">
        {{csrf_field()}}
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mode_edit</i>
                <input required type="text" value="{{old('nome')}}" placeholder="nome" name="nome">
                <label>Nome<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mail</i>
                <input required type="email" name="e-mail" value="{{old('e-mail')}}" placeholder="exemplo@gmailm.com" class="E-mail">
                <label>Email<span class="important">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">assignment_ind</i>
                <input required value="{{old('cpf')}}" type="text" name="cpf" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" placeholder="000.000.000-00" title="Digite um cpf válido formatado ou não"></input>
                <label>CPF<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">call</i>
                <input required value="{{old('telefone')}}" type="tel" name="telefone" placeholder="87981167793">
                <label>Telefone<span class="important">*</span></label>
            </div>
        </div>

        <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-4"><b>Submit
                    <i class="material-icons right">send</i>
            </button>
            <br>
            <br>
            <label><span class="important">*</span> Campos Obrigatórios</label>
        </div>
        <br>
        <input type="hidden" name="tipo" value="fisico"/>
</div>
</form>
<form method="post" action="{{route('doador.juridico')}}" id="formJuridico">
    <div class="container z-depth-2 valing-wrapper">
        {{csrf_field()}}
        <br>

        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">location_city</i>
                <input required value="{{old('instituicao')}}" type="text" name="instituicao" placeholder="intituicao" class="instituicao">
                <label>Instituição<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mail</i>
                <input required type="email" name="e-mail" value="{{old('e-mail')}}" placeholder="exemplo@gmailm.com" class="E-mail">
                <label>Email<span class="important">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">gavel</i>
                <input required value="{{old('cnpj')}}" type="text" name="cnpj" class="cnpj" pattern="/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$" placeholder="00000000000000" />
                <label>CNPJ<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">call</i>
                <input required value="{{old('telefone')}}" type="tel" name="telefone" placeholder="87981167793">
                <label>Telefone<span class="important">*</span></label>
            </div>
        </div>
        <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-4"><b>Submit
                    <i class="material-icons right">send</i>
            </button>
            <br>

            <br>
            <label><span class="important">*</span> Campos Obrigatórios</label>
        </div>
        <br>
    </div>
    <input type="hidden" name="tipo" value="juridico"/>
</form>
<br>
<br>
<br>
<script>
    function showFisico() {
        document.getElementById("formJuridico").style.display = "none";
        document.getElementById("formFisico").style.display = "block";
        document.getElementById("nav").style.display = "block";
        document.getElementById("btnJuridico").classList.remove('butaoAtivado');
        document.getElementById("btnJuridico").classList.add('butao');
        document.getElementById("btnFisico").classList.remove('butao');
        document.getElementById("btnFisico").classList.add('butaoAtivado');

    }

    function showJuridico() {
        document.getElementById("formFisico").style.display = "none";
        document.getElementById("formJuridico").style.display = "block";
        document.getElementById("nav").style.display = "block";
        document.getElementById("btnFisico").classList.remove('butaoAtivado');
        document.getElementById("btnFisico").classList.add('butao');
        document.getElementById("btnJuridico").classList.remove('butao');
        document.getElementById("btnJuridico").classList.add('butaoAtivado');


    }
</script>
@endsection