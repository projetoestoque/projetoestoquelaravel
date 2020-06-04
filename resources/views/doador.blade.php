@extends('template.site')

@section('titulo','Doador')

<style>
    #formJuridico {
        display: none;
    }
</style>

@section('conteudo')

@if(session('update'))
    <script>
        alert("{{session('update')}}");
        window.location.href = "{{route('admin.listarCadastros')}}"
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
    <a href="{{ URL::previous() }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
        <i class="large material-icons">reply</i>
        <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
@endif
</div>
<br>
<input type="checkbox">

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
                    <input required value="{{$doador->cpf}}" type="text" name="cpf" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" placeholder="000.000.000-00" title="Digite um cpf válido formatado ou não"></input>
                @else
                    <input required value="{{old('cpf')}}" type="text" name="cpf" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" placeholder="000.000.000-00" title="Digite um cpf válido formatado ou não"></input>
                @endif
                <label>CPF<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">call</i>
                @if(isset($doador) && $doador->tipo == "fisico")
                    <input required value="{{$doador->telefone}}" type="tel" name="telefone_fisico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="87981167793">
                @else
                    <input required value="{{old('telefone_fisico')}}" type="tel" name="telefone_fisico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="87981167793">
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
                    <input required value="{{$doador->cpnj}}" type="text" name="cnpj" class="cnpj" pattern="/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$" placeholder="00000000000000" />
                @else
                    <input required value="{{old('cnpj')}}" type="text" name="cnpj" class="cnpj" pattern="/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$" placeholder="00000000000000" />
                @endif
                <label>CNPJ<span class="important">*</span></label>
            </div>
            <div class="col l2"></div>
            <div class="input-field col s12 l4">
                <i class="material-icons prefix">call</i>
                @if(isset($doador) && $doador->tipo == "juridico")
                    <input required value="{{$doador->telefone}}" type="tel" name="telefone_juridico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="87981283493">
                @else
                    <input required value="{{old('telefone_juridico')}}" type="tel" name="telefone_juridico" maxlength="15" onkeypress='return SomenteNumero(event)' placeholder="87981283493">
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
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            // document.getElementById('rua').value=("");
            // document.getElementById('bairro').value=("");
            // document.getElementById('cidade').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            // document.getElementById('rua').value=(conteudo.logradouro);
            // document.getElementById('bairro').value=(conteudo.bairro);
            // document.getElementById('cidade').value=(conteudo.localidade);
            console.log(conteudo)
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                // document.getElementById('rua').value="...";
                // document.getElementById('bairro').value="...";
                // document.getElementById('cidade').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
</script>
@endsection