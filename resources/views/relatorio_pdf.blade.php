<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <div>
            @if(isset($retorno))
                @foreach($retorno as $item)
                    <b>{{$item['tipo']}}</b><br/>
                    @foreach($item['texto'] as $texto)
                    {{$texto}}<br/><br/>
                    @endforeach
                    <br/>
                @endforeach
            @endif
        </div>
    </body>
</html>