@extends('template.site')
@section('titulo','Menu')
@section('classBody','background-profile')
@section('cssLinks')
<link href="{{asset('css/profile.css')}}" rel="stylesheet">
@endsection
@section('conteudo')

<div class="container">
    <h4><b>Perfil da ONG</b>
    </h4>
</div>

<br>
<div style="background: {{$ong->cor}};" class="container z-depth-1">
<br>
   <div class="row valign-wrapper hide-on-med-and-down">
        <div class="col s12 l2 offset-l1 valign-wrapper">
            <div class="col s6 hide-on-large-only">
                <img class="logo" src="{{asset('storage/ong/')}}/{{$ong->imagem}}" alt="Logo">
            </div>
            <div class="col s3 offset-s3 hide-on-large-only">
                <a class="btn-floating btn-large waves-effect waves-light white modal-trigger hide-on-large-only" href="#modal1"><i class="material-icons">create</i></a>
            </div>
            <img class="logo hide-on-med-and-down" src="{{asset('storage/ong/')}}/{{$ong->imagem}}" alt="Logo">
        </div>
        <div class="col s12 l5">
            <h3 style="color:white"><b>{{$ong->nome_ficticio}}</b></h3>
            <h5 style="color:white">{{$ong->razao_social}}</h5>
        </div>
        <div class="col s12 l2 offset-l2 hide-on-med-and-down">
        <a class="btn-floating btn-large waves-effect waves-light white modal-trigger" href="#modal1"><i class="material-icons">create</i></a>
        </div> 
   </div>
   <div class="row hide-on-large-only">
        <div class="col s12 l2 offset-l1 valign-wrapper">
            <div class="col s6 hide-on-large-only">
                <img class="logo" src="{{asset('storage/ong/')}}/{{$ong->imagem}}" alt="Logo">
            </div>
            <div class="col s3 offset-s3 hide-on-large-only">
                <a class="btn-floating btn-large waves-effect waves-light white modal-trigger hide-on-large-only" href="#modal1"><i class="material-icons">create</i></a>
            </div>
            <img class="logo hide-on-med-and-down" src="{{asset('storage/ong/')}}/{{$ong->imagem}}" alt="Logo">
        </div>
        <div class="col s12 l5">
            <h3 style="color:white"><b>{{$ong->nome_ficticio}}</b></h3>
            <h5 style="color:white">{{$ong->razao_social}}}</h5>
        </div>
        <div class="col s12 l2 offset-l2 hide-on-med-and-down">
        <a class="btn-floating btn-large waves-effect waves-light white modal-trigger" href="#modal1"><i class="material-icons">create</i></a>
        </div> 
   </div>
   <br>
</div>
<br>
<div class="container z-depth-2">
<br>
    <div class="row valign-wrapper ">
    <div class="col l5 offset-l1"><h5><b>Informações</b></h5></div>
    <div class="col l2 offset-l4 ">
        <a href="{{route('admin.profile.edit')}}" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons black-text">create</i></a>
    </div> 
    </div>
    <div class="row">
        <div class="col l1 offset-l1">
            <h6><b>Cnpj</b></h6>
        </div> 
        <div class="col l3">
            <h6>{{$ong->cnpj}}</h6>
        </div> 
    </div>
    <div class="row">
    <div class="col l12 offset-l1"><h5><b>Contato</b></h5></div>
    </div>
    <div class="row hide-on-med-and-down">
        <div class="col l1 offset-l1">
            <h6><b>Telefone(s)</b></h6>
        </div> 
        <div class="col l2 offset-l1">
            <h6>{{$ong->telefones[0]}}</h6>
            <h6>{{$ong->telefones[1]}}</h6>
            <h6>{{$ong->telefones[2]}}</h6>
        </div> 
        <div class="col l1 offset-l1">
            <h6><b>Email(s)</b></h6>
        </div> 
        <div class="col l2">
            <h6>{{$ong->email}}</h6>
            <h6>{{$ong->email}}</h6>
        </div> 
    </div>
    <div class="row hide-on-large-only">
        <div class="col s6">
            <h6><b>Telefone(s)</b></h6>
        </div> 
        <div class="col s6">
            <h6>{{$ong->telefones[0]}}</h6>
            <h6>{{$ong->telefones[1]}}</h6>
            <h6>{{$ong->telefones[2]}}</h6>
        </div> 
    </div>
    <div class="row hide-on-large-only">
        <div class="col s6">
            <h6><b>Email(s)</b></h6>
        </div> 
        <div class="col s6" style="overflow-wrap: break-word;">
        <h6>{{$ong->email}}</h6>
            <h6>{{$ong->email}}</h6>
        </div> 
    </div>
    <div class="row">
    <div class="col l12 offset-l1"><h5><b>Endereço</b></h5></div>
    </div>
    <div class="row">
        <div class="col s6 l1 offset-l1">
            <h6><b>Cidade/Estado</b></h6>
        </div> 
        <div class="col s6 l2 offset-l1">
            <h6>{{$endereco->cidade}} / {{$endereco->uf}}</h6>
        </div> 
        <div class="col s6 l1 offset-l1">
            <h6><b>Bairro</b></h6>
        </div> 
        <div class="col s6 l2">
            <h6>{{$endereco->bairro}}</h6>
        </div> 
    </div>
    <div class="row ">
        <div class="col s6 l1 offset-l1">
            <h6><b>Rua</b></h6>
        </div> 
        <div class="col s6 l2 offset-l1">
            <h6>{{$endereco->logradouro}}</h6>
        </div> 
        <div class="col s6 l1 offset-l1">
            <h6><b>CEP</b></h6>
        </div> 
        <div class="col s6 l2">
            <h6>{{$endereco->cep}}</h6>
        </div> 
    </div>
    <br>
