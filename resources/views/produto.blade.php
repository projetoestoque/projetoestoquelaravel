@extends('template.site')

@section('titulo','Produtos')

@section('conteudo')
<br>
<h3 class="center-align"><b>Cadastrar novo Produto</h3>
<br>
<div class="container z-depth-2 valing-wrapper">
    <nav class="nav-form blue darken-4"></nav>
    <form action="{{route('produto.cadastrar')}}" method="post">
        {{csrf_field()}}
        <br>

        <div class="row">
            <div class="col s1"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">mode_edit</i>
                <input required type="text" name="nome">
                <label>Nome</label>
            </div>
            <div class="col s2"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">access_time</i>
                <input required type="text" name="vencimento" class="datepicker">
                <label>Vencimento</label>
            </div>
        </div>
        <div class="row">
            <div class="col s1"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">plus_one</i>
                <input required type="number" name="quantidade">
                <label>Quantidade</label>
            </div>
            <div class="col s2"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">fitness_center</i>
                <select required name="medida">
                    <option value="" disabled selected>Escolha a medida</option>
                    <option value="kg">Kilo(Kg)</option>
                    <option value="grama">Grama(g)</option>
                    <option value="litro">Litro(l)</option>
                </select>
                <label>Medida</label>
            </div>
            <div class="col s1"></div>
        </div>

        <div class="row">
            <div class="col s1"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">domain</i>
                <input required type="number" name="codigo_barra">
                <label>Codigo de barra</label>
            </div>
            <div class="col s2"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix">layers</i>
                <select required name="tipo">
                    <option value="" disabled selected>Escolha o tipo do Produto</option>
                    <option value="X">X</option>
                    <option value="Y">Y</option>
                </select>
                <label>Doador</label>
            </div>
            <div class="col s1"></div>
        </div>

        <div class="row">
            <div class="col s1"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix"> copyright</i>
                <select required name="marca">
                    <option value="" disabled selected>Escolha a marca</option>
                    <option value="X">Marca X</option>
                    <option value="Y">Marca Y</option>
                </select>
                <label>Doador</label>
            </div>
            <div class="col s2"></div>
            <div class="input-field col s4">
                <i class="material-icons prefix"> account_box</i>
                <select required name="doador">
                    <option value="" disabled selected>Escolha o doador</option>
                    <option value="0">0- Doador Anônimo</option>
                    <option value="1">1- Recursos Próprios</option>
                    <option value="2">2- Doador X</option>
                </select>
                <label>Doador</label>
            </div>
            <div class="col s1"></div>
        </div>
        <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-4"><b>Submit
                    <i class="material-icons right">send</i>
            </button>
        </div>
        <br>
    </form>
</div>
<br>
<br>
<br>
@endsection

