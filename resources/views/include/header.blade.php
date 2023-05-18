<!-- Start Topbar Mobile -->
<div class="topbar-mobile">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="mobile-logobar">
                <a href="{{ url('/') }}" class="mobile-logo"><img src="{{ asset('backend/images/logo.png') }}"
                        class="img-fluid" alt="logo"></a>
            </div>
            <div class="mobile-togglebar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="topbar-toggle-icon">
                            <a class="topbar-toggle-hamburger" href="javascript:void();">
                                <img src="{{ asset('backend/images/svg-icon/horizontal.svg') }}"
                                    class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                <img src="{{ asset('backend/images/svg-icon/verticle.svg') }}"
                                    class="img-fluid menu-hamburger-vertical" alt="verticle">
                            </a>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="menubar">
                            <a class="menu-hamburger" href="javascript:void();">
                                <img src="{{ asset('backend/images/svg-icon/collapse.svg') }}"
                                    class="img-fluid menu-hamburger-collapse" alt="collapse">
                                <img src="{{ asset('backend/images/svg-icon/close.svg') }}"
                                    class="img-fluid menu-hamburger-close" alt="close">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Start Topbar -->
<div class="topbar">
    <!-- Start row -->
    <div class="row align-items-center">
        <!-- Start col -->
        <div class="col-md-12 align-self-center">
            <div class="togglebar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="menubar">
                            <a class="menu-hamburger" href="javascript:void();">
                                <img src="{{ asset('backend/images/svg-icon/collapse.svg') }}"
                                    class="img-fluid menu-hamburger-collapse" alt="collapse">
                                <img src="{{ asset('backend/images/svg-icon/close.svg') }}"
                                    class="img-fluid menu-hamburger-close" alt="close">
                            </a>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <h4>{{ config('app.name') }}  Bulk Delete Testing</h4>
                    </li>
                </ul>
            </div>
            {{-- <h4 class="page-title">@yield('title')</h4> --}}

            <div class="infobar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="settingbar" style="visibility: hidden">
                            <a href="javascript:void(0)" id="infobar-settings-open" class="infobar-icon">
                                <img src="{{ asset('backend/images/svg-icon/settings.svg') }}" class="img-fluid"
                                    alt="settings">
                            </a>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="profilebar">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="profilelink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('backend/images/users/profile.svg') }}" class="img-fluid"
                                        alt="profile">
                                    <span class="feather icon-chevron-down live-icon"></span></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                    <div class="dropdown-item">
                                        <div class="profilename">
                                            <h5>Hi Tester</h5>
                                        </div>
                                    </div>
                                    <div class="userbox">
                                        <ul class="list-unstyled mb-0">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="bread_crumb">
                <ol style="background-color:transparent; padding:0;" class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Topbar -->
