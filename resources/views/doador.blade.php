@extends('template.site')

@section('titulo','Doador')

@section('conteudo')
<br>
<h3 class="center-align"><b>Cadastrar novo Doador</h3>
<br>
<div class="container z-depth-2 valing-wrapper">
<nav class="nav-form blue darken-4" ></nav>
        <form action="{{route('doador.cadastrar')}}" method="post">
            {{csrf_field()}}
        <br>
        <div class="row">
            <div class="col s1"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">mode_edit</i>
                <input type="text" name="nome">
                <label>Nome</label>
            </div>
            <div class="col s2"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">mail</i>
                <input type="email" class="E-mail">
                <label>Email</label>
            </div>
        </div>
        <div class="row">
            <div class="col s1"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">assignment_ind</i>
                <input type="text" name="cpf">
                <label>CPF</label>
            </div>
            <div class="col s2"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">gavel</i>
                <input type="text" class="cnpj">
                <label>CNPJ</label>
            </div>
        </div>
        <div class="row">
            <div class="col s1"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">call</i>
                <input type="tel" name="telefone">
                <label>Telefone</label>
            </div>
            <div class="col s2"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">location_city</i>
                <input type="text" class="instituicao">
                <label>Instituição</label>
            </div>
        </div>
        <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-4"><b>Submit
                    <i class="material-icons right">send</i>
            </button>
        </div>
        <br>

    </form>
    </div>
    </div>
    <br>
    <br>
    <br>
@endsection