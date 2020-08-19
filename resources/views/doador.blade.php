@extends('template.site')

@section('titulo','Doador')

<style>
    #formJuridico {
        display: none;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@section('conteudo')

@if(session('update'))
    <script>
        alert("{{session('update')}}");
        window.location.href = "{{route('admin.listarCadastros')}}?rel=doador"
    </script>
@endif

<div class="butaoEspaco">
@if(empty($doador))
    @if(auth()->user()->is_admin)
    <a href="{{ URL::route('admin.cadastros') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
    @else
    <a href="{{ URL::route('superv.cadastros')}}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
    <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
    @endif
@else
    <a href="{{ URL::route('admin.listarCadastros')}}?rel=doador" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
        <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
@endif
</div>
<br>

@if(isset($doador))
    <h3 class="center-align"><b>Atualizar Doador</h3>
@else
    <h3 class="center-align"><b>Cadastrar novo Doador</h3>
@endif

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

    @if(isset($doador))
        <form action="{{route('admin.doador.atualizar')}}" method="post" id="formFisico">
        <input type="hidden" name="id" value="{{$doador->id}}">
    @else
        <form action="{{route('doador.fisico')}}" method="post" id="formFisico">
    @endif
        {{csrf_field()}}
        <br>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mode_edit</i>
                @if(isset($doador))
                    <input required type="text" value="{{$doador->nome}}" placeholder="nome" name="nome">
                @else
                    <input required type="text" value="{{old('nome')}}" placeholder="nome" name="nome">
                @endif
                <label>Nome<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mail</i>
                @if(isset($doador) && $doador->tipo == "fisico")
                    <input required type="email" name="email_fisico" value="{{$doador->email}}" placeholder="exemplo@gmailm.com" class="E-mail">
                @else
                    <input required type="email" name="email_fisico" value="{{old('email_fisico')}}" placeholder="exemplo@gmailm.com" class="E-mail">
                @endif
                <label>Email<span class="important">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">assignment_ind</i>
                @if(isset($doador))
                    <input required value="{{$doador->cpf}}" type="text" name="cpf" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" placeholder="000.000.000-00" title="Digite um cpf válido formatado ou não" maxlength="14" minlength="11"></input>
                @else
                    <input required value="{{old('cpf')}}" type="text" name="cpf" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" placeholder="000.000.000-00" title="Digite um cpf válido formatado ou não" maxlength="14" minlength="11"></input>
                @endif
                <label>CPF<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">call</i>
                @if(isset($doador) && $doador->tipo == "fisico")
                    <input required value="{{$doador->telefone}}" type="tel" name="telefone_fisico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="00000000000">
                @else
                    <input required value="{{old('telefone_fisico')}}" type="tel" name="telefone_fisico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="00000000000">
                @endif
                <label>Telefone<span class="important">*</span></label>
            </div>
        </div>
        <div class="row">
        <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">location_on</i>
                @if(isset($doador) && $endereco != null)
                    <input onkeyup="buscarCEPFisico()" value="{{$endereco->cep}}" id="cep_fisico" type="text" name="cep" placeholder="55290-000" maxlength="9" minlength="8"></input>
                @elseif(isset($doador) && $endereco == null)
                    <input onkeyup="buscarCEPFisico()"  id="cep_fisico" type="text" name="cep" placeholder="55290-000" maxlength="9" minlength="8"></input>
                @else
                    <input onkeyup="buscarCEPFisico()" id="cep_fisico" type="text" name="cep" placeholder="55290-000" maxlength="9" minlength="8"></input>
                @endif
                <label>CEP<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">nature_people</i>
                @if(isset($doador) && $endereco != null)
                    <input value="{{$endereco->bairro}}" id="bairro_fisico" type="text" name="bairro" placeholder="Bairro">
                @elseif(isset($doador) && $endereco == null)
                    <input id="bairro_fisico" type="text" name="bairro" placeholder="Bairro">
                @else
                    <input type="text" id="bairro_fisico" name="bairro" placeholder="Bairro">
                @endif
                <label>Bairro/Condomínio/Apartamento<span class="important">*</span></label>
            </div>
        </div>
            <div class="row">
            <div class="col l1"></div>
                <div class="input-field col s12 l4">
                    <i class="material-icons prefix">location_city</i>
                    @if(isset($doador) && $endereco != null)
                        <input value="{{$endereco->cidade}}" id="cidade_fisica" type="text" name="cidade" placeholder="Garanhuns"></input>
                    @elseif(isset($doador) && $endereco == null)
                        <input  id="cidade_fisica" type="text" name="cidade" placeholder="Garanhuns"></input>
                    @else
                        <input type="text" id="cidade_fisica" name="cidade" placeholder="Garanhuns"></input>
                    @endif
                    <label>Cidade<span class="important">*</span></label>
                </div>
                <div class="col l2"></div>
                <div class="input-field col s12 l2">
                    <i class="material-icons prefix">flag</i>
                    @if(isset($doador) && $endereco != null)
                        <input maxlength="2" value="{{$endereco->uf}}" id="estado_fisico" type="text" name="uf" placeholder="PE"></input>
                    @elseif(isset($doador) && $endereco == null)
                        <input maxlength="2" id="estado_fisico" type="text" name="uf" placeholder="PE"></input>
                    @else
                        <input maxlength="2"  type="text" id="estado_fisico" name="uf" placeholder="PE"></input>
                    @endif
                    <label>Estado<span class="important">*</span></label>
                </div>
            </div>
            <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                    <i class="material-icons prefix">home</i>
                    @if(isset($doador) && $endereco != null)
                        <input value="{{$endereco->logradouro}}" id="logradouro_fisico" type="text" name="logradouro" placeholder="Rua"></input>
                    @elseif(isset($doador) && $endereco == null)
                        <input id="logradouro_fisico" type="text" name="logradouro" placeholder="Rua"></input>
                    @else
                        <input type="text" id="logradouro_fisico" name="logradouro" placeholder="Rua"></input>
                    @endif
                    <label>Logradouro</label>
                </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l3">
                    <i class="material-icons prefix">looks_5</i>
                    @if(isset($doador) && $endereco != null)
                        <input value="{{$endereco->numero}}" id="numero_fisico" type="text" name="numero" placeholder="25 / 5b"></input>
                    @elseif(isset($doador) && $endereco == null)
                        <input id="numero_fisico" type="text" name="numero" placeholder="25 / 5b"></input>
                    @else
                        <input type="text" id="numero_fisico" name="numero" placeholder="25 / 5b"></input>
                    @endif
                    <label>Número/ Bloco-lote<span class="important">*</span></label>
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
@if(isset($doador))
    <form method="post" action="{{route('admin.doador.atualizar')}}" id="formJuridico">
    <input type="hidden" name="id" value="{{$doador->id}}">
