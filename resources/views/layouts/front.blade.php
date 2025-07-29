<!DOCTYPE html>
<html lang="es">
@include('partials.head')

<body class="bodyPag">

    <div id="app">
        @include('partials.header')

        @yield('content')

        @include('partials.footer')

    </div>

    @include('partials.scripts')

    @yield('especifico')

</body>

</html>
