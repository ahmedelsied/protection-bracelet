<head>
    <title>{{ config('app.name') }} | @yield('title','Home')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @if(app()->getLocale() === 'en')
        <!--begin::Fonts-->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <!--end::Fonts-->
        <link rel="stylesheet"
              href="{{ asset('vendor/hsmfawaz/ui/metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
        <link href="{{ asset('vendor/hsmfawaz/ui/metronic/assets/plugins/global/plugins.bundle.css') }}"
              rel="stylesheet"
              type="text/css"/>
        <link href="{{ asset('vendor/hsmfawaz/ui/metronic/assets/css/style.bundle.css') }}"
              rel="stylesheet"
              type="text/css"/>
        <style>
            :root {
                --bs-font-sans-serif: Poppins, Helvetica, "sans-serif"
            }

            .v-application {
                font-family: var(--bs-font-sans-serif) !important;
            }
        </style>

    @else
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&amp;display=swap"
              rel="stylesheet">
        <link rel="stylesheet"
              href="{{ asset('vendor/hsmfawaz/ui/metronic/assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}">
        <link href="{{ asset('vendor/hsmfawaz/ui/metronic/assets/plugins/global/plugins.bundle.rtl.css') }}"
              rel="stylesheet"
              type="text/css"/>
        <link href="{{ asset('vendor/hsmfawaz/ui/metronic/assets/css/style.bundle.rtl.css') }}"
              rel="stylesheet"
              type="text/css"/>
        <style>
            :root {
                --bs-font-sans-serif: Tajawal, Helvetica, "sans-serif"
            }
        </style>
    @endif
    <link rel="stylesheet"
          href="{{  asset('vendor/hsmfawaz/ui/metronic/assets/css/custom_styles.css') }}">
    <!--end::Global Stylesheets Bundle-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    @stack('header')
    <!--end::Page Vendor Stylesheets-->
</head>