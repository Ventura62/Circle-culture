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
                    <h2 style="color: #3a384e"  class="d-flex align-items-center font-weight-bolder my-1 mr-3">Templates</h2>
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
                        <span class="card-label font-weight-bolder text-dark">Templates</span>
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
                                <th style="min-width: 50px">#</th>
                                <th style="min-width: 150px">Name</th>
                                <th style="min-width: 150px">Instructions</th>
                                <th style="min-width: 150px">Submissions</th>
                                <th style="min-width: 150px">View Template</th>
                                <th class="" style="min-width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><span class="text-muted text-capitalize font-weight-bold"><?php echo e($data->firstItem()+$key); ?>  </span></td>

                                    <td >
                                        <a href="<?php echo e(route('template.fields' , $row['id'])); ?>"  >
                                            <?php echo e($row['name']); ?>

                                        </a>
                                    </td>

                                    <td >
                                       <span class="text-muted"><?php echo $row['instructions']; ?></span>
                                    </td>

                                    <td >
                                        <a href="<?php echo e(route('template.submissions' , $row['id'])); ?>"  >
                                            View Submissions
                                        </a>
                                    </td>


                                    <td >
                                        <a href="<?php echo e(url('/?id='. $row['id'])); ?>"  >
                                            View Template
                                        </a>
                                    </td>


                                    <td>

                                        <a href="<?php echo e(route('template.clone' , $row['id'])); ?>"   class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <i class="flaticon2-copy"></i>
                                             <!--end::Svg Icon-->
                                            </span>
                                        </a>


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

                                        <a href="#" data-toggle="modal" data-target="#delete_record_modal" data-action="<?php echo e(route('template.delete' , $row->id)); ?>" data-id="<?php echo e($row->id); ?>" class="open_delete_modal btn btn-icon btn-light btn-hover-primary btn-sm">
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



    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Add New  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::Form-->
                    <form class="form" method="POST" action="<?php echo e(route('template.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <input type="text"  hidden class="form-control" name="id" value="0" />

                        <div class="card-body">
                            <!--begin: Code-->
                            <!--end: Code-->

                            <div class="col-12 col-md-12">
                                <br>
                                <label class=" form-control-label">Name</label>
                                <input class="form-control" name="name" required >
                            </div>

                            <div class="col-12 col-md-12">
                                <br>
                                <label class=" form-control-label">Instructions</label>

                                <textarea rows="5" class="form-control" name="instructions"></textarea>
                            </div>

                            <div class="col-12 col-md-12">
                                <br>
                                <label class="form-control-label">Enable Template</label>

                                <select class="form-control" name="enable_email">
                                    <option value="">Please Select</option>
                                    <option value="1">enable</option>
                                    <option value="0">disable</option>
                                </select>
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
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--begin::Form-->

                        <div class="modal-body">
                            <!--begin::Form-->
                            <form class="form" method="POST" action="<?php echo e(route('template.store')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <input type="text"  hidden class="form-control" name="id" value="<?php echo e($row['id']); ?>" />

                                <div class="card-body">
                                    <!--begin: Code-->
                                    <div class="col-12 col-md-12">
                                        <br>
                                        <label class=" col-form-label text-right">Name:</label>
                                        <input class="form-control" name="name" value="<?php echo e($row['name']); ?>" required >
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <br>
                                        <label  class=" form-control-label">Name</label>

                                    <textarea rows="5" class="form-control" name="instructions"><?php echo e($row['instructions']); ?></textarea>


                                    </div>

                                    <div class="col-12 col-md-12">
                                        <br>
                                        <label class="form-control-label">Enable Template</label>

                                        <select class="form-control" name="enable_email">
                                            <option value="">Please Select</option>
                                            <option <?php if($row['enable_email']): ?> selected <?php endif; ?> value="1">enable</option>
                                            <option <?php if(!$row['enable_email']): ?> selected <?php endif; ?> value="0">disable</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <br>
                                        <label class="form-control-label">Email Template</label>

                                        <textarea rows="8" class="form-control" name="email_template"><?php echo e($row['email_template']); ?></textarea>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Form-->
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\picAi\resources\views/dashboard/templates.blade.php ENDPATH**/ ?>