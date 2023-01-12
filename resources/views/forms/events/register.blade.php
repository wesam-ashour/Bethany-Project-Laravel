@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <input type="hidden" name="editId" value="{{ $event->id }}">
            <!--begin::Container-->
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
                            <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('event.Events') }} - {{ __('event.register') }} - {{ $event->title }}</small>
                            <!--end::Description--></h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->

                </div>
                <!--end::Container-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Forms-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <input id="search" type="text" data-kt-ecommerce-forms-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('event.Search') }}" />
                            <!--end::Search-->
                        </div>
                        <div id="filter_perant" class="card-toolbar flex-row-fluid justify-content-end gap-5"
                            data-kt-forms-table-toolbar="base">
                            <!--begin::Filter-->
                            <!--begin::Add forms-->
                            <!--begin::Card toolbar-->
                            {{-- <a id="reset" class="btn btn-light-danger">
                                {{__("str.Reset")}}
                                <i class="las la-angle-double-right text-light"></i>
                            </a> --}}
                            <!--end::Card toolbar-->
                                <input type="hidden" name="download" id="download" value="{{ $event->id }}">

{{--                                <button type="submit" type="submit" id="btn-pdf" class="btn btn-light-danger font-weight-bolder download-pdf "--}}
{{--                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}

{{--                                <a  class="navi-link">--}}
{{--                                    <span class="navi-icon">--}}
{{--                                        <i class="la la-file-pdf-o"></i>--}}
{{--                                    </span>--}}
{{--                                    <span class="navi-text">{{ __('event.Export') }}</span>--}}
{{--                                </a>--}}
{{--                            </button>--}}


                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                    <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                                </svg>
                                {{ __('event.Export') }}
                            </button>
                            <button class="btn btn-success" id="btn-add">
                                {{ __('event.Send') }}
                            </button>
                            <!--begin::Menu-->
                            <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a class="menu-link px-3 download-excel" data-kt-export="excel">
                                        {{ __('event.Excel') }}
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a id="btn-pdf"  class="menu-link px-3 download-pdf" data-kt-export="pdf">
                                        {{ __('event.PDF') }}
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>

                            <!--end::Add forms-->
                        </div>

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_forms_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="text">{{ __('event.Full') }}</th>
                                    <th class="text">{{ __('event.Email') }}</th>
                                    <th class="text">{{ __('admin.Mobile') }}</th>
                                    <th class="text">{{ __('user.email_verified') }}</th>
                                    <th class="text">{{ __('event.Added') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600"></tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Forms-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

    <div class="modal fade" id="ajaxModel" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('event.SendMessage') }}</h5>
                </div>
                <div class="modal-body">
                    <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                        <div class="form-group">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('event.Message') }}</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <textarea class="form-control" id="message" name="message" required placeholder="{{ __('event.EnterMessage') }}" rows="3"></textarea>
                                    <span id='Logo' class="text-danger" style="display:none">{{ __('event.Pleasewrite') }}</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-modal" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">{{ __('event.Close') }}</button>
                    <button type="button" class="btn btn-primary font-weight-bold" id="btn-save">{{ __('event.SendM') }}</button>
                    <input type="hidden" id="todo_id" name="todo_id" value="{{ $event->id }}">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('event.Sending') }}</h5>
                </div>
                <div class="modal-body">
                    <div data-scroll="true" data-height="300">
                        <div class="d-flex justify-content-center">
                            <h4 style="padding-right: 7px;">{{ __('event.Please') }}</h4>
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">{{ __('event.Loading') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>const language = $('#language').val();</script>
    <script>const id = $('#download').val();</script>

    <script type="text/javascript">
        $(".download-pdf").click(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: '{{ route('pdf') }}',
                data: {id: id},
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Users.pdf";
                    link.click();
                },
                error: function(blob){
                    console.log(blob);
                }
            });
        });

    </script>

    <script type="text/javascript">
        $(".download-excel").click(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: '{{ route('excel') }}',
                data: {id: id},
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Users.xlsx";
                    link.click();
                },
                error: function(blob){
                    console.log(blob);
                }
            });
        });

    </script>


    <!--end::Content-->
    <script>
        $(document).ready(function() {
            $(".btn").click(function() {
                $("#ajaxModel").modal('hide');
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            //----- Open model CREATE -----//
            jQuery('#btn-add').click(function() {
                jQuery('#btn-save').val("add");
                jQuery('#myForm').trigger("reset");
                jQuery('#ajaxModel').modal('show');
            });
            // CREATE
            $("#btn-save").click(function(e) {
                jQuery('#ajaxModel').modal('hide')
                jQuery('#loadMe').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                var formData = {
                    id: jQuery('#todo_id').val(),
                    message: jQuery('#message').val(),
                };
                var state = jQuery('#btn-save').val();
                var type = "POST";
                var todo_id = jQuery('#todo_id').val();
                var mySpan = document.getElementById('Logo');
                $.ajax({
                    type: type,
                    url: '{{ route('sendMessage') }}',
                    data: formData,
                    dataType: 'json',

                    success: function(data) {
                        if (data.status == 0) {
                            setTimeout(function() {
                                jQuery('#loadMe').modal('hide');
                                mySpan.style.display = "";
                                jQuery('#ajaxModel').modal('show');
                            }, 1000);
                        } else if (data.status == 2) {

                            setTimeout(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: '{{ __('event.OopsU') }}',
                                    text: '{{ __('event.Oops') }}',
                                })
                                jQuery('#loadMe').modal('hide');
                            }, 1000);
                        } else {
                            jQuery('#loadMe').modal('hide');
                            jQuery('#myForm').trigger("reset");
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: '{{ __('event.MessageSentDone') }}',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    },
                    error: function(data) {},
                });

            });
        });
    </script>

    <script src="{{ asset('assets/forms/events/register.js') }}" defer></script>

@endsection

