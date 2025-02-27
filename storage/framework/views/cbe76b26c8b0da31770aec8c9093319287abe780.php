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


        .action-button {
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            border: none;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .delete-btn {
            background-color: #fff;
            color: black;
            border: 1px solid black;
        }

        .delete-btn:hover {
            background-color: #37577e0a;
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
                <?php
                    $group = auth()->user()->group();
                    $event = $group->event ?? null;

                    $is_ended = 0;

                    $can_refund = 1;
                    $can_reveal_group = 0;
                    $can_reveal_dinner = 0;

                    if($event){
                        $windowTime = Carbon\Carbon::parse($event->time)->subMinutes(4320);

                        $groupRevealTime = Carbon\Carbon::parse($event->time)->subMinutes(1440); // 24 hrs before event time

                        $restaurantRevealTime = Carbon\Carbon::parse($event->time)->subMinutes(600); // 10 hrs before event time

                        $targetTime = Carbon\Carbon::parse($event->time)->addMinutes(180);

                        $currentTime = Carbon\Carbon::now(); // 6 - 10 - 2025

                        $is_ended = $currentTime->gt($targetTime) ? 1 : 0;

                        $can_refund = $currentTime->gt($windowTime) ? 0 : 1; // user can only refund if current time is less than 72 hrs before the event time

                        $can_reveal_group = $currentTime->gt($groupRevealTime) ? 1 : 0;

                        $can_reveal_dinner = $currentTime->gt($restaurantRevealTime) ? 1 : 0;
                    }
                ?>

                <div class="logo text-center">Tab4Six </div>
                <?php if(auth()->user()->submission->is_confirmed): ?>
                    <div class="">
                        <!-- Confirmation Card -->
                        <div class="card <?php if($is_ended): ?> notification-disabled <?php else: ?> notification-card <?php endif; ?>">
                            <div class="<?php if(!$event): ?>   confirmation-header-disabled  <?php elseif($is_ended): ?> confirmation-disabled <?php else: ?> confirmation-header <?php endif; ?>">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" fill="currentColor"/>
                                </svg>
                                <span>Your seat is confirmed</span>
                            </div>

                            <?php if(!$is_ended): ?>
                                <div class="info-section">
                                    <div class="info-label">Date</div>
                                    <div class="info-value"><?php echo e(\Carbon\Carbon::parse(auth()->user()->submission->booking_date)->format('F jS, Y h:i A')); ?></div>
                                </div>

                                <div class="info-section">
                                    <div class="info-label">Location</div>
                                    <div class="info-value">Bay Area</div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Group Notification Card -->
                        <div class="card <?php if($is_ended): ?> notification-disabled <?php else: ?> notification-card <?php endif; ?>">
                            <div class="<?php if($group && $event && $event->is_active && !$is_ended): ?> confirmation-header <?php elseif($is_ended): ?> confirmation-disabled  <?php else: ?> notification-header <?php endif; ?>">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="margin-right: 8px;">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-8.414V4a1 1 0 10-2 0v5.586a1 1 0 102 0zM9 14a1 1 0 112 0 1 1 0 01-2 0z" fill="currentColor"/>
                                    </svg>
                                Your group
                            </div>

                            <?php if(!$is_ended): ?>
                                <?php if($group && $event && $event->is_active && $can_reveal_group): ?>
                                    <p style="margin-top: 8px;margin-bottom: 0"><b>Activities</b><br><?php echo e($group['activities']); ?></p>
                                    <hr style="margin-top: 10px; margin-bottom: 0 ; border-color: rgba(47,47,47,0.16)">
                                    <p style="margin-top: 8px;margin-bottom: 0"><b>Preferred Topics</b><br><?php echo e($group['topics']); ?></p>
                                    <hr style="margin-top: 10px; margin-bottom: 0; border-color: rgba(47,47,47,0.16)">
                                    <p style="margin-top: 8px;margin-bottom: 0"><b>Meet people in</b><br><?php echo e($group['meet_in']); ?></p>
                                <?php else: ?>
                                    <p style="margin-top: 8px;">Find out more about your group on<br><?php echo e(Carbon\Carbon::parse(auth()->user()->submission->booking_date)->subMinutes(1440)->format('F jS, Y h:i A')); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Restaurant Notification Card -->
                        <div class="card <?php if($is_ended): ?> notification-disabled <?php else: ?> notification-card <?php endif; ?>">
                            <div class="<?php if($group && $event && $event->is_active && !$is_ended): ?> confirmation-header  <?php elseif($is_ended): ?> confirmation-disabled <?php else: ?> notification-header <?php endif; ?>">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="margin-right: 8px;">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-8.414V4a1 1 0 10-2 0v5.586a1 1 0 102 0zM9 14a1 1 0 112 0 1 1 0 01-2 0z" fill="currentColor"/>
                                </svg>
                                Your restaurant
                            </div>

                            <?php if(!$is_ended): ?>

                                <?php if($group && $event && $event->is_active && $can_reveal_dinner): ?>
                                    <br>
                                    <p style="margin-top: 8px;margin-bottom: 0"><b>Reservation under Name</b><br><?php echo e($group->table_number); ?></p>
                                    <hr style="margin-top: 10px; margin-bottom: 0 ; border-color: rgba(47,47,47,0.16)">
                                    <p style="margin-top: 8px;margin-bottom: 0"><b>Address</b><br><?php echo e($group->restaurant->location); ?></p>
                                    <hr style="margin-top: 10px; margin-bottom: 0; border-color: rgba(47,47,47,0.16)">
                                    <p style="margin-top: 8px;margin-bottom: 0"><b>Restaurant</b><br><?php echo e($group->restaurant->name); ?></p>


                                    <?php $feedbcak = \App\Models\Feedback::where('user_id', auth()->user()->id)->where('event_id', $group->event->id)->get(); ?>


                                        <a href="<?php echo e(route('event.update' ,[$event->id, 'confirmed'])); ?>" style="text-decoration: none; text-align: center ; <?php if(isset($event->status) &&$event->status->status == 'confirmed'): ?> background:#65cc7a  <?php endif; ?>" class="button button-primary mt-20">I'll be there <?php if(isset($event->status) && $event->status->status == 'confirmed'): ?> <i class="fa fa-check"></i> <?php endif; ?>   </a>
                                        <a href="<?php echo e(route('event.update' ,[$event->id, 'late'])); ?>" style="text-decoration: none; text-align: center ;<?php if(isset($event->status) && $event->status->status == 'late'): ?> background:#65cc7a; color: white  <?php endif; ?>"  class="button button-secondary">Might be late <?php if(isset($event->status) && $event->status->status == 'late'): ?> <i class="fa fa-check"></i> <?php endif; ?> </a>
                                        <a href="<?php echo e(route('event.update' ,[$event->id, 'noshow'])); ?>" style="text-decoration: none; text-align: center; <?php if(isset($event->status) && $event->status->status == 'noshow'): ?> background:#65cc7a; color: white  <?php endif; ?>" class="button button-danger">Can't make it this time <?php if(isset($event->status) && $event->status->status == 'noshow'): ?> <i class="fa fa-check"></i> <?php endif; ?> </a>
                                    
                                <?php else: ?>
                                    <p style="margin-top: 8px;">Get your dinner location on<br> <?php echo e(Carbon\Carbon::parse(auth()->user()->submission->booking_date)->subMinutes(600)->format('F jS, Y h:i A')); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <?php if($event && $group && $is_ended): ?>
                            <div class="card <?php if($is_ended): ?> notification-disabled  <?php else: ?> notification-card <?php endif; ?>">
                                <div class="<?php if($is_ended): ?> confirmation-disabled <?php else: ?> notification-header <?php endif; ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="margin-right: 8px;">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-8.414V4a1 1 0 10-2 0v5.586a1 1 0 102 0zM9 14a1 1 0 112 0 1 1 0 01-2 0z" fill="currentColor"/>
                                    </svg>
                                    Your Feedback
                                </div>

                                <?php $feedbcak = \App\Models\Feedback::where('user_id', auth()->user()->id)->where('event_id', $event->id)->get(); ?>
                                <?php if($feedbcak->count() > 0): ?>
                                    <p style="margin-top: 8px;margin-bottom: 0">Thank you for giving your feedback</p>
                                <?php else: ?>
                                    <hp style="margin-top: 8px;">It helps fine-tune recommendations to better match your expectations</hp>

                                <br>
                                    <a style="text-decoration: none; text-align: center" href="<?php echo e(url('feedback?event_id=' . $event->id)); ?>"  class="button theme-button-dark mt-20 ">Give my feedback</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if(!isset($event)): ?>
                            <a style="text-decoration: none; justify-content: center; display: flex" href="<?php echo e(route('change_date')); ?>" type="button" class="action-button delete-btn restBtn">Change Booking Date</a>
                        <?php endif; ?>

                        <?php if($can_refund && !auth()->user()->subscribed()): ?>
                            <a style="text-decoration: none; justify-content: center; display: flex" href="<?php echo e(route('refund')); ?>" type="button" class="action-button delete-btn restBtn">Cancel & Refund </a>
                        <?php endif; ?>

                    </div>
                <?php else: ?>
                    <form action="<?php echo e(route('book')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input hidden name="submission_id" value="<?php echo e(auth()->user()->submission->id); ?>">

                        <div class="booking-container">
                            <div class="booking-card">
                                <h1>Book your next dinner</h1>
                                <p class="waiting-text">Meet 5 new faces at your next dinner</p>

                                <div class="date-options">
                                    <h2>Select your date</h2>
                                    <div class="">
                                        <?php $__currentLoopData = $upcoming_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="date-option">
                                                <input type="radio" name="date" required value="<?php echo e($date['date']); ?>">
                                                <div class="date-content">
                                                    <div class="date-text"> <?php echo e(\Carbon\Carbon::parse($date['date'])->format('F jS, Y')); ?></div>
                                                    <div class="time"><?php echo e(\Carbon\Carbon::parse($date['date'])->format('h:i A')); ?></div>
                                                </div>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <button class="book-button">Book my seat</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/web/group.blade.php ENDPATH**/ ?>