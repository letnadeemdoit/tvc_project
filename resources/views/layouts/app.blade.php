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

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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


        @stack('scripts')

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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            @if(Session::has('success'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{{ session('success') }}");
            @endif

                @if(Session::has('error'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.error("{{ session('error') }}");
            @endif

                @if(Session::has('info'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.info("{{ session('info') }}");
            @endif

                @if(Session::has('warning'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.warning("{{ session('warning') }}");
            @endif
        </script>

    </body>
</html>
