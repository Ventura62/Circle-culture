@extends('layouts.master')

@section('styles')

    <style>
        .table.table-head-custom thead tr, .table.table-head-custom thead th{

            white-space: nowrap;
        }
    </style>

@endsection
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 style="color: #3a384e"  class="d-flex align-items-center font-weight-bolder my-1 mr-3">Groups</h2>
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
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Advance Table Widget 1-->
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
            <div class="card card-custom gutter-b">
                <!--begin::Header-->

                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Groups</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        {{--<a href="#" class="btn btn-success font-weight-bolder font-size-sm mr-2" data-toggle="modal" data-target="#add_item" >--}}
                            {{--<span class="svg-icon svg-icon-md svg-icon-white">--}}
                                {{--<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->--}}
                                {{--<i class="flaticon2-add-1  text-white"></i>--}}
                                {{--<!--end::Svg Icon-->--}}
                            {{--</span>Add New--}}
                        {{--</a>--}}

                        <a href="#" class="btn btn-success font-weight-bolder font-size-sm mr-2" data-toggle="modal" data-target="#import_item" >
                            <span class="svg-icon svg-icon-md svg-icon-white">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                <i class="flaticon2-add-1  text-white"></i>
                                <!--end::Svg Icon-->
                            </span>Import
                        </a>


                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                            <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Export</button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>

                                    <li class="navi-item">
                                        <a  href="{{ route('group.export') }}" class="navi-link">
                                            <span class="navi-icon"><i class="la la-file-text-o"></i></span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>

                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                    </div>
                </div>



                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-0">
                    <!--begin::Table-->

                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-9 col-xl-8">
                                <div class="row align-items-center">
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input type="text" data-table="order-table" class="form-control light-table-filter" placeholder="Search..." id="kt_datatable_search_query" />
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center order-table kt_datatable exportTable" id="kt_advance_table_widget_1">
                            <thead>
                            <tr class="text-left">
                                <th style="min-width: 150px">Name</th>
                                <th style="min-width: 150px">Event Name</th>
                                <th style="min-width: 150px">Users</th>
                                <th style="min-width: 150px">Activities</th>
                                <th style="min-width: 150px">Preferred Topics</th>
                                <th style="min-width: 150px">Meet in</th>
                                <th style="min-width: 150px">Location</th>
                                <th style="min-width: 150px">Table Number</th>
                                <th style="min-width: 150px">Restaurant</th>
                                <th class="" style="min-width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $row)
                            <tr>

                                <td >
                                    <span class="text-muted  font-weight-bold">{{ $row['name']   }}  </span>
                                </td>

                                <td >
                                    <a href="{{ route('event.show' , $row['id']) }}" class="text-primary  font-weight-bold">{{ $row->event->name ?? ''  }}  </a>
                                </td>

                                <td >
                                    @php $users = json_decode($row['users'] ,true);   @endphp
                                    @foreach($users as $user)
                                        <span class="label label-lg label-primary label-inline mb-1"> {{ $user }} </span>

                                    @endforeach
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold">{{ $row['activities']   }}  </span>
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold">{{ $row['topics']   }}  </span>
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold">{{ $row['meet_in']   }}  </span>
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold">{{ $row->restaurant->location ?? ''   }}  </span>
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold">{{ $row['table_number']   }}  </span>
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold">{{ $row->restaurant->name ?? ''   }}  </span>
                                </td>

                                <td>
                                    {{--<a href="#" data-toggle="modal" data-target="#edit_item-{{ $row['id'] }}"  class="btn btn-icon btn-light btn-hover-primary btn-sm">--}}
                                        {{--<span class="svg-icon svg-icon-md svg-icon-primary">--}}
                                            {{--<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->--}}
                                            {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                                                {{--<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                                                    {{--<rect x="0" y="0" width="24" height="24" />--}}
                                                    {{--<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />--}}
                                                    {{--<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
                                                {{--</g>--}}
                                            {{--</svg>--}}
                                            {{--<!--end::Svg Icon-->--}}
                                        {{--</span>--}}
                                    {{--</a>--}}

                                    <a href="#" data-toggle="modal" data-target="#delete_record_modal" data-action="{{ route('group.delete' , $row->id) }}" data-id="{{ $row->id }}" class="open_delete_modal btn btn-icon btn-light btn-hover-primary btn-sm">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            <!--end::Svg Icon-->
                                            </span>
                                    </a >
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 1-->
            {{ $data->links("pagination::bootstrap-4") }}
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

    <div class="modal fade" id="import_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Import Groups  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::Form-->
                    <form class="form" method="POST" action="{{ route('group.import') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="text"  hidden class="form-control" name="id" value="0" />

                        <div class="card-body">
                            <!--begin: Code-->
                            <!--end: Code-->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label ">File:</label>
                                <div class="col-lg-8">
                                    <input type="file" class="form-control" name="file"  required />
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Add New  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::Form-->
                    <form class="form" method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="text"  hidden class="form-control" name="id" value="0" />

                        <div class="card-body">
                            <!--begin: Code-->
                            <!--end: Code-->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-right">Name:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name Here"  required />
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>

            </div>

        </div>
    </div>

    @foreach($data as $row)
        <div class="modal fade" id="edit_item-{{ $row['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->

                        <form class="form" method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="text"  hidden class="form-control" name="id" value="{{ $row['id'] }}" />

                            <div class="card-body">
                                <!--begin: Code-->
                                <!--end: Code-->
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label text-right">Name:</label>
                                    <div class="col-lg-8">
                                        <input disabled type="text" class="form-control" name="name" placeholder="Enter Name Here" value="{{ $row['name'] }}"  required />
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>

                        </form>
                        <!--end::Form-->
                    </div>

                </div>
            </div>
        </div>
    @endforeach


@endsection

@section('scripts')


    <script>
        $('#kt_repeater_1').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo',
                'select': 'foo'
            },

            show: function () {
                $(this).slideToggle();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });


        $("#addQuestion").click(function(){

            $("#questionsList").append('');

        });

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            var controlForm = $(this).closest('.fvrduplicate'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-light-danger')

                .html(' <i class="la la-trash-o"></i>');
        }).on('click', '.btn-remove', function(e) {
            $(this).closest('.entry').remove();
            return false;
        });

        $(document).on('click', '.btn-add-qa', function(e) {
            e.preventDefault();
            var controlForm = $(this).closest('.fvrduplicate-qa'),
                currentEntry = $(this).parents('.entry-qa:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('input').val('');
                newEntry.find('textarea').val('');

                controlForm.find('.entry-qa:not(:last) .btn-add-qa')
                    .removeClass('btn-add-qa').addClass('btn-remove-qa')
                .removeClass('btn-success').addClass('btn-light-danger')

                .html(' <i class="la la-trash-o"></i>');
        }).on('click', '.btn-remove-qa', function(e) {
            $(this).closest('.entry-qa').remove();
            return false;
        });

        $(document).on('click', '.btn-add-qch', function(e) {
            e.preventDefault();
            var controlForm = $(this).closest('.fvrduplicate-qch'),
                currentEntry = $(this).parents('.entry-qch:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('input').val('');
                newEntry.find('textarea').val('');

                controlForm.find('.entry-qch:not(:last) .btn-add-qch')
                    .removeClass('btn-add-qch').addClass('btn-remove-qch')
                .removeClass('btn-success').addClass('btn-light-danger')

                .html(' <i class="la la-trash-o"></i>');
        }).on('click', '.btn-remove-qch', function(e) {
            $(this).closest('.entry-qch').remove();
            return false;
        });

    </script>

@endsection