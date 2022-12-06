@extends('layouts.master')
@section('content')
    @include('sweetalert::alert')
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
                        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard
                            <!--begin::Separator-->
                            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                            <!--end::Separator-->
                            <!--begin::Description-->
                            <small class="text-muted fs-7 fw-bold my-1 ms-1">Events - register users - {{ $event->title }}</small>
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
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
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
                            <button class="btn btn-success" id="btn-add">
                                Send Meesage
                            </button>
                            <form  action="{{route('events.index')}}">
                                @csrf
                                <input type="hidden" name="download" value="{{ $event->id }}">

                                <button type="submit" type="submit" id="btn-pdf" class="btn btn-light-danger font-weight-bolder "
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <a  class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-pdf-o"></i>
                                    </span>
                                    <span class="navi-text">Export PDF</span>
                                </a>
                            </button>
                            </form>

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
                                    <th class="text">Full name</th>
                                    <th class="text">Email</th>
                                    <th class="text">Username</th>
                                    <th class="text">Added at</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Send Message to register users</h5>
                </div>
                <div class="modal-body">
                    <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                        <div class="form-group">
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">Message *</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <textarea class="form-control" id="message" name="message" required placeholder="Enter a Message" rows="3"></textarea>
                                    <span id='Logo' class="text-danger" style="display:none">Please write
                                        message!</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-modal" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary font-weight-bold" id="btn-save">Send</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sending Message</h5>
                </div>
                <div class="modal-body">
                    <div data-scroll="true" data-height="300">
                        <div class="d-flex justify-content-center">
                            <h4 style="padding-right: 7px;">Please Wait</h4>
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                                    title: 'Oops...',
                                    text: 'No Users found register!',
                                })
                                jQuery('#loadMe').modal('hide');
                            }, 1000);
                        } else {
                            jQuery('#loadMe').modal('hide');
                            jQuery('#myForm').trigger("reset");
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Message sent done to all users register!',
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

