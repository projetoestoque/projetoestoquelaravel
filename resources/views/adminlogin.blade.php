@extends('template.site')

@section('titulo','Login')

@section('conteudo')
<br>
<br>
  <div class="container">
    <div class="row valing-wrapper">
            <div class="col s6 offset-s3 card z-depth-4">
                <div class="card-content valign ">
                    <div>
                    <h4 class="center-align"><b>Bem vindo admin!</h4>
                    <h6 class="center-align">Entre para continuar</h6>
                    </div>
                    <form class="col s12 " action="{{route('admin.login.entrar')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="email" name="nome" type="text" class="validate">
                            <label for="email">Usuário</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                           <i class="material-icons prefix">lock</i>
                            <input id="password" name="senha" type="password" class="validate">
                            <label for="password">Password</label>
                          </div>
                        </div>
                        <br>
                        <div class="row valign center">
                        <button class="btn waves-effect waves-light blue darken-2 "><b>Entrar
                            <i class="material-icons right">send</i>
                        </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>

@endsection
