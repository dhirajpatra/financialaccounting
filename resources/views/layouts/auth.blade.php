<html lang="{{ env('APP_LOCALE') }}">
    @include('partials.auth.head')

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="{{ asset('public/img/raha-logo-white.jpg') }}" alt="Raha" />
                <div >
                    <h1 class="login-logo">Raha</h1>
                </div>
            </div>
            <!-- /.login-logo -->

            <div class="login-box-body">
                <p class="login-box-msg">@yield('message')</p>

                @include('flash::message')

                @yield('content')
            </div>
            <!-- /.login-box-body -->

            <div class="login-box-footer">
                {{ trans('footer.powered') }}: <a href="https://euresiacoders.com" target="_blank">{{ trans('footer.software') }}</a>
            </div>
            <!-- /.login-box-footer -->
        </div>
    </body>
</html>
