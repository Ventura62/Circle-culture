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
                    <h2 style="color: #3a384e"  class="d-flex align-items-center font-weight-bolder my-1 mr-3">Circles</h2>
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
                        <span class="card-label font-weight-bolder text-dark">Circles</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-success font-weight-bolder font-size-sm mr-2" data-toggle="modal" data-target="#add_item" >
                            <span class="svg-icon svg-icon-md svg-icon-white">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                <i class="flaticon2-add-1  text-white"></i>
                                <!--end::Svg Icon-->
                            </span>Add New
                        </a>


                        
                        
                            
                                
                                    
                                    
                                        
                                            
                                            
                                            
                                        
                                    
                                    
                                
                            
                            
                                
                                
                                    

                                    
                                        
                                            
                                                
                                            
                                            
                                        
                                    
                                
                                
                            
                            
                        
                        
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
                        <table class="table table-head-custom table-vertical-center order-table kt_datatable" id="kt_advance_table_widget_1">
                            <thead>
                            <tr class="text-left">
                                <th style="min-width: 150px">id</th>
                                <th style="min-width: 150px">Created by</th>
                                <th style="min-width: 150px">Name</th>
                                <th style="min-width: 150px">Cover</th>
                                <th style="min-width: 150px">Short description</th>
                                <th style="min-width: 150px">Long Description</th>
                                <th style="min-width: 150px">Status</th>

                                <th class="" style="min-width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td >
                                    <span class="text-muted  font-weight-bold"><?php echo e($row->id); ?>  </span>
                                </td>
                                <td >
                                    <span class="text-muted  font-weight-bold"><?php echo e($row->user->name); ?>  </span>
                                </td>

                                <td >
                                    <img  width="50%" src="<?php echo e(asset($row->image)); ?>"/>
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold"><?php echo e($row['name']); ?>  </span>
                                </td>


                                <td >
                                    <span class="text-muted  font-weight-bold"><?php echo e($row['short_description']); ?>  </span>
                                </td>

                                <td >
                                    <span class="text-muted  font-weight-bold"><?php echo e($row['long_description']); ?>  </span>
                                </td>


                                <td >
                                    <span class="text-muted  font-weight-bold"><?php echo e($row['status']); ?>  </span>
                                </td>

                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit_item-<?php echo e($row['id']); ?>"  class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </a>

                                    <a href="#" data-toggle="modal" data-target="#delete_record_modal" data-action="<?php echo e(route('circle.delete' , $row->id)); ?>" data-id="<?php echo e($row->id); ?>" class="open_delete_modal btn btn-icon btn-light btn-hover-primary btn-sm">
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


        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

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
                    <form class="form" method="POST" action="<?php echo e(route('circle.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <input type="text"  hidden class="form-control" name="id" value="0" />

                        <div class="card-body">
                            <!--begin: Code-->
                            <!--end: Code-->
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Name:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="name" value=""  required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Cover:</label>
                                <div class="col-lg-8">
                                    <input type="file" class="form-control" name="image"  required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Status:</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="status">
                                        <option  selected >active</option>
                                        <option >pending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Short Description:</label>
                                <div class="col-lg-8">
                                    <textarea rows="5" required  class="form-control" name="short_description" ></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Long Description:</label>
                                <div class="col-lg-8">
                                    <textarea rows="5" required class="form-control" name="long_description" ></textarea>
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

    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="edit_item-<?php echo e($row['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
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

                        <form class="form" method="POST" action="<?php echo e(route('circle.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <input type="text"  hidden class="form-control" name="id" value="<?php echo e($row['id']); ?>" />

                            <div class="card-body">
                                <!--begin: Code-->
                                <!--end: Code-->
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Name:</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="name" value="<?php echo e($row['name']); ?>"  required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Cover:</label>
                                    <div class="col-lg-8">
                                        <input type="file" class="form-control" name="image" value=""  />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Status:</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="status">
                                            <option <?php if($row['status'] == "active"): ?> selected <?php endif; ?> >active</option>
                                            <option <?php if($row['status'] == "pending"): ?> selected <?php endif; ?> >pending</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Short Description:</label>
                                    <div class="col-lg-8">
                                        <textarea rows="5"  class="form-control" name="short_description" ><?php echo e($row['short_description']); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Long Description:</label>
                                    <div class="col-lg-8">
                                        <textarea rows="5"  class="form-control" name="long_description" ><?php echo e($row['long_description']); ?></textarea>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/dashboard/circles.blade.php ENDPATH**/ ?>