<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
<link rel="shortcut icon" href="{{asset('assets/media/logos/logomain.jpeg')}}" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->

@if(App::getLocale() == 'en')
<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

@else
    <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />

@endif
<style>
    .dropdown-menu {
        overflow: hidden;
        overflow-y: auto;
        max-height: 120px;
    }
</style>
