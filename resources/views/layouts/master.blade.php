<!DOCTYPE html>
<html @if(App::getLocale() == 'en') lang="en" style="direction: ltr;" @else lang="ar" style="direction: rtl;" @endif>
<head>
    <head>
        <base href="">
        <title>Dashboard</title>
        <meta charset="utf-8"/>
        <meta name="description"
              content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free."/>
        <meta name="keywords"
              content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title"
              content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme"/>
        <meta property="og:url" content="https://keenthemes.com/metronic"/>
        <meta property="og:site_name" content="Keenthemes | Metronic"/>
        <link href='https://fonts.googleapis.com/css?family=Noto Naskh Arabic' rel='stylesheet'>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('layouts.css')
        <style>
            body {
                font-family: 'Noto Naskh Arabic'
            }
        </style>

    </head>
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<input type="hidden" id="language" value="{{App::getLocale()}}">

<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
             data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
             data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
             data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            <input type="hidden" id="language" value="{{App::getLocale()}}">
            <!--begin::Brand-->
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <!--begin::Logo-->
                <a href="{{route('dashboard')}}" style="color: white;font-size: 20px;">
                    {{ __('home.Panel') }}
                </a>
                <!--end::Logo-->
            </div>
            <!--end::Brand-->


            <!--begin::Aside menu-->
            @include('layouts.slider')
            <!--end::Aside menu-->

            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <!--begin::header-->
                @include('layouts.header')
                <!--end::header-->

                @yield('content')

                <!--begin::footer-->
                @include('layouts.footer')
                <!--end::footer-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
    </div>
</div>

@include('layouts.js')

</body>
</html>
