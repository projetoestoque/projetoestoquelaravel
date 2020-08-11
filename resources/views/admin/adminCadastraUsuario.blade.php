@extends('template.site')

@section('titulo','Doador')

@section('conteudo')
    <div class="butaoEspaco">
        <a href="{{ URL::route('admin.cadastros') }}" class="waves-effect waves-teal btn-flat grey-text text-darken-4">
            <i class="large material-icons">reply</i>
            <span class="ButtaoEspacoTexto"><b>Voltar</span>
        </a>
    </div>
    <br>
    <br>
    <h3 class="center-align"><b>Cadastrar Usuário</h3>
    <br>
    <div class="container z-depth-2 valing-wrapper white">
    <nav class="nav-form blue darken-4"></nav>
    <form method="post">
    <br>
    <div class="row">
        <div class="col l1"></div>
        <div class="input-field col s12 l4">
          <i class="material-icons prefix">account_circle</i>
          <input id="nome" name="nome" type="text" placeholder="admin" required>
          <label for="nome">Nome do Usuário<span class="important">*</span></label>
        </div>
        <div class="col l2"></div>
        <div class="input-field col s12 l4">
          <i class="material-icons prefix">supervisor_account</i>
          <select required name="type_user" id="type_user" onchange="alertAdm(event)">
          <option value="" disabled selected>Escolha um tipo para o usuário</option>
          <option value="adm">Administrador</option>
          <option value="sup">Supervisor</option>
          </select>
          <label>Tipo de Usuário<span class="important">*</span></label>
        </div>
    </div>
    <div class="row">
        <div class="col l1"></div>
        <div class="input-field col s12 l4">
          <i class="material-icons prefix">lock</i>
          <input id="senha" name="senha" type="password" placeholder="admin2020abc1" required>
          <label>Senha<span class="important">*</span></label>
        </div>
        <div class="col l2"></div>
        <div class="input-field col s12 l4">
          <i class="material-icons prefix">lock</i>
          <input id="confirmar_senha" name="confirmar_senha" type="text" placeholder="admin2020abc1" required> 
          <label>Repita a senha<span class="important">*</span></label>
        </div>
    </div>
    <div class="row valign center">
            <button class="btn waves-effect waves-light blue darken-4"><b>Enviar
                    <i class="material-icons right">send</i>
            </button>
            <br>
            <br>
            <label ><span class="important">*</span> Campos Obrigatórios</label>
        </div>
        <br>
    </form>
    </div>

    <script>
    function alertAdm(e){
        if(e.target.value==="adm"){
            alert("Um usuário do tipo Adminstrador possui acesso total ao sistema, portanto apenas cadastre novos adminstradores caso for necessário.")
        }
    }
    </script>
@endsection