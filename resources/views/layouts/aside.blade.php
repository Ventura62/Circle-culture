
<div class="aside aside-left d-flex aside-fixed" id="kt_aside">
    <!--begin::Primary-->

    <!--end::Primary-->
    <!--begin::Secondary-->
    <div class="aside-secondary d-flex flex-row-fluid">
        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab Pane-->
                <!--end::Tab Pane-->
                <a href="{{ URL::to('/') }}">
                    {{--<img style="max-height: 34px" alt="Logo" src="{{ asset('frontend/img/logo-black.png') }}" class="logo-default mt-5 ml-5" />--}}
                </a>
                <!--begin::Tab Pane-->
                <div class="tab-pane fade show active" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid px-10 py-5" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">

                                <li class="menu-item" aria-haspopup="true">
                                    <a  href="{{ route('dashboard') }}" class="text-muted  text-hover-primary font-weight-bold side-link">
                                        <div @if(request()->segment(1)=='') style="background: #fff; border-radius: 10px" @endif  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label ">
                                                        <span class="svg-icon svg-icon-xl  @if(request()->segment(1)=='' ) svg-icon-success @endif">
                                                            <i style="font-size: 1.7rem" class=" @if(request()->segment(1)=='' ) text-primary  @endif flaticon-squares"></i>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="@if(request()->segment(1)=='' ) text-primary @endif font-size-h6 mb-0">
                                                    Dashboard
                                                    </span>

                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>

                                </li>

                                <li class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='circles') style="background: #fff; border-radius: 10px" @endif href="{{ route('circles') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='circles') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                <span class="symbol-label  ">
                                                    <span class="svg-icon svg-icon-2xl">
                                                      <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='circles') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='circles') text-primary @endif font-size-h6 mb-0">
                                                Circles
                                                </span>
                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>


                                <li hidden class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions') style="background: #fff; border-radius: 10px" @endif href="{{ route('submissions') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                <span class="symbol-label  ">
                                                    <span class="svg-icon svg-icon-2xl">
                                                      <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions') text-primary @endif font-size-h6 mb-0">
                                                Submissions
                                                </span>
                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                                <li hidden class="menu-item" aria-haspopup="true">
                                        <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='questions') style="background: #fff; border-radius: 10px" @endif href="{{ route('questions') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='questions') active @endif ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-2xl">
                                                          <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='questions') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='questions') text-primary @endif font-size-h6 mb-0">
                                                    Questions
                                                    </span>
                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>

                                <li hidden class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='groups') style="background: #fff; border-radius: 10px" @endif href="{{ route('groups') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='groups') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                <span class="symbol-label  ">
                                                    <span class="svg-icon svg-icon-2xl">
                                                      <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='groups') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='groups') text-primary @endif font-size-h6 mb-0">
                                                Groups
                                                </span>
                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                                <li hidden class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='events') style="background: #fff; border-radius: 10px" @endif href="{{ route('events') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='events') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                <span class="symbol-label  ">
                                                    <span class="svg-icon svg-icon-2xl">
                                                      <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='events') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='events') text-primary @endif font-size-h6 mb-0">
                                                Events
                                                </span>
                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                                <li hidden class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='restaurants') style="background: #fff; border-radius: 10px" @endif href="{{ route('restaurants') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='restaurants') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                <span class="symbol-label  ">
                                                    <span class="svg-icon svg-icon-2xl">
                                                      <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='restaurants') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='restaurants') text-primary @endif font-size-h6 mb-0">
                                                Restaurants
                                                </span>
                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                                <li hidden class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='upcoming_dates') style="background: #fff; border-radius: 10px" @endif href="{{ route('upcoming_dates') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='upcoming_dates') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-2xl">
                                                          <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='upcoming_dates') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='upcoming_dates') text-primary @endif font-size-h6 mb-0">
                                                    Upcoming Dates
                                                    </span>
                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                                <li hidden class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='contact_reports') style="background: #fff; border-radius: 10px" @endif href="{{ route('contact_reports') }}" class="text-muted text-hover-primary font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='contact_reports') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-2xl">
                                                          <i style="font-size: 1.7rem"  class=" @if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='contact_reports') text-primary  @endif icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="@if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='contact_reports') text-primary @endif font-size-h6 mb-0">
                                                    Contact Reports
                                                    </span>
                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                            </ul>
                            <!--end::Menu Nav-->
                        </div>
                        <!--end::Menu Container-->
                    </div>
                    <!--end::Aside Menu-->
                </div>

                <!--end::Tab Pane-->

            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Workspace-->

        <div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-4 py-lg-10">
            <!--begin::Aside Toggle-->
            <span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Toggle Aside">
                <i class="ki ki-bold-arrow-back icon-sm"></i>
            </span>
        </div>

    </div>
    <!--end::Secondary-->
</div>

