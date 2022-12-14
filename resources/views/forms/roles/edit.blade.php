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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('role.Dashboard') }}
                        <!--begin::Separator-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--end::Separator-->
                        <!--begin::Description-->
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">{{ __('role.Roles') }}</small>
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
                                <h2>{{ __('role.Roles') }}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div id="kt_modal_edit_user" class="card-body pt-0 pb-5">
                            <div id="kt_modal_edit_user_form" data-kt-redirect="">
                                <!--begin::Scroll-->
                                <div id="kt_modal_edit_user_scroll">
                                    <form id="kt_modal_edit_user_only1">

                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-6 mb-7">
                                                <!--begin::Label-->
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{ __('role.Name') }}</label>
                                                <!--end::Label-->
                                                <input id="role_id" name="role_id" type="hidden" value="{{$role->id}}">

                                                <!--begin::Input-->
                                                <input type="text" name="name" id="name"
                                                       class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                                                       value="{{ $role->name ? : old('name') }}"/>
                                                <strong id="name_error"
                                                        class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <!--end::Input-->

                                            </div>


                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="col-md-12 mb-7">
                                                <!--begin::Label-->
                                                <!--begin::Label-->
                                                <label class="required fw-semibold fs-6 mb-2">{{ __('role.Permissions') }}</label>
                                                <!--end::Label-->
                                                <br>
                                                <strong id="permission_error"
                                                        class="errors text-danger"
                                                        role="alert">
                                                </strong>
                                                <br>

                                                <!--begin::Input-->
                                                @foreach($permission as $value)
                                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name','id' => 'permission[]','name'=>'permission[]','multiple')) }}
                                                        {{ $value->name }}</label>
                                                    <br/>
                                                @endforeach


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
                                <a href="{{ route('roles.index') }}"
                                   id="kt_ecommerce_edit_user_cancel" class="btn btn-light me-5">{{ __('role.Discard') }}</a>
                                <button id="kt_modal_update_user_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ __('admin.Save') }}</span>
                                    <span class="indicator-progress">{{ __('admin.Please') }}
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
                    <div class="modal fade" tabindex="-1" id="kt_modal_scrollable_2">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>

                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                         data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-2x"></span>
                                    </div>
                                    <!--end::Close-->
                                </div>

                                <div class="modal-body">
                                    <p>Long modal body text goes here.</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Content-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script>const language = $('#language').val();</script>

                <script src="{{ asset('assets/forms/roles/edit_roles.js') }}" defer></script>

@endsection

