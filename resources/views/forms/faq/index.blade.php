@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('faq.Dashboard') }}
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                        <!--begin::Description-->
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('faq.FAQ') }}</small>
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
                                       placeholder="{{ __('faq.Search') }}"/>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                @can('question-create')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
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
                                    <!--end::Svg Icon-->{{ __('faq.Add') }}
                                </button>
                                @endcan
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                 data-kt-user-table-toolbar="selected">
                                <div class="fw-bolder me-5">
                                    <span class="me-2"
                                          data-kt-user-table-select="selected_count"></span>{{__("str.Selected")}}
                                </div>
                                <button type="button" class="btn btn-danger"
                                        data-kt-user-table-select="delete_selected">{{__("str.Delete Selected")}}
                                </button>
                            </div>
                            <!--end::Group actions-->
                            <!--begin::Modal - Adjust Balance-->
                            <!--end::Modal - New Card-->
                            <!--begin::Modal - Add user-->
                            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_user_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder">{{ __('faq.Add') }}</h2>
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
                                        <div class="modal-body scroll-y mx-5 mx-xl-20 my-7">
                                            <!--begin::Form-->
                                            <form id="kt_modal_add_user_form" class="form" action="#"
                                                  enctype="multipart/form-data">
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
                                                                <span class="required">{{ __('faq.Question') }} ({{ __('place.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.QuestionContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="question_en"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderQuestion') }}"
                                                                      name="question_en"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="question_en_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Question') }} ({{ __('place.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.QuestionContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="question_ar"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderQuestion') }}"
                                                                      name="question_ar"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="question_ar_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Answer') }} ({{ __('place.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.AnswerContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <textarea id="answer_en"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderAnswer') }}"
                                                                      name="answer_en"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="answer_en_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Answer') }} ({{ __('place.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.AnswerContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->

                                                            <textarea id="answer_ar"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderAnswer') }}"
                                                                      name="answer_ar"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="answer_ar_error" class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="reset" class="btn btn-light me-3"
                                                            data-kt-users-modal-action="cancel">{{ __('faq.Discard') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                            data-kt-users-modal-action="submit">
                                                        <span class="indicator-label">{{ __('faq.Submit') }}</span>
                                                        <span class="indicator-progress">{{ __('faq.Please') }}
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

                            <div class="modal fade" id="kt_modal_edit_event" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_edit_event_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder">{{ __('faq.EditQuestion') }}</h2>
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


                                                    <input type="hidden" id="question_id" name="question_id">
                                                    <div class="row">
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Question') }} ({{ __('place.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.QuestionContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="question_u_en"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderQuestion') }}"
                                                                      name="question_u_en"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="question_u_en_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Question') }} ({{ __('place.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.QuestionContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="question_u_ar"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderQuestion') }}"
                                                                      name="question_u_ar"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="question_u_ar_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Answer') }} ({{ __('place.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.AnswerContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="answer_u_en"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderAnswer') }}"
                                                                      name="answer_u_en"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="answer_u_en_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Answer') }} ({{ __('place.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="{{ __('faq.AnswerContent') }}"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea id="answer_u_ar"
                                                                      class="form-control form-control-solid"
                                                                      placeholder="{{ __('faq.placeholderAnswer') }}"
                                                                      name="answer_u_ar"></textarea>
                                                            <!--end::Input-->
                                                            <strong id="answer_u_ar_update_error"
                                                                    class="errors text-danger"
                                                                    role="alert"></strong>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="reset" class="btn btn-light me-3"
                                                            data-kt-permissions-modal-action="cancel">{{ __('faq.Discard') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                            data-kt-permissions-modal-action="submit">
                                                        <span class="indicator-label">{{ __('faq.Submit') }}</span>
                                                        <span class="indicator-progress">{{ __('faq.Please') }}
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


                            <div class="modal fade" id="kt_modal_show_event" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_edit_event_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder">{{ __('faq.QuestionInfo') }}</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
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

                                                    <input type="hidden" id="question_id_s" name="question_id_s">

                                                    <div class="row">
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Question') }} ({{ __('place.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="Question is required"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea disabled id="question_s_en"
                                                                      class="form-control form-control"
                                                                      placeholder="Enter a question"
                                                                      name="question_sen"></textarea>
                                                        </div>

                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Question') }} ({{ __('place.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="Question is required"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea disabled id="question_s_ar"
                                                                      class="form-control form-control"
                                                                      placeholder="Enter a question"
                                                                      name="question_s_ar"></textarea>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Answer') }} ({{ __('place.English') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="Answer is required"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea disabled id="answer_s_en"
                                                                      class="form-control form-control"
                                                                      placeholder="Enter a answer"
                                                                      name="answer_s_en"></textarea>
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="fv-row col-md-6 mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-bold form-label mb-2">
                                                                <span class="required">{{ __('faq.Answer') }} ({{ __('place.Arabic') }})</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                   data-bs-toggle="popover"
                                                                   data-bs-trigger="hover" data-bs-html="true"
                                                                   data-bs-content="Answer is required"></i>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <textarea disabled id="answer_s_ar"
                                                                      class="form-control form-control"
                                                                      placeholder="Enter a answer"
                                                                      name="answer_s_Ar"></textarea>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Scroll-->
                                                <!--begin::Actions-->
                                                <div class="text-center pt-15">
                                                    <button type="button" class="btn btn-light me-3 " id="target"
                                                            data-dismiss="modal"
                                                            aria-label="Close">{{ __('faq.Discard') }}
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
                                <th class="text">{{ __('faq.Question') }}</th>
                                <th class="text">{{ __('faq.Answer') }}</th>
                                <th class="text-center">{{ __('faq.Actions') }}</th>
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
    <script>const language = $('#language').val();</script>


    <script src="{{ asset('assets/forms/faq/index.js') }}" defer></script>
    <script src="{{ asset('assets/forms/faq/faq.js') }}" defer></script>
    <script src="{{ asset('assets/forms/faq/create_faq.js') }}" defer></script>
    <script src="{{ asset('assets/forms/faq/edit_faq.js') }}" defer></script>

    <script>
        $("#target").click(function () {
            $('#kt_modal_show_event').modal('hide');
        });
        // $('#kt_modal_show_event').modal('hide');

    </script>
    <script type="text/javascript">
        var token =  $('input[name="csrf-token"]').attr('value');

        $(function () {

            $(document).on('click', '#show', function () {
                let id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: base_path + language + "/faq/" + id,
                    success: function (response) {
                        $("#question_id_s").val(response.id);
                        $("#question_s_en").val(response.question['en']);
                        $("#question_s_ar").val(response.question['ar']);
                        $("#answer_s_en").val(response.answer['en']);
                        $("#answer_s_ar").val(response.answer['ar']);
                    },
                });

            });
        });
    </script>
@endsection
