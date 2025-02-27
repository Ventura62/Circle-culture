<?php $__env->startSection('content'); ?>
    <div class="py-160">
        <div class="container">
            <div class="row mb-n8">
                <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-danger" role="alert">
                                        <strong><?php echo e($error); ?></strong><br>
                                    </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

                <div class="col-12 col-lg-10 col-xl-8 show-on-scroll" data-show-distance="10" data-show-duration="600">
                    <h1 class="h2 mt-15 pb-4 pb-sm-0 mb-50">
                        
                        Let’s Get Started!

                        <br>
                        <span style="font-size: 15px">Already have an account ? <a href="<?php echo e(route('login')); ?>">Login</a></span>
                    </h1>
                </div>
            </div>


            <div class="row gh-1 gv-2 pb-10">
                <div class="col-12 col-lg-8 mt-5 mt-lg-0">

                    <form  method="POST" action="<?php echo e(route('register')); ?>" >
                        <?php echo csrf_field(); ?>
                        <div class="row gh-1 gv-2">

                            <div class="col-12 col-md-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="150">
                                <input type="text" name="name" class="form-control" placeholder="Full Name *" value="<?php echo e(old('name')); ?>">
                            </div>

                            
                                
                            


                            <div class="col-12 col-md-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="150">
                                <input type="email" name="email" autocomplete="email" required autofocus class="form-control" value="<?php echo e(old('email')); ?>" placeholder="Email *">
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
                                <input type="password"  name="password" required autocomplete="new-password" class="form-control" placeholder="Password *">
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

                            </div>

                            <div class="col-12 col-md-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="200">
                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required="">
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
                            </div>

                            

                                
                                    
                                    
                                    
                                    
                                
                            


                            <div class="col-12 show-on-scroll" data-show-duration="400" data-show-distance="10" data-show-delay="470">
                                <button class="btn theme-button-dark mt-20" type="submit" name="button">Register</button>
                                <a href="<?php echo e(route('google.authenticate')); ?>" class="btn theme-button-dark  mt-20 " type="button" name="button">
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

<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/auth/register.blade.php ENDPATH**/ ?>