@else
    <form method="post" action="{{route('doador.juridico')}}" id="formJuridico">
@endif
    <div class="container z-depth-2 valing-wrapper">
        {{csrf_field()}}
        <br>

        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">location_city</i>
                @if(isset($doador))
                    <input required value="{{$doador->instituicao}}" type="text" name="instituicao" placeholder="intituicao" class="instituicao">
                @else
                    <input required value="{{old('instituicao')}}" type="text" name="instituicao" placeholder="intituicao" class="instituicao">
                @endif
                <label>Instituição<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">mail</i>
                @if(isset($doador) && $doador->tipo == "juridico")
                    <input required type="email" name="email_juridico" value="{{$doador->email}}" placeholder="exemplo@gmailm.com" class="E-mail">
                @else
                    <input required type="email" name="email_juridico" value="{{old('email_juridico')}}" placeholder="exemplo@gmailm.com" class="E-mail">
                @endif
                <label>Email<span class="important">*</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col l1"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">gavel</i>
                @if(isset($doador))
                    <input required value="{{$doador->cpnj}}" type="text" name="cnpj" class="cnpj" pattern="/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$" placeholder="XX.XXX.XXX/0001-ZZ" maxlength="18" minlength="14"/>
                @else
                    <input required value="{{old('cnpj')}}" type="text" name="cnpj" class="cnpj" pattern="/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$" placeholder="XX.XXX.XXX/0001-ZZ" maxlength="18" minlength="14"/>
                @endif
                <label>CNPJ<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">call</i>
                @if(isset($doador) && $doador->tipo == "juridico")
                    <input required value="{{$doador->telefone}}" type="tel" name="telefone_juridico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="00000000000">
                @else
                    <input required value="{{old('telefone_juridico')}}" type="tel" name="telefone_juridico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="00000000000">
                @endif
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
    var typingTimer; //timer identifier
    var doneTypingInterval = 1000; //time in ms, 1 second for example

    //on keyup, start the countdown
    function buscarCEPFisico() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(pesquisacepfisico, doneTypingInterval);
    }

    function SomenteNumero(e){
        var tecla=(window.event)?event.keyCode:e.which;
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
        else  return false;
        }
    }

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


    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro_fisico').value = conteudo.logradouro
            document.getElementById('bairro_fisico').value=(conteudo.bairro);
            document.getElementById('cidade_fisica').value=(conteudo.localidade);
            document.getElementById('estado_fisico').value = conteudo.uf
            console.log(conteudo)
        }
    }

    function pesquisacepfisico() {
        valor = document.getElementById('cep_fisico').value
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                document.getElementById('logradouro_fisico').value = "..."
                document.getElementById('bairro_fisico').value= "..."
                document.getElementById('cidade_fisica').value= "..."
                document.getElementById('estado_fisico').value = "..."

                //Cria um elemento javascript.
                var script = document.createElement('script');
                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);
            }
            else {
                alert("Formato de CEP inválido.");
            }
        }
    }

</script>
@endsection
