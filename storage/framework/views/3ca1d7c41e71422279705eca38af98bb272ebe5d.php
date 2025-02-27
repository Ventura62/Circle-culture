<?php $__env->startSection('styles'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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

            <?php echo $__env->make('layouts.profile_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="container">
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
        <div class="row">
            <div class="col-xl-12 mt-5">

                <div class="col-xxl-12">
                    <div class="gutter-b">
                        <!--begin::Header-->
                        <!--end::Header-->
                        <?php if(auth()->user()->type == "client"): ?>
                        <div class="alert-text">

                            Access your google drive folder

                            <input readonly="" required="" style="width: 100%" type="text" class="mt-4 form-control form-control domain" value="https://drive.google.com/drive/u/1/folders/<?php echo e(auth()->user()->drive_folder_id); ?>">

                        </div>
                        <?php if(isset(auth()->user()->receipt_number)): ?>
                            <div class="alert-text mt-5" >

                                Your Receipt Number
                                <input readonly="" required="" style="width: 100%" type="text" class="mt-4 form-control form-control domain" value="<?php echo e(auth()->user()->receipt_number); ?>">

                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
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
                                         <?php if(auth()->user()->type == 'admin'): ?>
                                                <?php echo e(DB::table('submissions')->get()->count()); ?>

                                            <?php else: ?>
                                                <?php echo e(DB::table('submissions')->where('user_id' , auth()->user()->id)->get()->count()); ?>

                                            <?php endif; ?>
                                             Requests</a>
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
<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\picAi\resources\views/dashboard/index.blade.php ENDPATH**/ ?>