<?php $__env->startSection('content'); ?>
    <div class="py-160">
        <div class="container">
            <div class="row mb-n8">
                <div class="col-12 col-lg-10 col-xl-8 show-on-scroll" data-show-distance="10" data-show-duration="600">
                    <h1 class="h2 mt-15 pb-4 pb-sm-0 mb-60">
                        
                        Let’s Get Started!
                        <br>
                        
                    </h1>
                </div>
            </div>

            <div class="row gh-1 gv-2 pb-10">

                <div class="col-12 col-lg-8 mt-5 mt-lg-0">

                    <form action="<?php echo e(route('login')); ?>" method="post">
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
unset($__errorArgs, $__bag); ?>" placeholder="Email *"  value="<?php echo e(old('email')); ?>" autofocus autocomplete="email" required>
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

                            <div class="col-12 col-md-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="200">
                                <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required autocomplete="current-password" name="password" placeholder="Password *">
                                <?php $__errorArgs = ['password'];
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
                                <div class="col-12 col-md-12 show-on-scroll mt-20" data-show-duration="400" data-show-distance="10" data-show-delay="200">
                                    <a style="text-decoration: none" href="<?php echo e(route('password.request')); ?>">Forgot Password ?</a>
                                </div>

                            </div>



                            <div class="col-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="470">
                                <button class="theme-button-dark btn  mt-20" type="submit" name="button">Login</button>

                                <a href="<?php echo e(route('google.authenticate')); ?>" class="theme-button-dark btn mt-20" type="button" name="button">
                                    <img style="width: 60%;" src="<?php echo e(asset('frontend/images/google_icon.svg')); ?>">
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
           </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/auth/login.blade.php ENDPATH**/ ?>