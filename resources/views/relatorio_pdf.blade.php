@extends('template.pdf')
@section('cssLinks')
<link href="{{public_path('css/pdf.css')}}" rel="stylesheet">
@if(isset($data))
    <script>
    alert('oie')
    console.log(data)
    </script>
@endif
@endsection
@section('titulo','Relatório dia ' .date("d/m/Y"))
@section('cabecalho')
<table style="border: 0px;width:100%" cellspacing="0">
        <tr bgcolor="#0083b0">
            <td style="font-size: 0; line-height: 0;" width="30" >
                &nbsp;
            </td>
            <td>
            <img src="{{storage_path('app/public/ong/'.$data['ong']['logo'])}}" alt="Logo Empresa">
            </td>
            <td align="right" style="padding-right: 50px; vertical-align:middle;text-align:right;">
                <h3 id="title" style="font-family: 'Noto Sans JP', sans-serif; color:#fff">Relatório de Uso</h3>
            </td>
        </tr>
</table>
    <h2 style="margin-bottom:0">Detalhes da ONG</h2>
    <hr>
    <br>
    <table cellspacing="0px" style="table-layout: fixed;width: 100%;">
        <thead >
            <tr bgcolor="#0083b0" style="color:#fff">
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Email</th>
            </tr>
        </tbody>
    </table>
    <br>
    <table cellspacing="0px" style="table-layout: fixed;width: 100%;">
        <thead >
            <tr bgcolor="#0083b0" style="color:#fff">
            @foreach($data['ong']['telefones'] as $telefone)
                <th>Telefone {{ $loop->index }}</th>
            @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
            @foreach($data['ong']['telefones'] as $telefone)
                <th>{{$telefone}}</th>
            @endforeach
            </tr>
        </tbody>
    </table>
    <br>
    <table cellspacing="0px" style="table-layout: fixed;width: 100%;">
        <thead >
            <tr bgcolor="#0083b0" style="color:#fff">
            @foreach($data['ong']['endereco']->getAttributes() as $key=>$value)
                @if(in_array($key,$data['ong']['endereco']->getFillable()))
                    <th>{{$key}}</th>
                @endif
            @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
            @foreach($data['ong']['endereco']->getAttributes() as $key=>$endereco)
                @if(in_array($key,$data['ong']['endereco']->getFillable()))
                    <th>{{$endereco}}</th>
                @endif
            @endforeach
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <h2 style="margin-bottom:0">Opções de Filtragem</h2>
    <hr>
    <table cellspacing="0px" style="table-layout: fixed;width: 100%;">
        <thead>
            <tr bgcolor="#0083b0" style="color:#fff">
                <th>Data de Início</th>
                <th>Data de Final</th>
                <th>Tipo</th>
                <th>Usuários</th>
                <th>Produtos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>{{$data['filtragem']['data_inicial']}}</th>
                <th>{{$data['filtragem']['data_final']}}</th>
                <th>{{$data['filtragem']['tipo']}}</th>
                <th>{{$data['filtragem']['usuario']}}</th>
                <th>{{$data['filtragem']['produto']}}</th>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <h2 style="margin-bottom:0">Relatório</h2>
    <hr>
    @foreach($data['relatorio'] as $data_key=> $datas)
    <b>{{$data_key}}</b>
    <br>
    <br>
    @if(key_exists('0',$datas))
    <table cellspacing="0px" style="text-align:center;width: 100%;">
        <thead>
            <tr bgcolor="#0083b0" style="color:#fff">
            @foreach($datas['0'] as $datas_key=>$valor)
                <th style="padding:15px 10px">{{$datas_key}}</th>
            @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $array_key=>$array)
            @if($loop->index%2==0)
            <tr>
            @else
            <tr bgcolor="#e0e0e0">
            @endif
                @foreach($array as $acao_key=>$value)
                    <th>{{$value}}</th>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    @else
    <p>Não há nada para mostar dessa categoria!</p>
    @endif
    @endforeach
    <br><br>
    
@endsection