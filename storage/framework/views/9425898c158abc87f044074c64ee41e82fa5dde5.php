<?php $__env->startSection('styles'); ?>

    <style>
        .table.table-head-custom thead tr, .table.table-head-custom thead th{

            white-space: nowrap;
        }
    </style>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!--begin::Subheader-->
    <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 style="color: #3a384e"  class="d-flex align-items-center font-weight-bolder my-1 mr-3">Submissions</h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin::Button-->
            <?php echo $__env->make('layouts.profile_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

                <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-danger" role="alert">
                        <strong style="font-size: 13px; font-weight: 400;"><?php echo e($error); ?></strong><br>
                    </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <br>
            <div class="card card-custom gutter-b">
                <!--begin::Header-->

                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Submissions</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">

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

                                        <div class="input-icon  mt-4">
                                            <label>Find by date time</label>
                                            <form  method="GET" action="<?php echo e(route('search')); ?>">
                                                <input style="padding-left: 10px" type="date"  name="search_date" class="search_date form-control" value="<?php echo e(isset($query) ? $query : null); ?>" >
                                                <br>
                                                <select style="padding-left: 10px" class="form-control" name="filter_time" >
                                                    <option >12PM</option>
                                                    <option >2PM</option>
                                                    <option >4PM</option>
                                                    <option >6PM</option>
                                                    <option >8PM</option>
                                                    <option >10PM</option>
                                                </select>

                                                <br>
                                                <button type="submit"  class="btn btn-primary mr-2" >Search</button>
                                            </form>

                                        </div>

                                        <div class="input-icon  mt-4">
                                            <label>Find by Guest number</label>
                                            <form  method="GET" action="<?php echo e(route('search.number')); ?>">
                                                <input style="padding-left: 10px" type="text"  name="guest_number" class="form-control" value="<?php echo e(isset($query) ? $query : null); ?>" >
                                                <br>
                                                <button type="submit"  class="btn btn-primary mr-2" >Find</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center order-table kt_datatable" id="kt_advance_table_widget_1">
                            <thead>
                            <tr class="text-left">
                                <th style="min-width: 50px">#</th>
                                <th style="min-width: 150px">User</th>
                                <th style="min-width: 350px">Data</th>
                                
                                
                                <th class="" style="min-width: 150px">Images</th>
                                <th class="" style="max-width: 150px">Guest </th>
                                <?php if(auth()->user()->type == 'admin'): ?>
                                <th class="" style="max-width: 150px"> Contractor </th>
                                <?php endif; ?>
                                <th class="" style="min-width: 150px">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><span class="text-muted text-capitalize font-weight-bold"><?php echo e($data->firstItem()+$key); ?>  </span></td>

                                    <td><span class="text-muted text-capitalize font-weight-bold"><?php echo e(isset($row->user->email ) ? $row->user->email  : ''); ?>  </span></td>

                                    <td><span class="text-capitalize font-weight-bold">

                                          <?php
                                            $formData = json_decode($row->data, true);
                                            ?>

                                            <?php $__currentLoopData = $formData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $formDatum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $field = DB::table('fields')->where('id', $key)->first(); ?>

                                                <?php if($field): ?>
                                                    <h6 class="font-weight-bold"><?php echo e($field->label); ?></h6>
                                                    <span class="text-muted"><?php echo e($formDatum); ?></span>

                                                    <br>
                                                    <br>
                                                <?php endif; ?>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                    </td>


                                    
                                        
                                            
                                                
                                                    
                                                

                                            
                                        
                                            
                                                
                                                
                                                
                                                
                                                
                                            
                                            
                                        
                                    


                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#images_modal-<?php echo e($row['id']); ?>"  class=" btn-hover-primary btn-sm">
                                            <?php echo e($row->images->count()); ?> Images

                                        </a>

                                    </td>

                                    <td >

                                        <?php if(auth()->user()->type == 'client'): ?>
                                            <a target="_blank" href="https://drive.google.com/drive/u/1/folders/<?php echo e(auth()->user()->drive_folder_id); ?>">
                                                <i class="fa fa-folder"></i>
                                            </a>


                                        <?php else: ?>
                                            <a target="_blank" href="<?php echo e($row->folder_drive_path); ?>">
                                              <i class="fa fa-folder"></i>
                                            </a>

                                        <?php endif; ?>



                                    </td>

                                    <?php if(auth()->user()->type == 'admin'): ?>

                                    <td >
                                            <?php if(isset($row->user)): ?>
                                            <a target="_blank" href="https://drive.google.com/drive/u/1/folders/<?php echo e($row->user->drive_folder_id_contractor); ?>">
                                                <i class="fa fa-folder-open"></i>
                                            </a>
                                            <?php endif; ?>

                                    </td>
                                    <?php endif; ?>



                                    <td>

                                        <a href="<?php echo e(route('submission.download' , $row['id'])); ?>" class="open_delete_modal btn btn-icon btn-light btn-hover-primary btn-sm">

                                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <i class="icon-x text-dark-50 flaticon-download"></i>
                                            <!--end::Svg Icon-->
                                            </span>
                                        </a >

                                        <a href="#" data-toggle="modal" data-target="#delete_record_modal" data-action="<?php echo e(route('submission.delete' , $row->id)); ?>" data-id="<?php echo e($row->id); ?>" class="open_delete_modal btn btn-icon btn-light btn-hover-primary btn-sm">
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 1-->
            <?php echo e($data->links("pagination::bootstrap-4")); ?>


        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->


    <div class="modal fade" id="make_slideshow" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title summary_title" id="exampleModalLabel"> Upload Images for slideshow here  </h6>
                    <span class="modal-title summary_span" id="exampleModalLabel">   </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::Form-->
                    <div class=" summary_content">

                        <form id="uploadForm" class="form" method="POST" action="<?php echo e(route('generate')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">

                                <div class="row form-group">

                                    <input hidden  type="text" multiple class="form-control form-control form-control-solid id_input " name="id" value="">

                                    <div class="col-12 col-md-12 ">
                                        <br>
                                        <label class=" form-control-label">Choose Images</label>
                                        <input required  id="fileInput"  type="file" multiple class="form-control form-control form-control-solid " name="images[]" value="">
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer">
                                <button id="generateBtn"  data-id="" class="btn btn-primary mr-2" >Generate</button>
                            </div>
                        </form>
                    </div>

                    <!--end::Form-->
                </div>

            </div>

        </div>
    </div>


    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="view_data-<?php echo e($row['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title summary_title" id="exampleModalLabel"> User Submission Data  </h6>
                        <span class="modal-title summary_span" id="exampleModalLabel">   </span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <div class=" summary_content">
                            <?php
                            $formData = json_decode($row->data, true);
                            ?>

                            <?php $__currentLoopData = $formData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $formDatum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $field = DB::table('fields')->where('id', $key)->first(); ?>

                                <?php if($field): ?>
                                    <h6><?php echo e($field->label); ?></h6>
                                    <span><?php echo e($formDatum); ?></span>

                                    <br>
                                    <br>
                                <?php endif; ?>


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!--end::Form-->
                    </div>

                </div>

            </div>
        </div>

        <div class="modal fade" id="images_modal-<?php echo e($row['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title summary_title" id="exampleModalLabel"> View Images  </h6>
                        <span class="modal-title summary_span" id="exampleModalLabel">   </span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->
                        <?php $__currentLoopData = $row->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img style="width: 200px" src="<?php echo e(asset($image['path'])); ?> ">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--end::Form-->
                    </div>

                </div>

            </div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>

        $("body").on('click', '.make_slideshow', function () {
            var id = $(this).data('id');
            $('#generateBtn').attr('data-id', id); // Update the data-id attribute of #generateBtn
        });


        $('body').on("click", "#generateBtn", function () {
            var id         = $(this).data('id');

            var fileInput = $('#fileInput')[0];

            if (fileInput.files.length === 0) {
                Swal.fire({
                    text: "Please select at least one file before submitting.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "OK!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light"
                    }
                }).then(function () {

                });
                return;
            }

            $('#generateBtn').html('<div class="spinner spinner-lg spinner-dark spinner-center p-4"></div>');

            $('#uploadForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData();

                $.each(fileInput.files, function(index, file) {
                    formData.append('images[]', file);
                });

                formData.append('_token', "<?php echo csrf_token(); ?>");
                formData.append('id', id);

                $.ajax({
                    url: "<?php echo e(route('generate')); ?>",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.message === 'SUCCESS') {
                            $('#generateBtn').html('Generate');
                            Swal.fire({
                                text: "Slideshow Created Successfully " + response.id,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Confirm",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light"
                                }
                            }).then(function () {
                                window.location.href = "";
                            });

                        }else {
                            alert(response.message)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\picAi\resources\views/dashboard/submissions.blade.php ENDPATH**/ ?>