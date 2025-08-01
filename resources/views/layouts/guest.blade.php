<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-MBKBRHP');
        </script>
        <!-- End Google Tag Manager -->


        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-TXFZXTWXFP"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-TXFZXTWXFP');
        </script>



        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/23120175.js"></script>
        <!-- End of HubSpot Embed Code -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>The Vacation Calendar</title>

        <link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.jpg')}}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/theme.css') }}">

        <link rel="stylesheet" type="text/css"
              href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @livewireStyles
        @stack('stylesheets')

        <style>

            .navbar-toggler {
                color: #e8604c !important;
                font-size: 30px!important;
            }

            @media (max-width: 992px) {
                .text-w-50 {
                    width: 100% !important;
                }
            }

            @media (max-width: 992px) {
                .guset-menu{
                    background-color: #e8604c05 !important;
                }
            }


        </style>

{{--        @dd(current_house())--}}
        @auth
            @if(isset(current_house()->image) && !is_null(current_house()->image) && current_house()->is_default_image === 1)
                <style>
                    .bulletin-image {
                        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url({{'/storage/'.current_house()->image}});
                        background-position: 50%;
                        background-repeat: no-repeat;
                        background-size: cover;
                        height: 180px;
                        background-color: #000000;
                    }

                </style>
            @else
                <style>
                    .bulletin-image {
                        background-image: url(/images/bulletin-images/bulletin.png);
                        background-position: center bottom;
                        background-repeat: no-repeat;
                        background-size: cover;
                        height: 180px;
                    }
                </style>
            @endif
        @else
            <style>
                .bulletin-image {
                    background-image: url(/images/bulletin-images/bulletin.png);
                    background-position: center bottom;
                    background-repeat: no-repeat;
                    background-size: cover;
                    height: 180px;
                }
            </style>
        @endauth

    </head>
    <body>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MBKBRHP"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '686103932963017');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=686103932963017&ev=PageView&noscript=1"
        />
    </noscript>
    <!-- End Meta Pixel Code -->
{{--    <div id="fb-root"></div>--}}
        <main class="bg-lightGrey" style="min-height: 100vh">
            @include('layouts.partials.navigation-menu-top-guest')
            {{ $slot }}
        </main>
        @include('layouts.partials.footer-guest')
    <livewire:modals.destroyable-confirmation-modal/>
    @stack('modals')


    <!-- Start LinkedIn Code -->
    <script type="text/javascript">
        _linkedin_partner_id = "5873786";
        window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
        window._linkedin_data_partner_ids.push(_linkedin_partner_id);
    </script>
    <script type="text/javascript">
        (function(l) {
            if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
                window.lintrk.q=[]}
            var s = document.getElementsByTagName("script")[0];
            var b = document.createElement("script");
            b.type = "text/javascript";b.async = true;
            b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
            s.parentNode.insertBefore(b, s);})(window.lintrk);
    </script>
    <noscript>
        <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=5873786&fmt=gif" />
    </noscript>
    <!-- End LinkedIn Code -->
    </body>
    @livewireScripts
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

    @stack('scripts')

    <script>
        document.addEventListener('refresh-photos-list-in-album', function () {
            window.location.reload();
            // setTimeout(function(){
            //     window.location.reload();
            // }, 3000);
        })
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


</html>
