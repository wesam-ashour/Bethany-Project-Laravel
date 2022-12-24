<!--begin::Header-->
<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                 id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
											<path
                                                d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                                fill="black"/>
											<path opacity="0.3"
                                                  d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                                  fill="black"/>
										</svg>
									</span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{url('/')}}" class="d-lg-none">
                <img alt="Logo" src="{{asset('assets/media/logos/logo-2.svg')}}" class="h-30px"/>
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::Navbar-->
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                         data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="{{ asset('public/images/admins/' . \Illuminate\Support\Facades\Auth::user()->image) }}"
                             alt="user"/>
                    </div>
                    <!--begin::User account menu-->
                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo"
                                         src="{{ asset('public/images/admins/' . \Illuminate\Support\Facades\Auth::user()->image) }}"/>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div
                                        class="fw-bolder d-flex align-items-center fs-5">{{\Illuminate\Support\Facades\Auth::user()->name}}
                                        <span
                                            class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{\Illuminate\Support\Facades\Auth::user()->getRoleNames()[0]}}</span>
                                    </div>
                                    <a href="#"
                                       class="fw-bold text-muted text-hover-primary fs-7">{{\Illuminate\Support\Facades\Auth::user()->email}}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{url('profile')}}"
                               class="menu-link px-5">{{ __('home.Profile') }}</a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                            <a href="#" class="menu-link px-5">
													<span class="menu-title position-relative">{{ __('home.Language') }}
													<span
                                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">@if(\Illuminate\Support\Facades\App::getLocale() == "en")
                                                            English
                                                        @else
                                                            العربية
                                                        @endif
                                                        @if(\Illuminate\Support\Facades\App::getLocale() == "en")<img
                                                            class="w-15px h-15px rounded-1 ms-2"
                                                            src="{{asset('assets/media/flags/united-states.svg')}}"
                                                            alt=""/></span></span>@else
                                    <img class="w-15px h-15px rounded-1 ms-2"
                                         src="{{asset('assets/media/flags/saudi-arabia.svg')}}" alt=""/></span></span>
                                @endif
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div class="menu-item px-3">
                                        <a hreflang="{{ $localeCode }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                           class="menu-link d-flex px-5 ">
													<span class="symbol symbol-20px me-4">
														@if($localeCode == "en")
                                                            <img class="rounded-1"
                                                                 src="{{asset('assets/media/flags/united-states.svg')}}"
                                                                 alt=""/>
                                                        @elseif($localeCode == "ar")
                                                            <img class="rounded-1"
                                                                 src="{{asset('assets/media/flags/saudi-arabia.svg')}}"
                                                                 alt="arabic"/>
                                                        @endif
													</span>{{ $properties['native'] }}</a>
                                    </div>
                                @endforeach
                                <!--end::Menu item-->

                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="menu-link px-5">{{ __('home.Sign') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
