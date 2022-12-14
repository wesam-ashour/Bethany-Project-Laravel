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
                                        <!--begin::Input group-->
                                        <div class="row">
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-7">
                                                <!--begin::Label-->
                                                <label
                                                    class="required fw-bold fs-6 mb-2">{{ __('options.Foundation') }}
                                                    ({{ __('event.English') }})</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea id="foundation_en" type="text" name="foundation_en"
                                                          class="form-control form-control-solid mb-3 mb-lg-0"
                                                          placeholder="{{ __('options.FoundationPlace') }}"
                                                >{{$options->getTranslation('foundation', 'en')}}</textarea>
                                                <strong id="foundation_en_error" class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <!--begin::Label-->
                                                <label
                                                    class="required fw-bold fs-6 mb-2">{{ __('options.Foundation') }}
                                                    ({{ __('event.Arabic') }})</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea id="foundation_ar" type="text" name="foundation_ar"
                                                          class="form-control form-control-solid mb-3 mb-lg-0"
                                                          placeholder="{{ __('options.FoundationPlace') }}"
                                                >{{$options->getTranslation('foundation', 'ar')}}</textarea>
                                                <strong id="foundation_ar_error" class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-bold fs-6 mb-2">{{ __('options.History') }}
                                                    ({{ __('event.English') }})</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea id="history_en" type="text" name="history_en"
                                                          class="form-control form-control-solid mb-3 mb-lg-0"
                                                          placeholder="{{ __('options.HistoryPlace') }}"
                                                >{{$options->getTranslation('history', 'en')}}</textarea>
                                                <strong id="history_en_error" class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-md-6 mb-7">
                                                <!--begin::Label-->
                                                <label class="required fw-bold fs-6 mb-2">{{ __('options.History') }}
                                                    ({{ __('event.Arabic') }})</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea id="history_ar" type="text" name="history_ar"
                                                          class="form-control form-control-solid mb-3 mb-lg-0"
                                                          placeholder="{{ __('options.HistoryPlace') }}"
                                                >{{$options->getTranslation('history', 'ar')}}</textarea>
                                                <strong id="history_ar_error" class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input-->
                                            </div>
                                        </div>
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
                                                <div class="col-md-6 mb-7">
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <br>
                                                    <div>
                                                        <img style="max-width: 100%;"
                                                             src="{{ asset('images/main/' . $options->image) }}"/>
                                                    </div>

                                                    <!--end::Input-->
                                                </div>
                                            @endif
                                        </div>
                                        <!--end::Scroll-->
                                    </form>
                                </div>
                                <!--end::Card body-->
                                <!--end:::Tab content-->
                                <!--end::Content-->
                            </div>
                            <!--begin::Actions-->
                            @can('option-edit')
                                <div class="d-flex justify-content-end">
                                    <button id="kt_modal_update_user_submit" class="btn btn-primary">
                                        <span class="indicator-label">{{ __('options.Save') }}</span>
                                        <span class="indicator-progress">{{ __('options.Please') }}
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            @endcan
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

