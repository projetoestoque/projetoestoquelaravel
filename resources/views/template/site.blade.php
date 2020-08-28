
@include('template._includes.top')

@yield('conteudo')

@if (session('status'))
    <script>
        alert("{{session('status')}}");
    </script>
@endif

@if($errors->any())
<script>
    alert("{{$errors->first()}}");
</script>
@endif

@include('template._includes.footer')

