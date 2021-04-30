<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/items.css') }}" />

    
    <title>@yield('title')</title>
</head>
<body>
    @section('topmenu')
    @include('menubar')
    @show

    <div class="container">
        @yield('content')
    </div>

    @section('footer')
    <footer>Application by ProvenSoft.</footer> 
    @show

</body>
</html>