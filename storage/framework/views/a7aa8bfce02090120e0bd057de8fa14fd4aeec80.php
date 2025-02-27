<?php $__env->startSection('styles'); ?>


    <style>
        .booking-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .booking-card {
            background-color: #37577e0a;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 12px;
            text-align: center;
        }

        .waiting-text {
            color: #666;
            text-align: center;
            margin-bottom: 40px;
            font-size: 18px;
        }


        .date-options {
            margin-bottom: 40px;
        }

        .date-options h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .dates-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .date-option {
            cursor: pointer;
            width: 100%;
            margin-bottom: 1rem;
        }

        .date-option input[type="radio"] {
            display: none;
        }

        .date-content {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 14px 14px;
            transition: all 0.1s ease;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .date-option input[type="radio"]:checked + .date-content {
            border-color: #000;
            background-color: #ebebeb;
        }


        .date-option input[type="radio"]:hover + .date-content {
            border-color: #000;
            background-color: #ebebeb;
        }

        .date-text {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .time {
            color: #666;
            font-size: 16px;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .dates-grid {
                grid-template-columns: 1fr;
            }

            .date-content {
                padding: 20px;
            }

            .date-text {
                font-size: 16px;
            }

            .time {
                font-size: 14px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .date-content {
                padding: 16px;
            }

            .date-text {
                font-size: 14px;
            }

            .time {
                font-size: 12px;
            }
        }

        .book-button {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            display: block;
            padding: 18px;
            background-color: #000;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .book-button:hover {
            background-color: white;
            color: black;
            border: 1px solid #000;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .booking-container {
                max-width: 600px;
            }

            .booking-card {
                padding: 30px;
            }

            .date-options {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 28px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .booking-card {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .waiting-text {
                font-size: 14px;
                margin-bottom: 30px;
            }

            .date-content {
                padding: 16px;
            }

            .date-text {
                font-size: 14px;
            }

            .book-button {
                padding: 16px;
                font-size: 16px;
            }
        }
        .plans-container {
            margin-bottom: 40px;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .plans {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .plan-option {
            cursor: pointer;
        }

        .plan-option input[type="radio"] {
            display: none;
        }

        .plan-option input[type="radio"]:checked + .plan-content {
            border-color: #000;
            background-color: #f8f8f8;
        }

        .plan-option input[type="radio"]:hover + .plan-content {
            border-color: #000;
            background-color: #f8f8f8;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .plans {
                grid-template-columns: repeat(2, 1fr);
            }

            .plan-content {
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .plans {
                grid-template-columns: 1fr;
            }

            .plan-content {
                padding: 16px;
            }

            .plan-name {
                font-size: 16px;
            }

            .plan-price {
                font-size: 28px;
            }

            .plan-period {
                font-size: 14px;
            }

            h2 {
                font-size: 18px;
                margin-bottom: 16px;
            }
        }
        /* Responsive adjustments */
        @media (max-width: 480px) {
            .booking-card {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            .waiting-text {
                font-size: 14px;
            }

            .date-content {
                padding: 12px;
            }

            .date-text {
                font-size: 14px;
            }

            .time {
                font-size: 12px;
            }

            .book-button {
                padding: 14px;
                font-size: 14px;
            }

            .plans {
                grid-template-columns: 1fr;
            }

            .plan-content {
                padding: 12px;
            }

            .plan-name {
                font-size: 14px;
            }

            .plan-price {
                font-size: 20px;
            }

            .plan-period {
                font-size: 12px;
            }
        }
    </style>

    <style>
        .logo {
            margin: 20px 0;
            font-size: 37px;
            font-weight: bold;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 4px rgb(0 0 0 / 40%)
        }

        .confirmation-header {
            display: flex;
            align-items: center;
            color: #10b981;
            margin-bottom: 20px;
        }

        .confirmation-header-disabled {
            display: flex;
            align-items: center;
            color: #37577e;
            margin-bottom: 20px;
        }



        a:hover{
            color:#6b7280
        }

        .confirmation-header svg {
            margin-right: 8px;
        }

        .info-section {
            margin-bottom: 16px;
        }

        .info-label {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .info-value {
            color: #111827;
            font-size: 16px;
            font-weight: 500;
        }

        .button {
            width: 100%;
            padding: 12px;
            border-radius: 50px;
            border: none;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 12px;
            transition: background-color 0.2s;
        }

        .button-primary {
            background-color: #18181b;
            color: white;
        }

        .button-primary:hover {
            background-color: #27272a;
        }

        .button-secondary {
            background-color: white;
            color: #18181b;
            border: 1px solid #e5e7eb;
        }

        .button-secondary:hover {
            background-color: #f9fafb;
        }

        .button-danger {
            background-color: white;
            color: #ef4444;
            border: 1px solid #e5e7eb;
        }

        .button-danger:hover {
            background-color: #fee2e2;
        }

        .notification-card {
            background: #37577e0a;
            border: 1px solid #37577e85;
        }

        .notification-disabled {
            background: #cccccc52;
            border: 1px solid #ccc;
        }

        .notification-card.active {
            background: rgba(101, 204, 122, 0.25);
            border: 1px solid #8fba9585;
        }





        .notification-header {
            color: #37577e;
            display: flex;
            align-items: center;
        }

        .confirmation-disabled {
            color: #9d9696;
            display: flex;
            align-items: center;
        }


        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .card {
                padding: 16px;
            }

            .button {
                padding: 10px;
                font-size: 14px;
            }

            .info-value {
                font-size: 14px;
            }
        }

    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container pt-130 pb-130 mt-n10 ">
        <div class="row gh-1 gv-1 align-items-center align-items-lg-stretch flex-column flex-lg-row">
            <div class="col-lg-1 d-none d-lg-block order-2 order-lg-2"></div>
            <div class="col-12 col-lg ms-lg-n30 order-4 order-lg-3 show-on-scroll" data-show-duration="600" data-show-distance="10">
                <form action="<?php echo e(route('submission.update_date')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="booking-container">
                        <div class="booking-card">
                            <h1>Picker another date</h1>
                            <p class="waiting-text">Change your dinner date</p>

                            <div class="date-options">
                                <h2>Select your date</h2>
                                <div class="">
                                    <?php $__currentLoopData = $upcoming_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="date-option">
                                            <input type="radio" name="date" required <?php if(auth()->user()->submission->booking_date == $date['date']): ?> checked <?php endif; ?> value="<?php echo e($date['date']); ?>">
                                            <div class="date-content">
                                                <div class="date-text"> <?php echo e(\Carbon\Carbon::parse($date['date'])->format('F jS, Y')); ?></div>
                                                <div class="time"><?php echo e(\Carbon\Carbon::parse($date['date'])->format('h:i A')); ?></div>
                                            </div>
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <button class="book-button">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/web/change_date.blade.php ENDPATH**/ ?>