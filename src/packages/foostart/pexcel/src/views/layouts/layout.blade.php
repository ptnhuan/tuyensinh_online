{{-- Layout base admin panel --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/bootstrap.min.css') !!}
    {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') !!}

    @yield('head_css')
    @yield('sub_page_css')

    {{-- End head css --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <body>

        {{-- content --}}
        <div>
            @yield('content')
        </div>

        {{-- Start footer scripts --}}
        @yield('before_footer_scripts')

        {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
        {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/bootstrap.min.js') !!}

        @yield('footer_scripts')
        @yield('sub_page_scripts')
    </body>
</html>