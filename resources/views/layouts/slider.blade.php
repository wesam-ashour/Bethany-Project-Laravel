<!--begin::Aside menu-->
@php
    $language = config('app.locale');
    $url = \Illuminate\Support\Facades\URL::current();
    $previous_url = \Illuminate\Support\Facades\URL::previous();
@endphp

<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
         data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
            <div class="menu-item">
                <a class="menu-link  {{str_contains($url,"dashboard") ? "active":""}}" href="{{url('dashboard')}}">
													<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black"/>
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
												</svg>
											</span>
                                                        <!--end::Svg Icon-->
										</span>
                    <span class="menu-title">{{ __('home.Dashboard') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('home.Forms') }}</span>
                </div>
            </div>
            @if(auth()->user()->can('admin-list') || auth()->user()->can('role-list'))
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{str_contains($url,"admins") | str_contains($url,"roles") ? "hover show":""}}">
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<path
                                                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                        fill="black"></path>
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                          fill="black"></rect>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
										<span class="menu-title">{{ __('home.Admin') }}</span>
										<span class="menu-arrow"></span>
									</span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    @can('admin-list')
                    <div class="menu-item">
                        <a class="menu-link  {{str_contains($url,"admins") ? "active":""}}" href="{{route('admins.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.Admins') }}</span>
                        </a>
                    </div>
                    @endcan
                        @can('role-list')
                    <div class="menu-item">
                        <a class="menu-link  {{str_contains($url,"roles") ? "active":""}}" href="{{route('roles.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.Roles') }}</span>
                        </a>
                    </div>
                        @endcan
                </div>
            </div>
            @endif
            @if(auth()->user()->can('user-list') || auth()->user()->can('event-list') || auth()->user()->can('place-list') || auth()->user()->can('tourist-list'))
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('home.Tables') }}</span>
                    </div>
                </div>
                    @can('user-list')
                    <div class="menu-item">
                        <a class="menu-link {{str_contains($url,"users") ? "active":""}}" href="{{route('users.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.Users') }}</span>
                        </a>
                    </div>
                    @endcan
                    @can('event-list')
                    <div class="menu-item">
                        <a class="menu-link {{str_contains($url,"events") ? "active":""}}" href="{{route('events.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.Events') }}</span>
                        </a>
                    </div>
                    @endcan
                    @can('place-list')
                    <div class="menu-item">
                        <a class="menu-link {{str_contains($url,"places") ? "active":""}}" href="{{route('places.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.Places') }}</span>
                        </a>
                    </div>
                    @endcan
                    @can('tourist-list')
                    <div class="menu-item">
                        <a class="menu-link {{str_contains($url,"tourists") ? "active":""}}" href="{{route('tourists.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.Tourist') }}</span>
                        </a>
                    </div>
                    @endcan

            @endcan
            @if(auth()->user()->can('question-list') || auth()->user()->can('option-list'))


                    <div class="menu-item">
                        @can('question-list')
                        <a class="menu-link {{str_contains($url,"faq") ? "active":""}}" href="{{route('faq.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.faq') }}</span>
                        </a>
                        @endcan
                    </div>
                    <div class="menu-item">
                        @can('option-list')
                        <a class="menu-link {{str_contains($url,"options") ? "active":""}}" href="{{route('options.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{ __('home.Settings') }}</span>
                        </a>
                        @endcan
                    </div>

            @endif

            <div class="menu-item">
                <div class="menu-content">
                    <div class="separator mx-1 my-4"></div>
                </div>
            </div>
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside menu-->

<!--end::Footer-->
</div>
<!--end::Aside-->
