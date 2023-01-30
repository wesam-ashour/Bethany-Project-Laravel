@extends('layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('user.Dashboard') }}
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                        <!--begin::Description-->
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('user.Users') }}</small>
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
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                              height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                              fill="black"/>
														<path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="black"/>
													</svg>
												</span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-ecommerce-forms-filter="search"
                                       class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('event.Search') }}"/>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                @can('tourist-create')
                                    <button type="button" class="btn btn-primary addNew" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_user">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                            													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                                     viewBox="0 0 24 24" fill="none">
                            														<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                                                          rx="1" transform="rotate(-90 11.364 20.364)"
                                                                                          fill="black"/>
                            														<rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                                                          fill="black"/>
                            													</svg>
                            												</span>
                                        <!--end::Svg Icon-->{{ __('user.AddUsers') }}
                                    </button>
                                @endcan
                                <!--end::Add user-->
                            </div>

                            <!--end::Toolbar-->
                            <!--begin::Modal - Adjust Balance-->
                            <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">

                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                            <!--end::Modal - New Card-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 kt_ecommerce_forms_table" id="kt_ecommerce_forms_table">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text">{{ __('user.Full') }}</th>
                                <th class="text">{{ __('user.Email') }}</th>

                                <th class="text">{{ __('user.Mobile') }}</th>
                                <th class="text">{{ __('user.email_verified') }}</th>

                                <th class="text">{{ __('user.Address') }}</th>
                                <th class="text-center">{{ __('admin.Actions') }}</th>
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
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-l">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{ __('user.AddUsers') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                         data-kt-users-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.5" x="6" y="17.3137" width="16"
                                                                              height="2" rx="1"
                                                                              transform="rotate(-45 6 17.3137)"
                                                                              fill="black"/>
																		<rect x="7.41422" y="6" width="16" height="2"
                                                                              rx="1" transform="rotate(45 7.41422 6)"
                                                                              fill="black"/>
																	</svg>
																</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_add_user_form" class="form" action="#" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7"
                             id="kt_modal_add_user_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_add_user_header"
                             data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                             data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <input type="hidden" id="lan" name="lan" value="{{\Illuminate\Support\Facades\App::getLocale()}}">


                            <div class="row">
                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.NameUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_NameUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="name" type="text"
                                           class="form-control form-control-solid"
                                           placeholder="{{ __('user.placeholderNameUsers') }}" name="name"/>
                                    <!--end::Input-->
                                    <strong id="name_error" class="errors text-danger"
                                            role="alert"></strong>

                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.EmailUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_EmailUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="email" @if(\Illuminate\Support\Facades\App::getLocale() == "ar") style="direction: rtl" @endif
                                           class="form-control form-control-solid" type="email"
                                           placeholder="{{ __('user.placeholderEmailUsers') }}" name="email"/>
                                    <!--end::Input-->
                                    <strong id="email_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.MobileUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_MobileUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="mobile" type="number" @if(\Illuminate\Support\Facades\App::getLocale() == "ar") style="direction: rtl" @endif
                                           class="form-control form-control-solid"
                                           placeholder="{{ __('user.placeholderMobileUsers') }}" name="mobile"/>
                                    <!--end::Input-->
                                    <strong id="mobile_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.AddressUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_AddressUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="address"
                                           class="form-control form-control-solid" type="text"
                                           placeholder="{{ __('user.placeholderAddressUsers') }}" name="address"/>
                                    <!--end::Input-->
                                    <strong id="address_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.EventsUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_AddressUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select  class="form-select form-select-solid" data-placeholder="{{ __('user.Selectـanـoption') }}"  data-control="select2" name="events[]" id="events" multiple @if(\Illuminate\Support\Facades\App::getLocale() == "ar") dir="rtl" @endif>
                                        @foreach(\App\Models\Event::all() as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <strong id="events_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3"
                                    data-kt-users-modal-action="cancel">{{ __('event.Discard') }}
                            </button>
                            <button type="submit" class="btn btn-primary"
                                    data-kt-users-modal-action="submit">
                                <span class="indicator-label">{{ __('event.Submit') }}</span>
                                <span class="indicator-progress">{{ __('event.Please') }}
																		<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-l">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{ __('user.AddUsers') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                         data-kt-permissions-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.5" x="6" y="17.3137" width="16"
                                                                              height="2" rx="1"
                                                                              transform="rotate(-45 6 17.3137)"
                                                                              fill="black"/>
																		<rect x="7.41422" y="6" width="16" height="2"
                                                                              rx="1" transform="rotate(45 7.41422 6)"
                                                                              fill="black"/>
																	</svg>
																</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_edit_user_form" class="form" action="#" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7"
                             id="kt_modal_add_user_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_add_user_header"
                             data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                             data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <input type="hidden" id="lan" name="lan" value="{{\Illuminate\Support\Facades\App::getLocale()}}">
                            <input type="hidden" id="user_id" name="user_id">


                            <div class="row">
                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.NameUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_NameUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="name_edit" type="text"
                                           class="form-control form-control-solid"
                                           placeholder="{{ __('user.placeholderNameUsers') }}" name="name_edit"/>
                                    <!--end::Input-->
                                    <strong id="name_edit_error" class="errors text-danger"
                                            role="alert"></strong>

                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.EmailUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_EmailUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="email_edit" @if(\Illuminate\Support\Facades\App::getLocale() == "ar") style="direction: rtl" @endif
                                           class="form-control form-control-solid" type="email"
                                           placeholder="{{ __('user.placeholderEmailUsers') }}" name="email_edit"/>
                                    <!--end::Input-->
                                    <strong id="email_edit_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.MobileUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_MobileUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="mobile_edit" type="number" @if(\Illuminate\Support\Facades\App::getLocale() == "ar") style="direction: rtl" @endif
                                           class="form-control form-control-solid"
                                           placeholder="{{ __('user.placeholderMobileUsers') }}" name="mobile_edit"/>
                                    <!--end::Input-->
                                    <strong id="mobile_edit_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.AddressUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_AddressUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="address_edit"
                                           class="form-control form-control-solid" type="text"
                                           placeholder="{{ __('user.placeholderAddressUsers') }}" name="address_edit"/>
                                    <!--end::Input-->
                                    <strong id="address_edit_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                                <div class="fv-row col-md-12 mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('user.EventsUsers') }}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                           data-bs-toggle="popover"
                                           data-bs-trigger="hover" data-bs-html="true"
                                           data-bs-content="{{ __('user.content_AddressUsers') }}"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select  class="form-select form-select-solid" data-placeholder="{{ __('user.Selectـanـoption') }}"  data-control="select2" name="events_edit[]" id="events_edit" multiple @if(\Illuminate\Support\Facades\App::getLocale() == "ar") dir="rtl" @endif>
                                        @foreach(\App\Models\Event::all() as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    <strong id="events_edit_error" class="errors text-danger"
                                            role="alert"></strong>
                                </div>

                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3"
                                    data-kt-permissions-modal-action="cancel">{{ __('event.Discard') }}
                            </button>
                            <button type="submit" class="btn btn-primary"
                                    data-kt-permissions-modal-action="submit">
                                <span class="indicator-label">{{ __('event.Submit') }}</span>
                                <span class="indicator-progress">{{ __('event.Please') }}
																		<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('assets/forms/users/index.js') }}" defer></script>
    <script src="{{ asset('assets/forms/users/users.js') }}" defer></script>
    <script src="{{ asset('assets/forms/users/create.js') }}" defer></script>
    <script src="{{ asset('assets/forms/users/update.js') }}" defer></script>
@endsection
