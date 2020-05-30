@extends('template.site')

@section('titulo','Login')
@section('classBody','Background3')
@section('conteudo')
<br>
<br>
  <div class="container">
    <div class="row valing-wrapper ">
            <div class="col s12 l6 offset-l3 card z-depth-4">
                <div class="card-content valign ">
                    <div>
                    <h4 class="center-align"><b>Bem vindo de volta!</h4>
                    <h6 class="center-align">Entre para continuar</h6>
                    </div>
                    <form class="col s12 " action="{{route('login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="email" name="name" type="text">
                            <label for="email">Usuário</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                           <i class="material-icons prefix">lock</i>
                            <input id="password" name="password" type="password">
                            <label for="password">Password</label>
                          </div>
                        </div>
                        <div class="row valign center">
                        <button class="btn waves-effect waves-light blue darken-2 "><b>Entrar
                            <i class="material-icons right">send</i>
                        </button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
    </div>
@endsection
@if (Session::has('error'))
    <script>
           var msg = '{{Session::get('error')}}';
           alert(msg);
    </script>
   @endif