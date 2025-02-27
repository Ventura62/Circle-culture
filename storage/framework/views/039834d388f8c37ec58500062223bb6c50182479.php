<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />


    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?php echo e(asset('backend/plugins/custom/uppy/uppy.bundle.css')); ?>" rel="stylesheet" type="text/css" />

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

        <?php if(request()->segment(1) == null): ?>
        .aside-secondary-enabled.aside-fixed .wrapper {
            padding-left: 0 !important;
        }
        <?php endif; ?>


        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            /*padding: 5px;*/
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            /*background-color: #4045ba;*/
            /*border-color: #4045ba;*/
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }
        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all 0.3s ease;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }
        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }
        .upload__img-close:after {
            content: "✖";
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }


        @media (min-width: 992px){

            img{
                width: 30% !important;
            }

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
                        <?php echo e($template_name); ?></h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin::Button-->

                <?php if(auth()->guard()->check()): ?>
            <?php echo $__env->make('layouts.profile_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="container">
        <br>
        <br>

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
        <div class="row col-xl-12 ">
            <div class="col-xl-12 mt-5" style="margin: auto">
                <div class="col-xxl-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">
                                Submit your request
                            </h3>

                        </div>
                        <!--begin::Form-->
                        <form id="uploadForm" class="form" method="POST" action="<?php echo e(route('submission.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">

                                <input type="hidden" class="form-control" value="<?php echo e($template_id); ?>" name="template_id" >

                                <div class="form-group mb-8">
                                    <div class="alert alert-custom alert-default" role="alert">
                                        <div class="alert-icon"><span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:/metronic/theme/html/demo3/dist/assets/media/svg/icons/Tools/Compass.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
        <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg><!--end::Svg Icon--></span></div>
                                        <div class="alert-text" style="white-space: break-spaces;"><?php echo $instructions; ?></div>
                                    </div>
                                </div>

                                <?php $__currentLoopData = $form_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($field['type'] === 'text'): ?>
                                        <div class="form-group">
                                            <label><?php echo e($field['label']); ?></label>
                                            <input type="text" class="form-control <?php echo e($field['class_name']); ?>" name="<?php echo e($field['id']); ?>" value="" placeholder="<?php echo e($field['name']); ?>" <?php if($field['is_required']): ?> required <?php endif; ?>>
                                        </div>
                                    <?php elseif($field['type'] === 'receipt'): ?>
                                    <div class="form-group">
                                        <label><?php echo e($field['label']); ?></label>
                                        <input type="text" class="form-control <?php echo e($field['class_name']); ?>" name="receipt" value="" placeholder="receipt number" <?php if($field['is_required']): ?> required <?php endif; ?>>
                                    </div>
                                    <?php elseif($field['type'] === 'number'): ?>
                                        <div class="form-group">
                                            <label><?php echo e($field['label']); ?></label>
                                            <input type="number" class="form-control <?php echo e($field['class_name']); ?>" name="<?php echo e($field['id']); ?>" value="" placeholder="<?php echo e($field['name']); ?>" <?php if($field['is_required']): ?> required <?php endif; ?>>
                                        </div>
                                    <?php elseif($field['type'] === 'date'): ?>
                                        <div class="form-group">
                                            <label><?php echo e($field['label']); ?></label>
                                            <input type="date" class="form-control <?php echo e($field['class_name']); ?>" name="<?php echo e($field['id']); ?>" value="" placeholder="<?php echo e($field['name']); ?>" <?php if($field['is_required']): ?> required <?php endif; ?>>
                                        </div>
                                    <?php elseif($field['type'] === 'textarea'): ?>
                                        <div class="form-group">
                                            <label><?php echo e($field['label']); ?></label>
                                            <textarea rows="5" name="<?php echo e($field['id']); ?> " class="form-control <?php echo e($field['class_name']); ?>"></textarea>
                                        </div>
                                    <?php elseif($field['type'] === 'list'): ?>
                                        <div class="form-group">
                                            <label><?php echo e($field['label']); ?></label>
                                            <?php  $values = explode(',' , $field['predefined_value']) ?>
                                            <select class="form-control <?php echo e($field['class_name']); ?>" name="<?php echo e($field['id']); ?>" <?php if($field['is_required']): ?> required <?php endif; ?>>
                                                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    <?php elseif($field['type'] === 'checkbox'): ?>
                                        <div class="form-group">

                                            <label class="checkbox">
                                                <input type="checkbox" class="<?php echo e($field['class_name']); ?>" name="<?php echo e($field['id']); ?>" <?php if($field['is_required']): ?> required <?php endif; ?> >
                                                <span class="mr-4"></span>
                                                <?php echo e($field['label']); ?>

                                            </label>

                                        </div>

                                    <?php elseif($field['type'] === 'file'): ?>
                                        <div class="form-group">
                                            <label><?php echo e($field['label']); ?></label>
                                            
                                            <div class="upload__box">
                                                <div class="upload__btn-box">
                                                    <label class="upload__btn btn">
                                                        <p style="margin: 0">Choose File(image/video)</p>
                                                        <input id="fileInput" type="file" accept=".jpg , .jpeg , .jfif , .pjpeg , .pjp , .png , .svg , .webp, .mp4, .mov" multiple="" name="images[]" data-max_length="200" class="upload__inputfile">
                                                    </label>
                                                </div>
                                                <div class="upload__img-wrap"></div>
                                            </div>
                                            <div class="upload__img-wrap"></div>
                                        </div>
                                    <?php elseif($field['type'] === 'instruction'): ?>
                                        <div class="form-group">
                                            <h5><?php echo e($field['label']); ?></h5>
                                            

                                            <?php if($field['predefined_value']): ?>
                                            <br>
                                            <img style="width:100%" src="<?php echo e(asset($field['predefined_value'])); ?>">
                                                <?php endif; ?>
                                        </div>

                                    <?php elseif($field['type'] === 'drive_link' && isset(auth()->user()->id)): ?>
                                        <div class="form-group">
                                            <h5><?php echo e($field['label']); ?></h5>
                                            

                                           <a target="_blank" href="https://drive.google.com/drive/u/1/folders/<?php echo e(auth()->user()->drive_folder_id); ?>">Google Drive Folder</a>
                                        </div>
                                    <?php endif; ?>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="form-group">
                                    <label> Referral museum id (Optional) </label>
                                    <input type="text" class="form-control" name="ref_id" value="" placeholder="">
                                </div>

                                

                                
                                    
                                    
                                    

                                    
                                           
                                           
                                           
                                           
                                           
                                    
                                        
                                            
                                                
                                                
                                            
                                        
                                        
                                    
                                
                                

                            </div>
                            <div class="card-footer">
                                <button id="submitBtn" type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>

                    <?php if($enable_email): ?>
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">
                                Your email template
                            </h3>

                        </div>
                        <!--begin::Form-->
                        <div class="card-body">


                            <div class="form-group">
                                <div class="form-group row">
                                    <textarea class="form-control email_template_area" id="kt_clipboard_2"  rows="6"><?php echo e($email_template); ?></textarea>
                                    <div class="mt-4"></div>
                                    <a href="#" class="btn btn-secondary mt-5" data-clipboard="true" data-clipboard-target="#kt_clipboard_2"><i class="la la-clipboard"></i> Copy to clipboard</a>
                                </div>
                            </div>

                        </div>

                        <!--end::Form-->
                    </div>
                    <!--end::Advance Table Widget 1-->
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <!--end::Entry-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('backend/js/pages/crud/forms/widgets/clipboard.js?v=7.2.9')); ?>"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

    <script>
        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = []; // Global array to store the uploaded files

            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    // Clear the global array and the displayed images when a new selection is made
                    imgArray = [];
                    imgWrap.empty(); // Reset the image display area

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);

                    filesArr.forEach(function (f) {
                        // Check if the file is an image or a video
                        if (!f.type.match('image.*') && !f.type.match('video.*')) {
                            return;
                        }

                        // Prevent adding more files than maxLength
                        if (imgArray.length >= maxLength) {
                            return false;
                        }

                        // Add the file to the array and display it
                        imgArray.push(f);

                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var html = "";

                            // If the file is an image
                            if (f.type.match('image.*')) {
                                html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                            }

                            // If the file is a video
                            if (f.type.match('video.*')) {
                                html = "<div class='upload__img-box'><div data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><video width='100%' controls><source src='" + e.target.result + "' type='" + f.type + "'></video><div class='upload__img-close'></div></div></div>";
                            }

                            imgWrap.append(html); // Append the new file to the DOM
                        };

                        reader.readAsDataURL(f); // Read file as data URL for both images and videos
                    });

                });
            });

            // Remove file and its representation when the close button is clicked
            $('body').on('click', ".upload__img-close", function (e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1); // Remove file from the global array
                        break;
                    }
                }
                $(this).parent().parent().remove(); // Remove the corresponding element from the DOM
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('body').on("click" , "#submitBtn" , function () {
                $('#submitBtn').html(' <div class="spinner spinner-lg spinner-dark spinner-center p-4"></div>');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Store the text area element for easy access
            var emailTextArea = $('.email_template_area');

            // Store the original template
            var originalTemplate = emailTextArea.val();

            // Function to update the email template based on class changes
            function updateEmailTemplate() {
                var personName = $('.person_name').val();
                var showDate = $('.show_date').val();
                var showTime = $('.show_time').val();

                // Replace the placeholders with the input values in the original template
                var emailContent = originalTemplate;
                if (personName) {
                    emailContent = emailContent.replace(/PERSON_NAME/g, personName);
                }
                if (showDate) {
                    emailContent = emailContent.replace(/SHOW_DATE/g, showDate);
                }
                if (showTime) {
                    emailContent = emailContent.replace(/SHOW_TIME/g, showTime);
                }

                // Update the text area content
                emailTextArea.val(emailContent);
            }

            // Trigger the update function initially
            updateEmailTemplate();

            // Bind change events to input and select elements
            $('.person_name, .show_date, .show_time').on('input', function() {
                updateEmailTemplate();
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\picAi\resources\views/welcome.blade.php ENDPATH**/ ?>