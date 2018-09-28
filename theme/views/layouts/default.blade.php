<!DOCTYPE html>
<html {!! get_language_attributes() !!}>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <link rel="shortcut icon" href="{{ IMG_URI }}favicon.ico">
        <link rel="apple-touch-icon-precomposed" href="{{ IMG_URI }}apple-touch-icon.png">
        {{ wp_head() }}
    </head>
    <body {{ body_class() }}>
        @include('partials.header')

        @yield('content')

        @include('partials.footer')

        {{ wp_footer() }}
    </body>
</html>
