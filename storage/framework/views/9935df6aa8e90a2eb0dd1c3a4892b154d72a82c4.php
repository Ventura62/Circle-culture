<?php $__env->startSection('content'); ?>
    <div class="py-160">
        <div class="container">
            <div class="row mb-n8">
                <div class="col-12 col-lg-10 col-xl-8 show-on-scroll" data-show-distance="10" data-show-duration="600">
                    <h1 class="h2 mt-15 pb-4 pb-sm-0 mb-60">
                        
                        Reset Password!
                        <br>
                        
                    </h1>
                </div>
            </div>

            <div class="row gh-1 gv-2 pb-10">

                <div class="col-12 col-lg-8 mt-5 mt-lg-0">


                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>


                    <form action="<?php echo e(route('password.email')); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <div class="row gh-1 gv-2">
                            <div class="col-12 col-md-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="150">
                                <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Your Email *"  value="<?php echo e(old('email')); ?>" autofocus autocomplete="email" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>


                            <div class="col-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="470">
                                <button class="theme-button-dark btn  mt-20" type="submit" name="button">  Send Reset Link</button>


                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>