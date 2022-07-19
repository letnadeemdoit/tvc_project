<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/theme.css') }}" />

        @livewireStyles

        <!-- Scripts -->

    </head>
    <body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl   footer-offset">

        @include('layouts.partials.navigation-menu-top-app')

        @include('layouts.partials.navigation-menu-side-app')

            <main id="content" role="main" class="main">
                {{ $slot }}

                @include('layouts.partials.footer-app')

            </main>



        @stack('modals')

        @livewireScripts


        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            $(document).ready(function () {
                window.livewire.on('hideModal', (reload = false) => {
                    $('.hideableModal').each(function () {
                        $(this).modal('hide');
                    });
                    if (reload) {
                        window.location.reload();
                    } else {
                        $('.modal-backdrop').remove();
                        $('body').css('overflow', '');
                        $('body').css('padding-right', '');
                        $('body').removeClass('modal-open');
                    }
                });
            });
        </script>

    </body>
</html>
