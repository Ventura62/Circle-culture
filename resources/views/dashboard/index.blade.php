@extends('layouts.master')

@section('styles')
    <style>

        .datatable-head  .datatable-cell span{
            text-transform: uppercase;
            color: #B5B5C3 !important;
        }

        .datatable.datatable-default > .datatable-table > .datatable-head .datatable-row >
        .datatable-cell.datatable-cell-sort, .datatable.datatable-default > .datatable-table >
        .datatable-body .datatable-row > .datatable-cell.datatable-cell-sort, .datatable.datatable-default >
        .datatable-table > .datatable-foot .datatable-row > .datatable-cell.datatable-cell-sort
        {

            white-space: nowrap;
        }
        .datatable.datatable-default > .datatable-table{

            overflow-x: scroll;

        }

        .card-custom{
            transition: all 0.3s ease;  ;
        }
    </style>
@endsection
@section('content')
    <!--begin::Subheader-->
    <div class="container subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 style="color: #3a384e" class="d-flex align-items-center  font-weight-bolder my-1 mr-3">
                        Dashboard</h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin::Button-->

            @include('layouts.profile_button')

            <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="container">
        <div class="h3 text-center">

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger" role="alert">
                        <strong style="font-size: 13px; font-weight: 400;">{{ $error }}</strong><br>
                    </span>
                @endforeach
            @endif
            @include('flash::message')
        </div>
        <br>
        <div class="row">
            <div class="col-xl-12 mt-5">

                <div class="col-xxl-12">
                    <div class="gutter-b">
                        <!--begin::Header-->
                        <!--end::Header-->

                        <!--begin::Body-->


                        <div class="card-body p-0 position-relative overflow-hidden">
                            <!--begin::Chart-->
                            <div id="" class="" style="height: 100px"></div>
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="mt-n25">
                                <!--begin::Row-->
                                <div class="row m-0">

                                    <div class="text-center col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                            <span class="svg-icon svg-icon-3x svg-icon-dark d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                <i class="icon-3x text-dark-50 flaticon2-list-1"></i>                                                <!--end::Svg Icon-->
                                            </span>
                                        <a href="#" class="text-dark font-weight-bolder font-size-h2">
                                            {{ DB::table('circles')->get()->count() }} Circles
                                        </a>
                                    </div>


                                </div>
                            </div>

                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--end::Entry-->
@endsection



@section('scripts')

@endsection