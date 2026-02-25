<!doctype html>
<html class="no-js aleric-dark" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Conexão Jovem</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('aleric/assets/img/logo/favicon.png') }}">

    
    <link rel="stylesheet" href="{{ asset('aleric/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('aleric/assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('aleric/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('aleric/assets/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('aleric/assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('aleric/assets/css/main.css') }}">
    @livewireStyles
</head>

<body class="tp-magic-cursor loaded video-production-bg">
@include('site.components.startup_agency_dark.legacy-browser')
@include('site.components.startup_agency_dark.loading')
@include('site.components.startup_agency_dark.magic-cursor')
@include('site.components.startup_agency_dark.backtotop')
@include('site.components.startup_agency_dark.offcanvas')
<header>
    @include('site.components.startup_agency_dark.header')
</header>
<div id="smooth-wrapper">
    <div id="smooth-content">
        <main>
            @include('site.components.startup_agency_dark.hero')
            @include('site.components.startup_agency_dark.video')
            @include('site.components.startup_agency_dark.service')
            @include('site.components.startup_agency_dark.portfolio')
            @include('site.components.startup_agency_dark.blog')

        </main>
        <footer>
            @include('site.components.startup_agency_dark.footer')
        </footer>
    </div>
</div>
@include('site.components.startup_agency_dark.scripts')
</body>

</html>






