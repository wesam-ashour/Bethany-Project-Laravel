@extends('layouts.master')
@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('event.Dashboard') }}
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                        <!--begin::Description-->
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('event.Events') }} - {{$event->title}}</small>
                        <!--end::Description--></h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div id="kt_ecommerce_edit_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="">
                    <!--begin::Main column-->
                    <form id="my_form"
                        class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        @csrf
                        <!--begin::General options One-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                                <!--begin::Card header-->
                                <div class="card-header cursor-pointer">
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">{{ __('event.EventsDetails') }}</h3>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Action-->
                                    <!--end::Action-->
                                </div>
                                <!--begin::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body p-9">
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Image') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->

                                            <img style="max-width: 1025px; height:300px;" src="{{ asset('public/images/events/' . $event->image) }}" />

                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Row-->
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Title') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{$event->title}}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Input group-->
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Description') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <span class="fw-semibold text-gray-800 fs-6">{{$event->description}}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Date') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <span class="fw-semibold text-gray-800 fs-6">{{$event->date}}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Time') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <span class="fw-semibold text-gray-800 fs-6">{{$event->time}}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Address') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <span class="fw-semibold text-gray-800 fs-6">{{$event->address}}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Status') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            @if($event->status == 1)
                                                <div class="badge badge-light-success">{{ __('event.Active') }}</div>
                                            @else
                                                <div class="badge badge-light-danger">{{ __('event.Inactive') }}</div>
                                            @endif
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Added') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <span class="fw-semibold text-gray-800 fs-6">{{App\Models\Admin::find($event->added_by)->name}}</span>
                                        </div>
                                        <!--end::Col-->

                                    </div>
                                    @if($event->updated_by != null)
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.updated') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <span class="fw-semibold text-gray-800 fs-6">{{App\Models\Admin::find($event->updated_by)->name}}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    @endif
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row col-md-6 mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">{{ __('event.Location') }}</label>

                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        </div>
                                        <!--end::Col-->
                                        <div id="map"  style="max-width: 1025px; height:400px;">

                                    </div>
                                </div>

                                <!--end::Card body-->
                            </div>

                        </div>
                        <!--end::General options-->
                        <!--begin::General options Two-->

                    </form>
                    <!--end::Main column-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"
     integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSNQLhR2yEuFkYAoU_q4sXlvsd_8lOMBA&callback=initMap"
    async></script>
<script>
    let map, activeInfoWindow, markers = [];
    /* ----------------------------- Initialize Map ----------------------------- */
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: {{ (float) $event->lat }},
                lng: {{ (float) $event->long }},
            },
            zoom: 13
        });
        map.addListener("click", function(event) {
            mapClicked(event);
        });
        initMarkers();
    }
    /* --------------------------- Initialize Markers --------------------------- */
    function initMarkers() {
        const initialMarkers = {{ Illuminate\Support\Js::from($initialMarkers) }};
        for (let index = 0; index < initialMarkers.length; index++) {
            const markerData = initialMarkers[index];
            const marker = new google.maps.Marker({
                position: markerData.position,
                label: markerData.label,
                map
            });
            markers.push(marker);
            const infowindow = new google.maps.InfoWindow({
                content: `<b>${markerData.position.lat}, ${markerData.position.lng}</b>`,
            });

        }


    }
</script>
@endsection