</div>
<br>

<div id="modal1" class="modal">
    <div class="modal-content">
    <h5 class="blue-text text-darken-2"><b>Alterar Card</b></h5>
    <hr>

    <form id="form" action="{{route('admin.perfil.cadastrar.logo')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <h5>Alterar Foto</h5>

        <div class="row valign-wrapper hide-on-med-and-down">
            <div class="input-field col l2">
                <i class="material-icons large blue-text text-darken-2">add_a_photo</i>
            </div>
            <div class="input-field col l11">
                <input id="file" name="photo" type="file">
            </div>
        </div>

        <div class="row hide-on-large-only">
            <div class="input-field s12 col l2">
                <i class="material-icons large blue-text text-darken-2">add_a_photo</i>
            </div>
            <div class="input-field s12 col l11">
                <input id="file" name="photo1" type="file">
            </div>
        </div>

        <h5>Alterar Cor do Card</h5>
        <br>

        
        <input value="{{$ong->cor}}" type="hidden" id="cor" name="cor">
        <div class="row">
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#080808')" href="#" class="waves-effect waves-teal btn-flat color black"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#ff9800')" href="#" class="waves-effect waves-teal btn-flat color orange"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#0d47a1')" href="#" class="waves-effect waves-teal btn-flat color blue"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#f44336')" href="#" class="waves-effect waves-teal btn-flat color red"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#ffeb3b')" href="#" class="waves-effect waves-teal btn-flat color yellow"></a>
                </div>
                <div class="col l2 color-button" >
                    <a onclick="selecionarCor('#4caf50')" href="#" class="waves-effect waves-teal btn-flat color green"></a>
                </div>
        </div>

        <div class="row">
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#e91e63')" href="#" class="waves-effect waves-teal btn-flat color pink"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#9c27b0')" href="#" class="waves-effect waves-teal btn-flat color purple"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#3f51b5')" href="#" class="waves-effect waves-teal btn-flat color indigo"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#00bcd4')" href="#" class="waves-effect waves-teal btn-flat color cyan"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#795548')" href="#" class="waves-effect waves-teal btn-flat color brown"></a>
                </div>
                <div class="col l2 color-button">
                    <a onclick="selecionarCor('#607d8b')" href="#" class="waves-effect waves-teal btn-flat color blue-grey"></a>
                </div>
        </div>

    </form>
    </div>

    <div class="modal-footer">
      <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      <a onclick="submitForm()" class="modal-close waves-effect waves-green btn-flat gradient">Enviar</a>
    </div>
</div>

<script>
    function selecionarCor(cor) {
        const tagcor=document.getElementById('cor').value = cor
    }

    function submitForm() {
        if(document.getElementById('file').value == "") {
            alert("Selecione um arquivo valido!")
        } else {
            document.getElementById("form").submit()
        }
    }
</script>

@endsection
