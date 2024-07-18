<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TXFZXTWXFP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-TXFZXTWXFP');
    </script>
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/23120175.js"></script>
    <!-- End of HubSpot Embed Code -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.jpg')}}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}"/>

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .daterangepicker {
            z-index: 99999 !important;
        }
    </style>

@livewireStyles
@stack('stylesheets')
<!-- Scripts -->

    <style>
        /*i:hover {*/
        /*    color: #fff !important;*/
        /*}*/

        /*a:hover {*/
        /*    color: #000000;*/
        /*}*/

        i:hover {
            color: unset !important;
        }

        .pagination-disable-button button.page-link {
            background-color: transparent !important;
        }

        .pagination-disable-button button.page-link {
            padding: 6px 2px !important;
        }

        .pagination-disable-button li.page-item.disabled {
            display: none;
        }

        .mt-62 {
            margin-top: 62px;
        }

        .h-40 {
            height: 40px !important;
        }

        @media (max-width: 992px) {
            .mt-50 {
                margin-top: 50px;
            }

            .h-40 {
                height: 50px !important;
            }

            .mt-62 {
                margin-top: 55px;
            }

            .shadow-sm-screen {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.10), 0 1px 2px rgba(0, 0, 0, 0.20);
            }
        }


        @media (min-width: 992px) {


            .dashboard-guest-menu li a {
                color: #606368 !important;
                font-size: 13px;
            }

        }


    </style>

</head>

<body class="has-navbar-vertical-aside {{auth()->user()->is_admin ? 'navbar-vertical-aside-show-xl' : ''}}   footer-offset">

@include('layouts.partials.navigation-menu-top-app')
@if(auth()->user()->is_admin)
    @include('layouts.partials.navigation-menu-side-app')

@endif
<main id="content" role="main" class="{{auth()->user()->is_admin ? 'main' : ''}}" style="padding-top: 120px">

    {{ $slot }}

    @include('layouts.partials.footer-app')
</main>
<livewire:modals.destroyable-confirmation-modal/>
@stack('modals')

@livewireScripts
<script src="{{ mix('js/app.js') }}"></script>

@stack('scripts')


<script>

//    if (window.matchMedia('(max-width: 576px)').matches) {
//
//        if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0)
//        {
//            $(document).ready(function (e) {
//                $(document).on('mousedown click ', '.month', function () {
//                    alert('Choose your DateTime')
//                });
//
//                $(document).on('mousedown click', '.calendar-time', function (e) {
//                    alert('Choose your DateTime')
//                });
//            });
//        }
//    } else {
//        //...
//    }


</script>

<script>
    $(document).ready(function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
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
<script>
    $(document).ready(function () {
        window.livewire.on('openModal', (reload = false) => {
            $('.createOrUpdateModal').each(function () {
                $(this).modal('show');
            });
        });
    });
</script>
<script>
    // $(document).ready(function () {
    //     window.livewire.on('openModal', (reload = false) => {
    //         $('.createOrUpdateModal').each(function () {
    //             $(this).modal('show');
    //         });
    //     });
    // });
</script>

<script>
    $(document).ready(function () {
        window.livewire.on('openModal', (reload = false) => {
            $('.createOrUpdateModal').each(function () {
                $(this).modal('show');
            });
        });
        document.addEventListener('focusin', (e) => {
            if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
                e.stopImmediatePropagation();
            }
        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>

</body>
</html>
