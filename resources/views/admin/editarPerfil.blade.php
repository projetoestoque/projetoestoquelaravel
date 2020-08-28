@extends('template.site')
@section('titulo','Menu')
@section('classBody','background-profile')
@section('cssLinks')
<link href="{{asset('css/profile.css')}}" rel="stylesheet">
@endsection
@section('conteudo')
<div class="butaoEspaco">
        <a href="{{ URL::route('admin.profile') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
            <i class="large material-icons">reply</i>
            <span class="ButtaoEspacoTexto"><b>Voltar</span>
        </a>
</div>
<br>
<br>
<div class="container">
    <h4><b>Alterar Informações</b></h4>
</div>
<div class="container z-depth-2">
<br>
    <div class="row">
        <div class="col l12 offset-l1"><h5><b>Contato</b></h5></div>
    </div>
    <div class="row">
        <div class="col l1 offset-l1">
            <h6><b>Telefone</b></h6>
        </div> 
        <div class="col l4">
            <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>        
            <input type="text" id="telefone_ong_1" name="telefone_ong_1" value="87 99999-9999">
            </div>
            <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>        
            <input type="text" id="telefone_ong_2" name="telefone_ong_2" value="87 88888-8888">
            </div>
            <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>        
            <input type="text" id="telefone_ong_3" name="telefone_ong_3" value="87 77777-7777">
            </div>
        </div> 
        <div class="col s12 l1">
            <h6><b>Email</b></h6>
        </div> 
        <div class="col s12 l4">
            <div class="input-field col s12">
            <i class="material-icons prefix">email</i>        
            <input type="text" id="email_ong" name="email_ong" value="pepsi.contato@mail.com">
            </div>
        </div> 
    </div>
    <div class="row">
    <div class="col l12 offset-l1"><h5><b>Endereço</b></h5></div>
    </div>
    <div class="row">
        <div class="col l1 offset-l1">
            <h6><b>Cidade</b></h6>
        </div> 
        <div class="col s12 l4">
            <div class="input-field col s12">
            <i class="material-icons prefix">location_city</i>        
            <input type="text" id="cidade_ong" name="cidade_ong" value="São Paulo">
            </div>
        </div> 
        <div class="col l1 offset-l1">
            <h6><b>Estado</b></h6>
        </div> 
        <div class="col s12 l2">
            <div class="input-field col s12">
            <i class="material-icons prefix">flag</i>        
            <input type="text" id="estado_ong" name="estado_ong" value="SP">
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col s12 l1 offset-l1">
            <h6><b>Rua</b></h6>
        </div> 
        <div class="col s12 l4">
            <div class="input-field col s12">
            <i class="material-icons prefix">home</i>        
            <input type="text" id="rua_ong" name="rua_ong" value="Avenida Paulista">
            </div>
        </div> 
        <div class="col s12 l1 offset-l1">
            <h6><b>CEP</b></h6>
        </div> 
        <div class="col s12 l2">
            <div class="input-field col s12">
            <i class="material-icons prefix">location_on</i>        
            <input type="text" id="cep_ong" name="cep_ong" value="87813-788">
            </div>
        </div> 
    </div>
    <br>
    <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-1"><b>Submit
                    <i class="material-icons right">send</i>
            </button>
            <br>
            <br>
    </div>
</div>
<br>

@endsection
