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
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('admin.Admins') }} - {{$user->name}}</small>
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

                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->

                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <form id="data">
                        <!--begin::Card-->
                        <div class="card card-flush py-4 mb-10">
                            <!--begin::Card body-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{ __('admin.Image') }}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <div class="card-body text-center pt-0">
                                <!--begin::Summary-->
                                <!--begin::User Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <div class="">
                                        <!--begin::Label-->
                                        <!--end::Label-->
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-empty image-input-outline mb-3"
                                             data-kt-image-input="true"
                                             style="background-image: url({{asset("images/admins/".$user->image)}});">
                                            <!--begin::Preview existing avatar-->
                                            <div id="uploaded_image"
                                                 class="image-input-wrapper w-125px h-125px"
                                                 style="background-image: url({{asset("images/admins/".$user->image)}});"></div>
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change"
                                                data-bs-toggle="tooltip" title="Change image">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input id="image_file_input" type="file" name="image_file_input"
                                                       accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="avatar_remove"/>
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel"
                                                data-bs-toggle="tooltip" title="Cancel image">
																				<i class="bi bi-x fs-2"></i>
																			</span>
                                            <!--end::Cancel-->
                                            <!--begin::Remove-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove"
                                                data-bs-toggle="tooltip" title="Remove image">
																				<i class="bi bi-x fs-2"></i>
																			</span>
                                            <!--end::Remove-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="text-muted fs-7">{{ __('admin.Allowed') }} </div>
                                        <!--end::Hint-->
                                    </div>

                                </div>
                                <!--end::User Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="text-start">
                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                             href="#kt_user_view_details" role="button" aria-expanded="false"
                                             aria-controls="kt_user_view_details">Details
                                            <span class="ms-2 rotate-180">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<path
                                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                    fill="black"/>
															</svg>
														</span>
                                                <!--end::Svg Icon-->
													</span></div>
                                    </div>
                                    <!--end::Details toggle-->
                                    <div class="separator"></div>
                                    <!--begin::Details content-->
                                    <div id="kt_user_view_details" class="collapse show">
                                        <div class="pb-5 fs-6">
                                            <!--begin::Details item-->
                                            <div class="fw-bolder mt-5">{{ __('admin.Account') }}</div>
                                            <div class="text-gray-600">ID-{{$user->id}}</div>
                                            <!--begin::Details item-->
                                            <!--begin::Details item-->
                                            <div class="fw-bolder mt-5">{{ __('admin.Email') }}</div>
                                            <div class="text-gray-600">
                                                <a href="#"
                                                   class="text-gray-600 text-hover-primary">{{$user->email}}</a>
                                            </div>
                                            <div class="fw-bolder mt-5">{{ __('admin.Mobile') }}</div>
                                            <div class="text-gray-600">
                                                <a href="#"
                                                   class="text-gray-600 text-hover-primary">{{$user->mobile}}</a>
                                            </div>
                                            <!--begin::Details item-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
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

                                            <!--begin::Input group-->
                                            <input id="admin_id" name="admin_id" type="hidden" value="{{$user->id}}">
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
                                                           placeholder="{{ __('admin.placeholderName') }}" value="{{$user->name}}"/>
                                                    <strong id="name_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-bold fs-6 mb-2">{{ __('admin.Email') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="email" type="email" name="email"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.contentEmail') }}" value="{{$user->email}}"/>
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
                                                    <label class="required fw-bold fs-6 mb-2">{{ __('admin.Mobile') }}</label>
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
                                                    <label class="required fw-bold fs-6 mb-2">{{ __('admin.Address') }}</label>
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
                                                @if($user->id !== 1)
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-bold fs-6 mb-2">Status</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-select form-select-solid" name="status" id="status" data-placeholder="{{ __('event.content_Status_data') }}">
                                                        @foreach(\App\Models\Event::Status as $i)
                                                            <option value="{{$i}}" @if($user->status == $i) selected @endif>
                                                                @if($i == 1)
                                                                    {{ __('event.Active') }}
                                                                @else
                                                                    {{ __('event.Inactive') }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <strong id="status_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>
                                                @endif
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="col-md-6 mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-bold fs-6 mb-2">{{ __('admin.Password') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input id="password" type="password" name="password"
                                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                                           placeholder="{{ __('admin.placeholderPassword') }}" value=""/>
                                                    <strong id="password_error" class="errors text-danger"
                                                            role="alert">
                                                    </strong>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-bold fs-6 mb-5">{{ __('admin.Roles') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Roles-->
                                                    @if(\Illuminate\Support\Facades\App::getLocale() == "ar")
                                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-select form-select-solid','multiple', 'id' => 'roles','data-kt-select2'=>'true','dir'=>'rtl')) !!}
                                                    @else
                                                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-select form-select-solid','multiple', 'id' => 'roles','data-kt-select2'=>'true')) !!}
                                                    @endif
                                                </div>
                                                <strong id="roles_error"
                                                        class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input group-->
                                            </div>

                                    </div>
                                    <!--end::Scroll-->

                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end:::Tab content-->
                        </form>
                    </div>
                    <!--end::Content-->

                </div>

                <!--begin::Actions-->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admins.index') }}"
                       id="kt_ecommerce_edit_user_cancel" class="btn btn-light me-5">{{ __('admin.Cancel') }}</a>
                    <button id="kt_modal_update_user_submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('admin.Save') }}</span>
                        <span class="indicator-progress">{{ __('admin.Please') }}
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    <script>const language = $('#language').val();</script>

    <script src="{{ asset('assets/forms/admins/edit_admins.js') }}" defer></script>

@endsection

