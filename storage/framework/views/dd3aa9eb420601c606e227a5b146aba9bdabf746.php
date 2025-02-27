<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>72 DUO </title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .form-section {
            width: 50%;
            background-color: #0a0f1a;
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }

        .back-button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.5rem;
            margin-bottom: 2rem;
            width: fit-content;
        }

        .form-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 28rem;
            width: 100%;
            margin: 0 auto;
        }

        h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 300;
            /*margin-bottom: 2.5rem;*/
        }

        .input-group {
            margin-bottom: 0.5rem;
        }

        label {
            display: block;
            color: white;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
            color: white;
            font-size: 1rem;
        }

        input:focus {
            outline: none;
            border-color: white;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .next-button {
            position: relative;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            border-radius: 0.25rem;
            padding: 0;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
            overflow: hidden;
            width: 50%;
        }

        .next-button span {
            position: relative;
            display: block;
            padding: 0.75rem 2rem;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .next-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: white;
            transition: transform 0.5s ease;
        }

        .next-button:hover::before {
            transform: translateX(100%);
        }

        .next-button:hover span {
            color: #0a0f1a;
        }

        .image-section {
            width: 50%;
            position: relative;
            background-image: url(<?php echo e(asset('cover.jpeg')); ?>);
            background-size: cover;
            background-position: center;
        }

        .image-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, #0a0f1a 0%, rgba(10, 15, 26, 0.8) 15%, rgba(10, 15, 26, 0) 100%);
        }


        span{
            color: white;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .form-section {
                width: 100%;
                min-height: 100vh;
                padding: 1.5rem;
            }

            .image-section {
                display: none;
            }

            h1 {
                font-size: 2rem;
                margin-bottom: 2rem;
            }

            .form-content {
                padding: 1rem 0;
            }

            .back-button {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 1rem;
            }

            h1 {
                font-size: 1.75rem;
                margin-bottom: 1.5rem;
            }

            input {
                font-size: 0.875rem;
            }


        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-section">

        <div class="form-content">

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

            <h1 style="font-weight: 500; ">72 DUO INTEREST FORM</h1>
            <h3 style="color: white">Thank you! Your submission has been received!</h3>

            <br>
            <br>

        </div>
    </div>
    <div class="image-section"></div>
</div>
</body>
</html><?php /**PATH D:\Laravel pros\hingeSubmission\resources\views/success.blade.php ENDPATH**/ ?>