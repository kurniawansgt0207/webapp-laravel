<html>
    <title>@yield('title','PT. BKI (Persero)')</title>
    <head>
        @include('_partials.header')
    </head>

    <body>
        <header>
            @include('_partials.navbar')
        </header>
        <section class="container">
            <div>
                @yield('content')
            </div>
        </section>
        <section class="footer">
            @include('_partials.footer')
        </section>
    </body>
</html>