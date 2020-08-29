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
                    <tr bgcolor="{{$data['ong']['cor']}}">
                        <td>
                            <img src="{{public_path('/storage/ong/' . $data['ong']['logo'])}}" alt="Logo Empresa">
                        </td>
                        <td style="font-size: 0; line-height: 0;" width="150">
                            &nbsp;
                        </td>
                        <td align="right" style="padding-right: 50px; vertical-align:middle;text-align:right;">
                            <h3 id="title" style="font-family: 'Noto Sans JP', sans-serif; color:'#fff'">Relatório de Uso</h3>
                        </td>
                    </tr>
                    <tr>
                    <td>
                        <h3>Detalhes da ONG</h3>
                    </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
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
    <h3>Opções de Filtragem</h3>
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
    <h3>Relatório</h3>
    <b>Entrada</b>
    <br>
    <br>
    <table cellspacing="0px" style="text-align:center;">
    <thead style="display:table-header-group">
        <tr bgcolor="#00b4db" style="color:'#fff'">
            <th style="padding:15px 10px">Produto</th>
            <th style="padding:15px 10px ">quantidade</th>
            <th style="padding:15px 10px">marca</th>
            <th style="padding:15px 10px">dia</th>
            <th style="padding:15px 10px">doador</th>
            <th style="padding:15px 10px">vencimento</th>
        </tr>
        </thead>
        <tbody style="display:table-row-group">
            <tr>
                <td style="padding:15px 10px">Folha Sulfite</td>
                <td style="padding:15px 10px">0</td>
                <td style="padding:15px 10px">hp</td>
                <td style="padding:15px 10px">00/00/2020</td>
                <td style="padding:15px 10px">sem doador</td>
                <td style="padding:15px 10px">00/00/2020</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    
@endsection