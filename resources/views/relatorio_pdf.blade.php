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
    <table style="border: 0px" cellspacing="0">
        <tr>
            <td>
                <table cellspacing="0">
                    <tr bgcolor="#0083b0">
                        <td>
                            <img src="{{storage_path('app/public/ong/' . $data['ong']['logo'])}}" alt="Logo Empresa">
                        </td>
                        <td style="font-size: 0; line-height: 0;" width="150">
                            &nbsp;
                        </td>
                        <td align="right" style="padding-right: 50px; vertical-align:middle;text-align:right;">
                            <h3 id="title" style="font-family: 'Noto Sans JP', sans-serif; color:'#fff'">Relatório de Uso</h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <h2>Detalhes da ONG</h2>
    <table>
        <tr>
            <td style="vertical-align:middle; padding-right:20px">
                <h4>Razão Social</h4>
            </td>
            <td style="border-left:2px solid #0083b0;height: 10px; width:20px ">
            &nbsp;
            </td>
            <td style="vertical-align:middle;">
                <p>{{$data['ong']['razao_social']}}</p>
            </td>
            <td style="font-size: 0; line-height: 0;" width="40">
                &nbsp;
            </td>
            <td style="vertical-align:middle; padding-right:20px">
                <h4>CNPJ</h4>
            </td>
            <td style="border-left:2px solid #0083b0;height: 10px; width:20px ">
            &nbsp;
            </td>
            <td style="vertical-align:middle;">
                <p>{{$data['ong']['cnpj']}}</p>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle; padding-right:20px">
                <h4>Email</h4>
            </td>
            <td style="border-left:2px solid #0083b0;height: 10px; width:20px ">
            &nbsp;
            </td>
            <td style="vertical-align:middle;">
                <p>{{$data['ong']['email']}}</p>
            </td>
            <td style="font-size: 0; line-height: 0;" width="40">
                &nbsp;
            </td>
            <td style="vertical-align:middle; padding-right:20px">
                <h4>Telefone(s)</h4>
            </td>
            <td style="border-left:2px solid #0083b0;height: 10px; width:20px ">
            &nbsp;
            </td>
            <td style="vertical-align:middle;">
                <p>{{$data['ong']['telefones'][0]}}</p>
                <p>{{$data['ong']['telefones'][1]}}</p>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle; padding-right:20px">
                <h4>Endereço</h4>
            </td>
            <td style="border-left:2px solid #0083b0;height: 10px; width:20px ">
            &nbsp;
            </td>
            <td style="vertical-align:middle;">
                <p>{{$data['ong']['endereco']->logradouro}},{{$data['ong']['endereco']->bairro}}. {{$data['ong']['endereco']->cidade}}-{{$data['ong']['endereco']->uf}}. CEP:{{$data['ong']['endereco']->cep}}</p>
            </td>
        </tr>
    </table>
    <br>

    <h2>Opções de Filtragem</h2>
    <table cellspacing="0px">
        <thead>
            <tr bgcolor="#0083b0" style="color:'#fff'">
                <th style="padding-right:60px">data</th>
                <th style="padding-right:60px">Tipo</th>
                <th style="padding-right:60px">Usuários</th>
                <th style="padding-right:30px">Produtos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-right:30px">{{$data['filtragem']['data_inicial']}} - {{$data['filtragem']['data_final']}}</td>
                <td style="padding-right:30px">{{$data['filtragem']['tipo']}}</td>
                <td style="padding-right:30px">{{$data['filtragem']['usuario']}}</td>
                <td style="padding-right:30px">{{$data['filtragem']['produto']}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h2>Relatório</h2>
    @foreach($data['relatorio'] as $data_key=> $datas)
    <b>{{$data_key}}</b>
    <br>
    <br>
    @if(key_exists('0',$datas))
    <table cellspacing="0px" style="text-align:center;">
    <thead style="display:table-header-group">
        <tr bgcolor="#00b4db" style="color:'#fff'">
        @foreach($datas['0'] as $datas_key=>$valor)
        <th style="padding:15px 10px">{{$datas_key}}</th>
        @endforeach
        </tr>
        </thead>
        <tbody style="display:table-row-group">
            <tr>
                @foreach($datas['0'] as $datas_key=>$valor)
                    <td style="padding:15px 10px">{{$valor}}</th>
                @endforeach
            </tr>
        </tbody>
    </table>
    @else
    <p>Não há nada para mostar dessa categoria!</p>
    @endif
    <br>
    @endforeach
    <br><br>
    
@endsection