<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    Application by ProvenSoft.
    @show

</body>
</html>