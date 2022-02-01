<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fourth Force') }} - @yield('title')</title>

    <link href="{{ asset(config('app.publicurl')) }}dashboard/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    

</head>

<style>
    .mb-3 {
        margin-top: 12px !important;
    }
 
</style>


<body class="sb-nav-fixed">
    @include('includes.template.navbar')
    <div id="layoutSidenav">

        @include('includes.template.sidenavaccordion')
        <div id="layoutSidenav_content">
            <main style="margin: 20px;">
            @include('includes.common.alerts')
                @yield('content')
            </main>
            @include('includes.template.footer')
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset(config('app.publicurl')) }}dashboard/js/scripts.js"></script>
</body>

</html>