<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Home - NSN Hotels</title>
    <meta charset="UTF-8">
    <meta name="description" content="List of all the hotels of your favourite places in India.">
    {!! SEO::generate() !!}
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <meta name="robots" content="index, no-follow" />
    <link rel="icon" sizes="16x16"
        href="{{ getImageUrl(setting('logo') ? setting('logo') : 'assets/images/assets/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="title" content="Best hotel with a challenging price | NSN Hotels" />
    <meta name="description"
        content="Choose from a wide range of properties which nsnhotels.com offers. Search now! Book your Hotel online. Great rates. Secure Booking. 24/7 Customer Service. Villas. Motels. Best Price Guarantee. Save 10% with Genius. No Booking Fees." />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" />
    <link href="{{ filepath('frontend/css/index/style.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ filepath('frontend/css/index/nsnhotels.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ filepath('frontend/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ filepath('frontend/build/css/intlTelInput.min.css') }}">

    <style>
        .bg_animities {
            background: rgb(158, 156, 156);
        }

        .faq h2 {
            font-weight: 700 !important;
            font-size: 26px !important;
            color: #000 !important;
        }

        .accordion-title a {
            font-weight: 700;
            font-size: 19px;
            color: var(--color-primary)
        }

        .footerarea p {
            color: #fff !important;
        }

        #bannerslider {
            position: relative;
        }

        #bannerslider .owl-nav {
            position: absolute;
            top: 60% !important;
        }

        .nsnbannerbackground-2 {
            max-height: 80vh !important;
        }

        .custom-bg-gradient {
            background: rgb(255, 255, 255);
            background: linear-gradient(0deg, var(--color-gray) 50%, var(--color-primary) 50%);
        }

        .text-capitilize {
            text-transform: capitalize;
        }
    </style>
    <!-- PushAlert -->
    <script type="text/javascript">
        (function(d, t) {
            var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
            g.src = "https://cdn.pushalert.co/integrate_2ded1608e745bea58dd2c4a78b541677.js";
            s.parentNode.insertBefore(g, s);
        }(document, "script"));
    </script>
    <!-- End PushAlert -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-315826411');
    </script>



    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-315826411');
    </script>
    <script>
        var gmz_params = {
            i18n: {
                guest: 'Guest',
                guests: 'Guests',
                infant: 'Infant',
                infants: 'Infants',
                adult: 'Adult',
                adults: 'Adults',
                children: 'Children',
                featured: 'Featured',
            }
        }
    </script>
    @stack('style')
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PP8CCDF');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
    !-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PP8CCDF" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '323172226696460');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=323172226696460&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=1188266251653315&ev=PageView
&noscript=1"
            alt="facebook" />
    </noscript>
    <!-- End Facebook Pixel Code -->

    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=266463828767771&ev=PageView
&noscript=1"
            alt="facebook" />
    </noscript>
    <header>
        @include('frontend.layouts.topheader')
        @if (Request::segment(1) == null)
            @include('frontend.layouts.citylist')
        @endif
    </header>

    @yield('main')

    {{-- faq --}}
    <div class="mt-5">
        @if (request()->segment(1) != 'banquet')
            @include('frontend.home.partials.faq')
        @endif

    </div>
    @include('frontend.layouts.mobile_menu')


    @include('frontend.layouts.footer')

    @include('frontend.layouts.script')
    @include('frontend.layouts.js')

    @stack('scripts')

    <script>
        @if (Session::has('messege')) //toatser
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif

        $('.offer-wrapper a').click(function(e) {
            e.preventDefault()
            let url = $(this).attr('href');
            $.ajax({
                url: '{{ url('apply-offer') }}',
                data: {
                    url: url
                },
                success: function() {
                    toastr.success('Offer Applied.Now book any hotel to get offer.')
                    setTimeout(() => {
                        location.href = url

                    }, 2000);
                }

            })
        })
    </script>
</body>

</html>
