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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('admin.Dashboard') }}
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                        <!--begin::Description-->
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('admin.Admins') }}
                            - {{$user->name}}</small>
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
                <div class="flex-lg-row-fluid">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Sidebar-->

                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <!--begin:::Tab content-->
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{ __('admin.Profile') }}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>


                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div id="kt_modal_edit_user" class="card-body pt-0 pb-5">
                                <div id="kt_modal_edit_user_form" data-kt-redirect="">

                                    <!--begin::Scroll-->
                                    <div id="kt_modal_edit_user_scroll">
                                        <form id="kt_modal_edit_user_only" enctype="multipart/form-data">

                                            <!--begin::Input group-->
                                            <div class="row">
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="required fw-bold fs-6 mb-2">{{ __('admin.Name') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="name" type="text" name="name"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.placeholderName') }}"
                                                           value="{{$user->name}}"/>
                                                    <strong id="name_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="required fw-bold fs-6 mb-2">{{ __('admin.Email') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="email" type="email" name="email"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.contentEmail') }}"
                                                           value="{{$user->email}}"/>
                                                    <strong id="email_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="required fw-bold fs-6 mb-2">{{ __('admin.Username') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="user_name" type="text" name="user_name"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.contentUsername') }}"
                                                           value="{{$user->user_name}}"/>
                                                    <strong id="user_name_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="required fw-bold fs-6 mb-2">{{ __('admin.Mobile') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="mobile" name="mobile"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.placeholderMobile') }}"
                                                           value="{{$user->mobile}}"/>
                                                    <strong id="mobile_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>

                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="required fw-bold fs-6 mb-2">{{ __('admin.Address') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="address" type="text" name="address"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.placeholderAddress') }}"
                                                           value="{{$user->address}}"/>
                                                    <strong id="address_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="required fw-bold fs-6 mb-2">{{ __('admin.Password') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="password" type="password" name="password"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.placeholderPassword') }}"
                                                           value=""/>
                                                    <strong id="password_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>

                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label
                                                        class="required fw-bold fs-6 mb-2">{{ __('admin.Image') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->

                                                    <input type="file" id="fileupload" name="fileupload" hidden/>

                                                    @if(\Illuminate\Support\Facades\App::getLocale() == "en")
                                                        <label for="fileupload" class="form-control form-control-solid"
                                                               style="color: black">Choose File: <span id="file-chosens"
                                                                                                       style="color: #5a6268">    No file chosen</span></label>
                                                    @else
                                                        <label for="fileupload" class="form-control form-control-solid"
                                                               style="color: black;">اختر ملف : <span id="file-chosens"
                                                                                                      style="color: #5a6268">    لم يتم اختيار ملف     </span></label>
                                                    @endif

                                                    <strong id="fileupload_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>

                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                        </form>
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('dashboard') }}"
                                       id="kt_ecommerce_edit_user_cancel"
                                       class="btn btn-light me-5">{{ __('admin.Cancel') }}</a>
                                    <button id="kt_modal_update_user_submit" class="btn btn-primary">
                                        <span class="indicator-label">{{ __('admin.Save') }}</span>
                                        <span class="indicator-progress">{{ __('admin.Please') }}
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>

                        <!--end:::Tab content-->
                        <!--end::Content-->

                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    <script>
        const actualBtns = document.getElementById('fileupload');

        const fileChosens = document.getElementById('file-chosens');

        actualBtns.addEventListener('change', function () {
            fileChosens.textContent = this.files[0].name
        })
    </script>

    <script>const language = $('#language').val();</script>
    <script src="{{ asset('assets/forms/admins/profile.js') }}" defer></script>
@endsection

