<?php $__env->startSection('styles'); ?>
   <style>

       .coupon_input::placeholder{
           color: rgba(0, 0, 0, 0.18);
       }
       .booking-container {
           background: #37577e0a;
           border-radius: 20px 20px 0 0;
           margin-top: -20px;
           padding: 40px;
           max-width: 800px;
           margin-left: auto;
           margin-right: auto;
       }

       .toggle-container {
           display: flex;
           justify-content: center;
           gap: 10px;
           margin-bottom: 30px;
       }

       .toggle-option {
           position: relative;
       }

       .toggle-option input[type="radio"] {
           position: absolute;
           opacity: 0;
       }

       .toggle-option label {
           display: inline-block;
           padding: 12px 30px;
           border-radius: 25px;
           cursor: pointer;
           background: #fff;
           border: 1px solid #ddd;
           font-size: 16px;
           transition: all 0.3s ease;
       }

       .toggle-option input[type="radio"]:checked + label {
           background: #000;
           color: white;
           border-color: #000;
       }

       .section {
           display: none;
       }

       .section.active {
           display: block;
       }

       .plans-grid {
           display: grid;
           grid-template-columns: repeat(3, 1fr); /* Fixed 3-column layout */
           gap: 20px;
           margin-bottom: 30px;
       }

       .plan-option {
           cursor: pointer;
       }

       .plan-option input[type="radio"] {
           position: absolute;
           opacity: 0;
       }

       .plan-card {
           background: white;
           border-radius: 15px;
           padding:15px;
           text-align: center;
           border: 2px solid #ddd;
           transition: all 0.3s ease;
       }


       .plan-option input[type="radio"]:checked + .plan-card {
           border-color: #000;
           background-color: #ebebeb;
       }


       .plan-option input[type="radio"]:hover + .plan-card {
           border-color: #000;
           background-color: #ebebeb;
       }


       .plan-name {
           font-size: 20px;
           font-weight: 600;
           /*margin-bottom: 15px;*/
       }

       .plan-price {
           font-size: 32px;
           font-weight: 700;
           /*margin-bottom: 10px;*/
       }

       .plan-period {
           color: #666;
           font-size: 16px;
           margin-bottom: 20px;
       }

       .booking-details {
           background: white;
           border-radius: 15px;
           padding: 25px;
           margin-bottom: 30px;
       }

       .detail-row {
           margin-bottom: 20px;
       }

       .detail-label {
           font-size: 14px;
           color: #666;
           margin-bottom: 8px;
       }

       .detail-value {
           font-size: 16px;
           font-weight: 500;
       }

       .total {
           display: flex;
           justify-content: space-between;
           font-weight: bold;
           margin-top: 15px;
           font-size: 18px;
       }

       .terms {
           font-size: 14px;
           color: #666;
           margin: 20px 0;
           line-height: 1.6;
       }

       .terms a {
           color: #333;
           text-decoration: underline;
       }

       .book-button {
           background: black;
           color: white;
           width: 100%;
           padding: 18px;
           border: none;
           border-radius: 30px;
           font-size: 18px;
           font-weight: 600;
           cursor: pointer;
           margin-top: 20px;
           transition: all 0.3s ease;
       }

       .book-button:hover {
           background: white;
           color: black;
           border: 1px solid #000;
       }

       .book-button:disabled {
           background: #ccc;
           cursor: not-allowed;
       }

       .logo {
           margin: 20px 0;
           font-size: 37px;
           font-weight: bold;
       }
       @media (max-width: 768px) {
           .hero {
               height: 200px;
               padding: 20px;
           }

           .booking-container {
               padding: 20px;
           }

           .toggle-option label {
               padding: 10px 20px;
               font-size: 14px;
           }

           .plans-grid {
               grid-template-columns: 1fr;
           }
       }
   </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container pt-130 pb-130 mt-n10 ">
        <div class="row gh-1 gv-1 align-items-center align-items-lg-stretch flex-column flex-lg-row">
            <div class="col-lg-1 d-none d-lg-block order-2 order-lg-2"></div>
            <div class="col-12 col-lg ms-lg-n30 order-4 order-lg-3 show-on-scroll" data-show-duration="600" data-show-distance="10">
                <div class="logo text-center mb-10">Tab4Six</div>
                <br>
                <form id="bookingForm" method="post" action="<?php echo e(route('pay')); ?>" class="booking-container">
                    <?php echo csrf_field(); ?>
                    <div class="toggle-container">
                        <div class="toggle-option">
                            <input type="radio" id="subscription" name="bookingType" value="subscription" checked>
                            <label for="subscription">Subscription</label>
                        </div>
                        <div class="toggle-option">
                            <input type="radio" id="ticket" name="bookingType" value="ticket" >
                            <label for="ticket">1 ticket</label>
                        </div>
                    </div>

                    <div class="section active" id="subscription-section">
                        <div class="plans-grid">
                            <label class="plan-option">
                                <input type="radio" id="basic" name="payment_plan" value="1">
                                <div class="plan-card">
                                    <div class="plan-name">1 Month</div>
                                    <div class="plan-price">$30</div>
                                    <div class="plan-period">per month</div>
                                    
                                </div>
                            </label>

                            <label class="plan-option">
                                <input type="radio" id="standard" name="payment_plan" value="3" checked>
                                <div class="plan-card">
                                    <div class="plan-name">3 Months</div>
                                    <div class="plan-price">$20</div>
                                    <div class="plan-period">per month</div>
                                    
                                </div>
                            </label>

                            <label class="plan-option">
                                <input type="radio" id="premium" name="payment_plan" value="6">
                                <div class="plan-card">
                                    <div class="plan-name">6 Months</div>
                                    <div class="plan-price">$16</div>
                                    <div class="plan-period">per month</div>
                                    
                                </div>
                            </label>
                        </div>

                        <div class="terms">
                            By subscribing, you agree to be charged, and your subscription will automatically renew at the same price and package duration unless canceled in your account settings. You also acknowledge the right to withdraw within 14 days for a pro-rated refund. No refunds will be issued after the 14-day withdrawal period.
                        </div>
                    </div>

                    <div class="section" id="ticket-section">
                        <div class="booking-details">
                            <div class="detail-row">
                                <div class="detail-label">Date</div>
                                <div class="detail-value"><?php echo e(\Carbon\Carbon::parse(session()->get('booking_date') )->format('F jS, Y h:i A')); ?></div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">
                                    <span class="location-flag">US</span> Bay Area
                                </div>
                            </div>

                            <div class="total">
                                <span>TOTAL</span>
                                <span class="total-price">$16.00</span>
                            </div>
                        </div>

                        <div class="plans-grid d-none" style="grid-template-columns: repeat(1, 1fr);">
                            <label class="plan-option">
                                <input type="radio" id="single-ticket" name="payment_plan" value="ticket" >
                                <div class="plan-card">
                                    <div class="plan-name">1 Ticket</div>
                                    <div class="plan-price">$16</div>
                                    <div>Single dinner ticket</div>
                                </div>
                            </label>
                        </div>

                        <div class="terms">
                            You are eligible for a refund only if you cancel at least 48 hours before the start of the dinner. By completing this purchase, you acknowledge that Tab4Six is not responsible for any incidents, outcomes, or expenses incurred during the dinner.                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label " style="font-weight: 800">Discount Coupon</div>
                        <div class="detail-value">
                            <input  name="coupon" class="form-control coupon_input" placeholder="Enter Coupon">
                        </div>
                    </div>


                    <button type="submit" class="book-button" id="book-button">Proceed</button>
                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        const form = document.getElementById('bookingForm');
        const bookingTypeInputs = document.querySelectorAll('input[name="bookingType"]');
        const planInputs = document.querySelectorAll('input[name="plan"]');
        const button = document.getElementById('book-button');
        const totalPrice = document.querySelector('.total-price');
        const ticketRadio = document.getElementById('ticket');
        const subscriptionRadio = document.getElementById('subscription');

        bookingTypeInputs.forEach(input => {
            input.addEventListener('change', () => {
                const type = input.value;
                document.querySelectorAll('.section').forEach(section =>
                    section.classList.remove('active')
                );
                document.getElementById(`${type}-section`).classList.add('active');

                // Reset plan selection when switching types
                if (type === 'ticket') {
                    document.getElementById('single-ticket').checked = true;
                }
            });
        });

        planInputs.forEach(input => {
            input.addEventListener('change', () => {
                // Auto-select subscription radio when selecting a subscription plan
                if (input.value !== 'single') {

                    subscriptionRadio.checked = true;
                    document.querySelectorAll('.section').forEach(section =>
                        section.classList.remove('active')
                    );
                    document.getElementById('subscription-section').classList.add('active');
                } else {

                    ticketRadio.checked = true;
                    document.querySelectorAll('.section').forEach(section =>
                        section.classList.remove('active')
                    );
                    document.getElementById('ticket-section').classList.add('active');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/web/plan.blade.php ENDPATH**/ ?>