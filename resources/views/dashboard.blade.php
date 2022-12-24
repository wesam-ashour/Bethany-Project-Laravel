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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('home.Dashboard') }}
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                        <!--begin::Description-->
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('home.Home') }}</small>
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

                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-4" onclick="start();">
                        <!--begin::Statistics Widget 5-->
                        <a class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<path
                                                            d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                                            fill="black"/>
														<path opacity="0.3"
                                                              d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                                              fill="black"/>
														<path opacity="0.3"
                                                              d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                                              fill="black"/>
													</svg>
												</span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ __('home.Events') }}</div>
                                <div class="fw-bold text-white">{{ __('home.EventsDes') }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-4" id="btn-chart2">
                        <!--begin::Statistics Widget 5-->
                        <a  class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<path opacity="0.3"
                                                              d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                              fill="black"/>
														<path
                                                            d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                            fill="black"/>
														<path
                                                            d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                            fill="black"/>
													</svg>
												</span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ __('home.Visits') }}</div>
                                <div class="fw-bold text-white">{{ __('home.VisitsDes') }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-4" id="btn-chart3">
                        <!--begin::Statistics Widget 5-->
                        <a class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/graphs/gra005.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<path opacity="0.3"
                                                              d="M14 12V21H10V12C10 11.4 10.4 11 11 11H13C13.6 11 14 11.4 14 12ZM7 2H5C4.4 2 4 2.4 4 3V21H8V3C8 2.4 7.6 2 7 2Z"
                                                              fill="black"/>
														<path
                                                            d="M21 20H20V16C20 15.4 19.6 15 19 15H17C16.4 15 16 15.4 16 16V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z"
                                                            fill="black"/>
													</svg>
												</span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ __('home.Scanned') }}</div>
                                <div class="fw-bold text-white">{{ __('home.ScannedDes') }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                </div>
                <!--end::Row-->

                <!--begin::Charts Widget 1-->
                <div class="">
                    <div class="row" id="chart1">
                        <div class="col-xl-12">
                            <!--begin::Charts Widget 1-->
                            <div class="card card-xl-stretch mb-xl-6">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">{{ __('home.Recent') }}</span>
                                        {{-- <span class="text-muted fw-semibold fs-7">More than 400 new members</span> --}}
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                     viewBox="0 0 24 24">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                       fill-rule="evenodd">
                                                        <rect x="5" y="5" width="5"
                                                              height="5" rx="1" fill="currentColor"/>
                                                        <rect x="14" y="5" width="5"
                                                              height="5" rx="1" fill="currentColor"
                                                              opacity="0.3"/>
                                                        <rect x="5" y="14" width="5"
                                                              height="5" rx="1" fill="currentColor"
                                                              opacity="0.3"/>
                                                        <rect x="14" y="14" width="5"
                                                              height="5" rx="1" fill="currentColor"
                                                              opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                             data-kt-menu="true" id="kt_menu_637e9afa6155d">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bold">{{ __('home.Filter') }}</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <div class="px-7 py-5">
                                                <!--begin::Input group-->
                                                <form action="{{ route('dashboard') }}">
                                                    <div class="mb-10">
                                                        <!--begin::Label-->
                                                        <label class="form-label fw-semibold">{{ __('home.Select') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div>
                                                            <select name="events[]" id="events"
                                                                    class="form-select form-select-solid" multiple
                                                                    data-kt-select2="true"
                                                                    data-placeholder="{{ __('home.SelectOption') }}"
                                                                    data-dropdown-parent="#kt_menu_637e9afa6155d"
                                                                    data-allow-clear="true" @if(\Illuminate\Support\Facades\App::getLocale() == "ar") dir="rtl" @endif>
                                                                {{-- <option></option> --}}
                                                                @forelse ($events as $event)
                                                                    <option value="{{ $event->id }}">
                                                                        {{ $event->title }}</option>
                                                                @empty
                                                                    <option></option>
                                                                @endforelse

                                                            </select>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-sm btn-primary get-events"
                                                                data-kt-menu-dismiss="true">{{ __('home.Apply') }}
                                                        </button>
                                                    </div>
                                                </form>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Menu 1-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->

                                <!--begin::Chart-->
                                <div class="card-body">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                                <!--end::Chart-->

                                <!--end::Body-->
                            </div>
                            <!--end::Charts Widget 1-->
                        </div>
                    </div>

                    <div class="row" id="chart2" style="display: none;">
                        <div class="col-xl-12">
                            <!--begin::Charts Widget 1-->
                            <div class="card card-xl-stretch mb-xl-6">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">{{ __('home.visits') }}</span>
                                        {{-- <span class="text-muted fw-semibold fs-7">More than 400 new members</span> --}}
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->

                                        <select  class="form-select form-control-solid start country" name="start">
                                            @foreach($dates as $date)
                                                <option value="{{$date}}">{{$date}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Svg Icon-->

                                        <!--begin::Menu 1-->
                                        <!--end::Menu 1-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <div class="card-body">
                                    <canvas id="myBarChart2"></canvas>
                                </div>
                            </div>
                            <!--end::Charts Widget 1-->
                        </div>
                    </div>

                    <div class="row" id="chart3" style="display: none;">
                        <div class="col-xl-12">
                            <!--begin::Charts Widget 1-->
                            <div class="card card-xl-stretch mb-xl-6">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1">{{ __('home.ScannedQR') }}</span>
                                        {{-- <span class="text-muted fw-semibold fs-7">More than 400 new members</span> --}}
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                     viewBox="0 0 24 24">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                       fill-rule="evenodd">
                                                        <rect x="5" y="5" width="5"
                                                              height="5" rx="1" fill="currentColor"/>
                                                        <rect x="14" y="5" width="5"
                                                              height="5" rx="1" fill="currentColor"
                                                              opacity="0.3"/>
                                                        <rect x="5" y="14" width="5"
                                                              height="5" rx="1" fill="currentColor"
                                                              opacity="0.3"/>
                                                        <rect x="14" y="14" width="5"
                                                              height="5" rx="1" fill="currentColor"
                                                              opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                             data-kt-menu="true" id="kt_menu_637e9afa6155ds">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bold">{{ __('home.Filter') }}</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <div class="px-7 py-5">
                                                <!--begin::Input group-->
                                                <form  id="kt_modal_add_user_form">
                                                    <div class="mb-10">
                                                        <!--begin::Label-->
                                                        <label class="form-label fw-semibold">{{ __('home.Select') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div>
                                                            <select name="scanQr[]" id="scanQr"
                                                                    class="form-select form-select-solid" multiple
                                                                    data-kt-select2="true"
                                                                    data-placeholder="{{ __('home.SelectOption') }}"
                                                                    data-dropdown-parent="#kt_menu_637e9afa6155ds"
                                                                    data-allow-clear="true" @if(\Illuminate\Support\Facades\App::getLocale() == "ar") dir="rtl" @endif>
                                                                {{-- <option></option> --}}
                                                                @forelse ($places as $place)
                                                                    <option value="{{ $place->id }}">
                                                                        {{ $place->title }}</option>
                                                                @empty
                                                                    <option></option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->


                                                    <div class="d-flex justify-content-end">
                                                        {{--                                                        <button type="reset"--}}
                                                        {{--                                                                class="btn btn-sm btn-light btn-active-light-primary me-2"--}}
                                                        {{--                                                                data-kt-menu-dismiss="true">Reset--}}
                                                        {{--                                                        </button>--}}
                                                        <button type="button" class="btn btn-sm btn-primary get-data"
                                                                >{{ __('home.Apply') }}
                                                        </button>
                                                    </div>
                                                </form>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Form-->
                                        </div>

                                        <!--end::Menu 1-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->

                                <!--begin::Chart-->
                                <div class="card-body">
                                    <canvas id="myBarChart3"></canvas>
                                </div>
                                <!--end::Chart-->

                                <!--end::Body-->
                            </div>
                            <!--end::Charts Widget 1-->
                        </div>
                    </div>
                <!--end::Charts Widget 1-->
                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.1/Chart.min.js" crossorigin="anonymous"></script>


    <script type="text/javascript">
        var _ydata1 = [];
        var _xdata1 = [];

        var _ydata2 = [];
        var _xdata2 = [];

        var _ydata3 = [];
        var _xdata3 = [];
    </script>
    <script src="{{ asset('/assets/demo/chart-bar-demo.js') }}"></script>
    <script>window.onload = $("#btn-chart1");</script>
    <script>
        $(document).ready(function () {
            $(".btn").click(function () {
                $("#ajaxModel").modal('hide');
            });
        });
    </script>
    <script>
        window.onload = function() {
            start();
        };
        function start(){
            let chartStatus = Chart.getChart("myBarChart"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }
            _ydata1 = [];
            _xdata1 = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            var type = "GET";
            var ctx = document.getElementById("myBarChart");
            var myLineChart1 = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: _ydata1,
                    datasets: [{
                        label: "{{ __('home.get_events') }}",
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        data: _xdata1,
                        borderWidth: 1
                    }],
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    },
                    legend: {
                        display: true
                    }
                }
            });
            $.ajax({
                type: type,
                url: '{{ route('get_events') }}',
                data: {event : 1},
                dataType: 'json',

                success: function (data) {
                    jQuery.each(data.months, function (index, item) {
                        _ydata1.push(item);
                    });

                    jQuery.each(data.monthCount, function (index, item) {
                        _xdata1.push(item);
                    });
                    myLineChart1.update();
                    $("#chart1").show();
                    $("#chart2").hide();
                    $("#chart3").hide();




                },
                error: function (data) {
                },
            });
        }

        jQuery(document).ready(function ($) {
            $(".get-events").click(function(e){
                let chartStatus = Chart.getChart("myBarChart"); // <canvas> id
                if (chartStatus !== undefined) {
                    chartStatus.destroy();
                }
                _ydata1 = [];
                _xdata1 = [];
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var type = "GET";
                var ctx = document.getElementById("myBarChart");
                var myLineChart6 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: _ydata1,
                        datasets: [{
                            label: "{{ __('home.get_events') }}",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            data: _xdata1,
                            borderWidth: 1
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                });

                $.ajax({
                    type: type,
                    url: '{{ route('get_events') }}',
                    data: {events :$('#events').val()},
                    dataType: 'json',

                    success: function (data) {
                        jQuery.each(data.months2, function (index, item) {
                            _ydata1.push(item);
                        });

                        jQuery.each(data.monthCount2, function (index, item) {
                            _xdata1.push(item);
                        });
                        myLineChart6.update();


                    },
                    error: function (data) {
                    },
                });
            });


            $("#btn-chart2").click(function (e) {
                let chartStatus = Chart.getChart("myBarChart2"); // <canvas> id
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
                _ydata2 = [];
                _xdata2 = [];
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var formData = {
                    start: $('.start').val(),
                    end: $('.end').val(),
                };
                var type = "GET";
                var ctx = document.getElementById("myBarChart2");
                var myLineChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: _ydata2,
                        datasets: [{
                            label: "{{ __('home.systemـvisits') }}",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            data: _xdata2,
                            borderWidth: 1
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                });
                $.ajax({
                    type: type,
                    url: '{{ route('dashboard') }}',
                    data: formData,
                    dataType: 'json',

                    success: function (data) {

                        jQuery.each(data.months2, function (index, item) {
                            _ydata2.push(item);
                        });

                        jQuery.each(data.monthCount2, function (index, item) {
                            _xdata2.push(item);
                        });
                        myLineChart.update();
                        $("#chart1").hide();
                        $("#chart3").hide();
                        $("#chart2").show();



                    },
                    error: function (data) {
                    },
                });
            });

            $(".get-data").click(function(e){
                let chartStatus = Chart.getChart("myBarChart3"); // <canvas> id
                if (chartStatus !== undefined) {
                    chartStatus.destroy();
                }
                _ydata3 = [];
                _xdata3 = [];
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var type = "GET";
                var ctx = document.getElementById("myBarChart3");
                var myLineChart5 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: _ydata3,
                        datasets: [{
                            label: "{{ __('home.places_scaneed') }}",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            data: _xdata3,
                            borderWidth: 1
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                });

                $.ajax({
                    type: type,
                    url: '{{ route('get_places') }}',
                    data: {scanQr :$('#scanQr').val()},
                    dataType: 'json',

                    success: function (data) {
                        jQuery.each(data.months, function (index, item) {
                            _ydata3.push(item);
                        });

                        jQuery.each(data.monthCount, function (index, item) {
                            _xdata3.push(item);
                        });
                        myLineChart5.update();


                    },
                    error: function (data) {
                    },
                });
            });

            $("#btn-chart3").click(function (e) {
                let chartStatus = Chart.getChart("myBarChart3"); // <canvas> id
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
                _ydata3 = [];
                _xdata3 = [];
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var type = "GET";
                var ctx = document.getElementById("myBarChart3");
                var myLineChart3 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: _ydata3,
                        datasets: [{
                            label: "{{ __('home.places_scaneed') }}",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            data: _xdata3,
                            borderWidth: 1
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                });
                $.ajax({
                    type: type,
                    url: '{{ route('get_scanned') }}',
                    data: {scan:1},
                    dataType: 'json',

                    success: function (data) {

                        jQuery.each(data.months3, function (index, item) {
                            _ydata3.push(item);
                        });

                        jQuery.each(data.monthCount3, function (index, item) {
                            _xdata3.push(item);
                        });
                        myLineChart3.update();
                        $("#chart1").hide();
                        $("#chart3").show();
                        $("#chart2").hide();



                    },
                    error: function (data) {
                    },
                });
            });

            $("select.country").change(function(e){
                let chartStatus = Chart.getChart("myBarChart2"); // <canvas> id
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
                _ydata2 = [];
                _xdata2 = [];
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var selectedCountry = $(this).children("option:selected").val();
                var formData = {
                    start: selectedCountry,
                };
                var type = "GET";
                var ctx = document.getElementById("myBarChart2");
                var myLineChart2 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: _ydata2,
                        datasets: [{
                            label: "{{ __('home.systemـvisits') }}",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            data: _xdata2,
                            borderWidth: 1
                        }],
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                });

                $.ajax({
                    type: type,
                    url: '{{ route('dashboard') }}',
                    data: formData,
                    dataType: 'json',

                    success: function (data) {

                        jQuery.each(data.months2, function (index, item) {
                            _ydata2.push(item);
                        });

                        jQuery.each(data.monthCount2, function (index, item) {
                            _xdata2.push(item);
                        });
                        myLineChart2.update();

                    },
                    error: function (data) {
                    },
                });
            });



        });
    </script>

@endsection
