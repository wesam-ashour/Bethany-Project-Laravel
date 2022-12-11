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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('options.Dashboard') }}
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                        <!--begin::Description-->
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('options.Settings') }}</small>
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
                <!--begin::Layout-->
                <!--begin::Sidebar-->

                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid">
                    <!--begin:::Tab content-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{ __('options.Settings') }}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div id="kt_modal_edit_user" class="card-body pt-0 pb-5">
                            <div id="kt_modal_edit_user_form" data-kt-redirect="">
                                <!--begin::Scroll-->
                                <div id="kt_modal_edit_user_scroll">
                                    <form id="kt_modal_edit_user_only">
                                        <div class="row">
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-7">
                                                <!--begin::Label-->
                                                <label
                                                    class="required fw-bold fs-6 mb-2">{{ __('options.Image') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="file" class="form-control form-control-solid"
                                                       id="fileupload" name="fileupload">

                                                <!--end::Input-->
                                            </div>
                                            @if($options->image != null)
                                            <div class="col-md-4 mb-7">
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <br>
                                                <div>
                                                    <img style="max-width: 100%;"  src="{{ asset('images/main/' . $options->image) }}"/>
                                                </div>

                                                <!--end::Input-->
                                            </div>
                                                @endif
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row">
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-12 mb-7">
                                                <!--begin::Label-->
                                                <label
                                                    class="required fw-bold fs-6 mb-2">{{ __('options.Foundation') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea id="foundation" type="text" name="foundation"
                                                          class="form-control form-control-solid mb-3 mb-lg-0"
                                                          placeholder="Write Foundation"
                                                >{{$options->foundation}}</textarea>
                                                <strong id="foundation_error" class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-bold fs-6 mb-2">{{ __('options.History') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea id="history" type="text" name="history"
                                                          class="form-control form-control-solid mb-3 mb-lg-0"
                                                          placeholder="Write History"
                                                >{{$options->history}}</textarea>
                                                <strong id="history_error" class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--end::Scroll-->
                                    </form>
                                </div>
                                <!--end::Card body-->
                                <!--end:::Tab content-->
                                <!--end::Content-->
                            </div>
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button id="kt_modal_update_user_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ __('options.Save') }}</span>
                                    <span class="indicator-progress">{{ __('options.Please') }}
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                            <!--end::Layout-->
                            <!--begin::Modals-->
                            <!--begin::Modal - Update user details-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script>const language = $('#language').val();</script>
                <script src="{{ asset('assets/forms/settings/edit_settings.js') }}" defer></script>

@endsection

