<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @hasSection('title')
        <title>@yield('title') | Opción Yo</title>
    @else
        <title>Opción Yo</title>
    @endif

    <meta name="description"
        content="Opción Yo es Bienestar Integral. Psicología, Coaching y Nutrición con los mejores profesionales y al mejor precio.">
    <meta name="author" content="Porta Agencia Web">

    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:title" content="Opción Yo">
    <meta property="og:description"
        content="Opción Yo es Bienestar Integral. Psicología, Coaching y Nutrición con los mejores profesionales y al mejor precio.">
    <meta property="og:image" content="{{ asset('assets_front/images/social_seo.jpg') }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="">
    <meta property="twitter:title" content="Opción Yo">
    <meta property="twitter:description"
        content="Opción Yo es Bienestar Integral. Psicología, Coaching y Nutrición con los mejores profesionales y al mejor precio.">
    <meta property="twitter:image" content="{{ asset('assets_front/images/social_seo.png') }}">

    <link rel="icon" type="image/png" href="{{ url('assets_front/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ url('assets_front/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ url('assets_front/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets_front/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ url('assets_front/favicon/site.webmanifest') }}" />
    <link rel="mask-icon" href="{{ url('assets_front/favicon/safari-pinned-tab.svg') }}" color="#0D1D41">
    <meta name="msapplication-TileColor" content="#0D1D41">
    <meta name="theme-color" content="#ffffff">

     @vite(['resources/css/app.css'])
</head>
