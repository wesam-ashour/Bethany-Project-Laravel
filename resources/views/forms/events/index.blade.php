@extends('layouts.master')
@section('content')
    <style>
        #file-chosen {
            margin-left: 0.3rem;
            font-family: sans-serif;
        }
    </style>

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
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('event.Events') }}</small>
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
                                       class="form-control form-control-solid w-250px ps-14"
                                       placeholder="{{ __('event.Search') }}"/>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                @can('event-create')
                                    <button type="button" class="btn btn-primary addNew" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_user">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                        <span class="svg-icon svg-icon-2">
                            													<svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24" height="24"
                                                                                     viewBox="0 0 24 24" fill="none">
                            														<rect opacity="0.5" x="11.364"
                                                                                          y="20.364" width="16"
                                                                                          height="2"
                                                                                          rx="1"
                                                                                          transform="rotate(-90 11.364 20.364)"
                                                                                          fill="black"/>
                            														<rect x="4.36396" y="11.364"
                                                                                          width="16" height="2" rx="1"
                                                                                          fill="black"/>
                            													</svg>
                            												</span>
                                        <!--end::Svg Icon-->{{ __('event.Add') }}
                                    </button>
                                @endcan
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                 data-kt-user-table-toolbar="selected">
                            </div>
                            <!--end::Group actions-->
                            <!--begin::Modal - Adjust Balance-->
                            <!--end::Modal - New Card-->
                            <!--begin::Modal - Add user-->
                            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_user_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder">{{ __('event.Add') }}</h2>
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
                                            <form id="kt_modal_add_user_form" class="form" action="#">
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                     id="kt_modal_add_user_scroll" data-kt-scroll="true"
                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                     data-kt-scroll-max-height="auto"
                                                     data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                                     data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                                                     data-kt-scroll-offset="300px">
                                                    <!--begin::Input group-->

                                                    <div class="row">
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Title') }} ({{ __('event.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Title') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="title_en"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderTitle') }}"
                                                                   name="title_en"/>
                                                            <!--end::Input-->
                                                            <strong id="title_en_error" class="errors text-danger"
                                                                    role="alert"></strong>

                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Title') }} ({{ __('event.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Title') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="title_ar"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderTitle') }}"
                                                                   name="title_ar"/>
                                                            <!--end::Input-->
                                                            <strong id="title_ar_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Address') }} ({{ __('event.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Address') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="address_en"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderAddress') }}"
                                                                   name="address_en"/>
                                                            <!--end::Input-->
                                                            <strong id="address_en_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Address') }} ({{ __('event.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Address') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="address_ar"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderAddress') }}"
                                                                   name="address_ar"/>
                                                            <!--end::Input-->
                                                            <strong id="address_ar_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Description') }} ({{ __('event.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Description') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="description_en"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('event.placeholderDescription') }}"
                                                                      name="description_en"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="description_en_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Description') }} ({{ __('event.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Description') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="description_ar"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('event.placeholderDescription') }}"
                                                                      name="description_ar"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="description_ar_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Date') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Date') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input class="form-control form-control-solid"
                                                                   name="date" type="date"
                                                                   placeholder="{{ __('event.placeholderDate') }}"
                                                                   id="kt_datepicker_6"/>


                                                            <!--end::Input-->
                                                            <strong id="date_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Time') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Time') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input class="form-control form-control-solid"
                                                                   type="time"
                                                                   id="time" name="time"/>

                                                            <!--end::Input-->
                                                            <strong id="time_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>


                                                        <div class="fv-row col-md-12 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Image') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Image') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input type="file" id="fileupload" name="fileupload"
                                                                   hidden/>

                                                            @if(\Illuminate\Support\Facades\App::getLocale() == "en")
                                                                <label for="fileupload"
                                                                       class="form-control form-control-solid"
                                                                       style="color: black">Choose File: <span
                                                                        id="file-chosen" style="color: #5a6268">    No file chosen</span></label>
                                                            @else
                                                                <label for="fileupload"
                                                                       class="form-control form-control-solid"
                                                                       style="color: black;">اختر ملف : <span
                                                                        id="file-chosen" style="color: #5a6268">    لم يتم اختيار ملف     </span></label>
                                                            @endif
                                                            <!--end::Input-->
                                                            <strong id="fileupload_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-4 mb-3">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">Lat</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input type="text" id="default_latitude"
                                                                   class="form-control form-control-solid"
                                                                   name="default_latitude">


                                                            <!--end::Input-->
                                                            <strong id="default_latitude_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-4 mb-3">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">Long</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input type="text" id="default_longitude"
                                                                   class="form-control form-control-solid"
                                                                   name="default_longitude">

                                                            <!--end::Input-->
                                                            <strong id="default_longitude_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-sm-1 mb-3" style="padding-top: 28px;">

                                                            <button  type="button" class="btn btn-light-primary"
                                                                    onclick="initMap()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div class="fv-row col-sm-1 mb-3" style="padding-top: 28px; @if(\Illuminate\Support\Facades\App::getLocale() == "en") padding-left: 30px; @else padding-right: 30px; @endif">

                                                            <button  type="button" class="btn btn-light-success"
                                                                     onclick="resetMap()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-fill" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                                                                </svg>
                                                            </button>
                                                        </div>


                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Location') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Location') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <div id="map1"
                                                                 style="width: 100%; height:400px;"></div>


                                                            <!--end::Input-->
                                                            <strong id="name_error" class="errors text-danger"
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
																		<span
                                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                            <!--end::Modal - Add user-->

                            <!--begin::Modal - edit event-->
                            <div class="modal fade" id="kt_modal_edit_event" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_edit_event_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder">{{ __('event.Edit') }}</h2>
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
                                            <form id="kt_modal_update_event_form" class="form" action="#">
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                     id="kt_modal_edit_event_scroll" data-kt-scroll="true"
                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                     data-kt-scroll-max-height="auto"
                                                     data-kt-scroll-dependencies="#kt_modal_edit_event_header"
                                                     data-kt-scroll-wrappers="#kt_modal_edit_event_scroll"
                                                     data-kt-scroll-offset="300px">
                                                    <!--begin::Input group-->

                                                    <div class="row">
                                                        <input type="hidden" id="event_id" name="event_id">
                                                        <!--end::Input-->
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Title') }} ({{ __('event.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Title') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="title_en_edit"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderTitle') }}Enter a title"
                                                                   name="title_en_edit"/>
                                                            <!--end::Input-->
                                                            <strong id="title_en_edit_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>

                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Title') }} ({{ __('event.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Title') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="title_ar_edit"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderTitle') }}"
                                                                   name="title_ar_edit"/>
                                                            <!--end::Input-->
                                                            <strong id="title_ar_edit_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Address') }} ({{ __('event.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Address') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="address_en_edit"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderAddress') }}"
                                                                   name="address_en_edit"/>
                                                            <!--end::Input-->
                                                            <strong id="address_en_edit_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Address') }} ({{ __('event.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Address') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input id="address_ar_edit"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="{{ __('event.placeholderAddress') }}"
                                                                   name="address_ar_edit"/>
                                                            <!--end::Input-->
                                                            <strong id="address_ar_edit_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Description') }} ({{ __('event.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Description') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="description_en_edit"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('event.placeholderDescription') }}"
                                                                      name="description_en_edit"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="description_en_edit_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Description') }} ({{ __('event.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Description') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="description_ar_edit"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('event.placeholderDescription') }}"
                                                                      name="description_ar_edit"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="description_ar_edit_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Date') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Date') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input class="form-control form-control-solid"
                                                                   name="date_u" type="date"
                                                                   placeholder="{{ __('event.placeholderDate') }}Pick a date"
                                                                   id="kt_datepicker_7"/>


                                                            <!--end::Input-->
                                                            <strong id="date_u_update_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Time') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Time') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input class="form-control form-control-solid"
                                                                   type="time"
                                                                   id="time_edit" name="time_edit"/>

                                                            <!--end::Input-->
                                                            <strong id="time_edit_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>


                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Image') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Image') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input type="file" id="fileuploads" name="fileuploads"
                                                                   hidden/>

                                                            @if(\Illuminate\Support\Facades\App::getLocale() == "en")
                                                                <label for="fileuploads"
                                                                       class="form-control form-control-solid"
                                                                       style="color: black">Choose File: <span
                                                                        id="file-chosens" style="color: #5a6268">    No file chosen</span></label>
                                                            @else
                                                                <label for="fileuploads"
                                                                       class="form-control form-control-solid"
                                                                       style="color: black;">اختر ملف : <span
                                                                        id="file-chosens" style="color: #5a6268">    لم يتم اختيار ملف     </span></label>
                                                            @endif

                                                            <!--end::Input-->
                                                            <strong id="fileupload_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('event.Status') }}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Status') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <select class="form-select" name="status" id="status"
                                                                    data-placeholder="{{ __('event.content_Status_data') }}">
                                                                @foreach(\App\Models\Event::Status as $i)
                                                                    <option value="{{$i}}">
                                                                        @if($i == 1)
                                                                            {{ __('event.Active') }}
                                                                        @else
                                                                            {{ __('event.Inactive') }}
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <!--end::Input-->
                                                            <strong id="status_update_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-4 mb-3">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">Lat</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input type="text" id="default_latitude_u" name="default_latitude_u"
                                                                   class="form-control form-control-solid"
                                                            >


                                                            <!--end::Input-->
                                                            <strong id="default_latitude_u_update_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-4 mb-3">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">Long</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <input type="text" id="default_longitude_u" name="default_longitude_u"
                                                                   class="form-control form-control-solid">

                                                            <!--end::Input-->
                                                            <strong id="default_longitude_u_update_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-sm-1 mb-3" style="padding-top: 28px;">

                                                            <button  type="button" class="btn btn-light-primary"
                                                                     onclick="initMaps()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div class="fv-row col-sm-1 mb-3" style="padding-top: 28px; @if(\Illuminate\Support\Facades\App::getLocale() == "en") padding-left: 30px; @else padding-right: 30px; @endif">

                                                            <button  type="button" class="btn btn-light-success"
                                                                     onclick="resetMaps()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-fill" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span
                                                                    class="required">{{ __('event.Location') }} </span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('event.content_Location') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <div id="map" style="width: 100%; height:400px;"></div>
                                                            <!--end::Input-->
                                                            <strong id="default_latitude_u_update_error"
                                                                    class="errors text-danger"
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
																		<span
                                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                            <!--end::Modal - edit event-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_forms_table">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text">{{ __('event.Title') }}</th>
                                <th class="text">{{ __('event.Date') }}</th>
                                <th class="text">{{ __('event.Add_by') }}</th>
                                <th class="text">{{ __('event.Status') }}</th>
                                <th class="text-center">{{ __('event.Actions') }}</th>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        const actualBtn = document.getElementById('fileupload');

        const fileChosen = document.getElementById('file-chosen');

        actualBtn.addEventListener('change', function () {
            fileChosen.textContent = this.files[0].name
        })

        const actualBtns = document.getElementById('fileuploads');

        const fileChosens = document.getElementById('file-chosens');

        actualBtns.addEventListener('change', function () {
            fileChosens.textContent = this.files[0].name
        })
    </script>
    <script>
        jQuery(document).ready(function ($) {
            $('.classroomLike').click(function () {
                $.ajax({
                    url: '{{ route('generator') }}',
                    type: 'get',
                    success: function (respons) {
                        var result = respons;
                        var img = $('<img id="image_id">');
                        jQuery('#uniqid').val(result.id);
                        // $('input#uniqid').removeAttr('id');
                        img.attr('src', result.qr);
                        img.appendTo('#image_div');
                        $('div#image_div').removeAttr('id');
                        // $(".gen").remove()
                    },
                });
            });
        });
    </script>

    <script>
        $(function () {
            $('body').on('click', '.addNew', function () {
                window.onload = showlocation();
            });
        });
        let map, activeInfoWindow, markers = [];
        var marker;

        /* ----------------------------- Initialize Map ----------------------------- */
        function resetMap() {
            $("#default_latitude").val('');
            $("#default_longitude").val('');
            showlocation();
        }

        function showlocation() {
            navigator.geolocation.getCurrentPosition(initMap);
        }

        function initMap(position) {

            if (document.getElementById("default_latitude").value.length == 0) {
                var lat = parseFloat(position.coords.latitude);
                var lon = parseFloat(position.coords.longitude);

            } else {
                var lat = $('#default_latitude').val();
                var lon = $('#default_longitude').val();
            }
            document.getElementById('default_latitude').value = lat;
            document.getElementById('default_longitude').value = lon;
            var myLatlng = new google.maps.LatLng(lat, lon);
            var mapOptions = {
                zoom: 10,
                center: myLatlng
            }
            var map = new google.maps.Map(document.getElementById("map1"), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                draggable: true,
            });
            marker.setMap(map);
            window.initMap = initMap;
            map.addListener("click", function (event) {
                mapClicked(event);
            });
            marker.addListener("dragend", (event) => {
                $("#default_latitude").val(event.latLng.lat());
                $("#default_longitude").val(event.latLng.lng());
            });
        }
    </script>
    <script>const language = $('#language').val();</script>
    <script src="{{ asset('assets/forms/events/index.js') }}" defer></script>
    <script src="{{ asset('assets/forms/events/events.js') }}" defer></script>
    <script src="{{ asset('assets/forms/events/create_events.js') }}" defer></script>
    <script src="{{ asset('assets/forms/events/edit_events.js') }}" defer></script>

    <script>
        function resetMaps() {
            $("#default_latitude_u").val('');
            $("#default_longitude_u").val('');
            showlocations();
        }

        function showlocations() {
            navigator.geolocation.getCurrentPosition(initMaps);
        }

        function initMaps(position) {
            if (document.getElementById("default_latitude_u").value.length == 0) {
                var lat = parseFloat(position.coords.latitude);
                var lon = parseFloat(position.coords.longitude);

            } else {
                var lat = $('#default_latitude_u').val();
                var lon = $('#default_longitude_u').val();
            }
            document.getElementById('default_latitude_u').value = lat;
            document.getElementById('default_longitude_u').value = lon;
            var myLatlng = new google.maps.LatLng(lat, lon);
            var mapOptions = {
                zoom: 10,
                center: myLatlng
            }
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                draggable: true,
            });
            marker.setMap(map);
            window.initMap = initMap;
            map.addListener("click", function (event) {
                mapClicked(event);
            });
            marker.addListener("dragend", (event) => {
                $("#default_latitude_u").val(event.latLng.lat());
                $("#default_longitude_u").val(event.latLng.lng());
            });
        }
    </script>
@endsection
