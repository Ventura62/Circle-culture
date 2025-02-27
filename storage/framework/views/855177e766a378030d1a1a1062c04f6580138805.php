<?php $__env->startSection('styles'); ?>

    <style>
        .checkbox-btn+label {

            color: black;
            border: 1px solid #000;
        }

        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .fade-in.show {
            opacity: 1;
        }
    </style>

    <style>


        .form-container {
            /*background-color: #000;*/
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .progress-bar {
            width: 100%;
            height: 14px;
            background-color: #000;
            /*border-radius: 4px;*/
            margin-bottom: 8rem;
            position: relative;
        }

        .progress {
            position: absolute;
            height: 100%;
            background-color: #37577e;
            border-radius: 1px;
            transition: width 0.5s ease;
            width: 10%;
        }

        .step-container {
            display: none;
        }

        .step-container.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes  fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.8rem;
        }

        .options {
            display: grid;
            grid-template-columns: repeat(3, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 5rem;
        }

        .option {
            background-color: transparent;
            border: 2px solid #a39a9d2b;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option:hover {
            background-color: #37577e;
            transform: translateY(-1px);
        }

        .option i {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 1rem;
            display: block;
            transition: color 0.3s ease;
        }

        .option span {
            color: #fff;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .option:hover i,
        .option:hover span {
            color: #fff;
        }

        .navigation {
            position: absolute;
            top: 5rem;
            left: 3rem;
            z-index: 10;
        }

        .back-btn {
            border: none;
            background: none;
            /*border: 2px solid #37577e;*/
            color: white;
            font-size: 1rem;
            cursor: pointer;
            display: none;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #37577e;
            color: #fff;
        }

        .completion-message {
            text-align: center;
            padding: 2rem;
        }

        .completion-message i {
            font-size: 4rem;
            color: #37577e;
            margin-bottom: 1rem;
        }

        .completion-message p {
            color: #fff;
            font-size: 1.2rem;
        }

        input, textarea {
            width: 80%;
            padding: 0.75rem 1rem;
            background-color: #ffffff14;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
            color: white;
            font-size: 1rem;
            margin: auto;
            /*text-align: center;*/
        }

        input:focus , textarea:focus {
            outline: none;
            border-color: white;
        }

        input::placeholder  , textarea::placeholder{
            color: rgba(255, 255, 255, 0.4);
        }



        .voting-container {
            padding: 1rem;
        }

        .attendee-card {
            background: #1a1a1a;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .attendee-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .attendee-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .attendee-name {
            font-size: 1.1rem;
            font-weight: 500;
            color: #fff;
        }

        .voting-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .vote-btn {
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            background: transparent;
            color: #fff;
            border: 1px solid #333;
        }

        .vote-btn:hover {
            transform: translateY(-2px);
        }

        .vote-btn.yes {
            border-color: #00b894;
        }

        .vote-btn.yes:hover, .vote-btn.yes.selected {
            background: #00b894;
        }

        .vote-btn.no {
            border-color: #ff7675;
        }

        .vote-btn.no:hover, .vote-btn.no.selected {
            background: #ff7675;
        }

        .vote-btn.not-there {
            border-color: #b2bec3;
        }

        .vote-btn.not-there:hover, .vote-btn.not-there.selected {
            background: #b2bec3;
        }

        .next-btn {
            background: #ff5722;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 500;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .next-btn:hover {
            background: #f4511e;
            transform: translateY(-2px);
        }

        .next-btn:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
        }


        .rating-container {
            padding: 1rem;
        }

        .rating-card {
            /*background: #1a1a1a;*/
            border-radius: 12px;
            /*padding: 2rem;*/
            margin-bottom: 1rem;
            text-align: center;
        }

        .stars {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 0.5rem;
        }

        .star-input {
            display: none;
        }

        .star-label {
            font-size: 3.5rem;
            color: #333;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .star-label:hover,
        .star-label:hover ~ .star-label,
        .star-input:checked ~ .star-label {
            color: #fff;
        }

        .rating-text {
            margin-top: 1rem;
            color: #fff;
            font-size: 1.1rem;
        }

        /* Reuse the existing next button styles */
        .next-btn {
            background: #ff5722;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 500;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .next-btn:hover {
            background: #f4511e;
            transform: translateY(-2px);
        }

        .next-btn:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
        }
    </style>

    <style>
        .checkbox-btn+label {

            color: black;
            border: 1px solid #000;
        }

        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .fade-in.show {
            opacity: 1;
        }
    </style>

    <style>

        body{
            background: rgba(14,  14,  14 , 1)
        }

        .form-container {
            /*background-color: #000;*/
            border-radius: 20px;
            padding: 3rem;
            /*box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);*/
            position: relative;
        }

        .progress-bar {
            width: 100%;
            height: 14px;
            background-color: #000;
            /*border-radius: 4px;*/
            margin-bottom: 4rem;
            position: relative;
        }

        .progress {
            position: absolute;
            height: 100%;
            background-color: #37577e;
            border-radius: 1px;
            transition: width 0.5s ease;
            width: 10%;
        }

        .step-container {
            display: none;
        }

        .step-container.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes  fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        .options {

            font-size: 20px;
            display: grid;
            grid-template-columns: repeat(5, minmax(100px, 1fr));
            gap: 1.5rem;
            margin-top: 5rem;
        }

        .option {
            background-color: transparent;
            border: 2px solid #a39a9d2b;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option:hover {
            background-color: #37577e;
            transform: translateY(-1px);
        }

        .option i {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 1rem;
            display: block;
            transition: color 0.3s ease;
        }

        .option span {
            color: #fff;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .option:hover i,
        .option:hover span {
            color: #fff;
        }

        .navigation {
            position: absolute;
            top: 5rem;
            left: 3rem;
            z-index: 10;
        }

        .back-btn {
            border: none;
            background: none;
            /*border: 2px solid #37577e;*/
            color: white;
            font-size: 1rem;
            cursor: pointer;
            display: none;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #37577e;
            color: #fff;
        }

        .completion-message {
            text-align: center;
            padding: 2rem;
        }

        .completion-message i {
            font-size: 4rem;
            color: #37577e;
            margin-bottom: 1rem;
        }

        .completion-message p {
            color: #fff;
            font-size: 1.2rem;
        }

        input, textarea {
            width: 80%;
            padding: 0.75rem 1rem;
            background-color: #ffffff14;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
            color: white;
            font-size: 1rem;
            margin: auto;
            text-align: center;
        }

        input:focus , textarea:focus {
            outline: none;
            border-color: white;
        }

        input::placeholder  , textarea::placeholder{
            color: rgba(255, 255, 255, 0.4);
        }

        .stepBtn {
            position: relative;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            border-radius: 50px;
            padding: 0;
            font-size: 1rem;
            cursor: pointer;
            overflow: hidden;
            width: 30%;
            margin: auto;
            margin-top: 3rem;


        }

        .stepBtn span {
            position: relative;
            display: block;
            padding: 0.75rem 2rem;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .stepBtn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: white;
            transition: transform 0.5s ease;
        }

        .stepBtn:hover::before {
            /*transform: translateX(100%);*/
        }

        .stepBtn:hover span {
            color: white;
            background-color: #37577e;

        }

        @media (max-width: 768px) {
            .stepBtn {

                width: 100%;
                font-size: 15px;
            }

            h2{
                font-size: 1.5rem;
            }

            .form-container {
                padding: 0rem;
                padding-top: 1rem;
            }


            .options {
                grid-template-columns: repeat(5, minmax(30px, 2fr));
                gap: 8px;
                margin-top: 5rem;
            }

            .mutli-choice-option {
                grid-template-columns: repeat(1, minmax(100px, 1fr)) !important;
            }

            .navigation {
                position: absolute;
                top: 2.5rem;
                left: 0;
                z-index: 10;
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="py-160 bg-dark">

        <div class="container">
            <div class="form-container">
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>

                <div class="step-container active " data-id="" data-step="1">
                    <h2>How likely are you to recommend this experience to someone like yourself ?</h2>

                    <div class="options" >
                        <div class="option answer" data-next="2">
                            <span>1</span>
                        </div>

                        <div class="option answer" data-next="2">
                            <span>2</span>
                        </div>

                        <div class="option answer" data-next="2">
                            <span>3</span>
                        </div>

                        <div class="option answer" data-next="2">
                            <span>4</span>
                        </div>

                        <div class="option answer" data-next="2">
                            <span>5</span>
                        </div>

                    </div>
                    <br>
                    <span style="color: white;float: inline-end;"> Less Likely</span>
                    <span style="color: white" class="mt"> More Likely</span>
                </div>

                <div class="step-container" data-step="2">
                    <h2>Who would you like to see again for dinner?</h2>
                    <div class="voting-container">

                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if($member['email'] != auth()->user()->email): ?>
                                <div class="attendee-card">
                                    <div class="attendee-info">
                                        <div class="attendee-name"><?php echo e($member['name']); ?></div>
                                    </div>
                                    <div class="voting-options">
                                        <button data-email="<?php echo e($member['email']); ?>" class="vote-btn yes" data-name="<?php echo e($member['name']); ?>" data-vote="yes">
                                            Yes 👍
                                        </button>
                                        <button data-email="<?php echo e($member['email']); ?>"  class="vote-btn no" data-name="<?php echo e($member['name']); ?>"  data-vote="no">
                                            No 👎
                                        </button>
                                        <button data-email="<?php echo e($member['email']); ?>"  class="vote-btn not-there" data-name="<?php echo e($member['name']); ?>" data-vote="not-there">
                                            Not there 🤔
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div style="width:100%; display: flex">
                        <button class="stepBtn  option" data-next="3">
                            <span>Next</span>
                        </button>
                    </div>
                </div>

                <div class="step-container" data-step="3">
                    <h2>What did you think about the restaurant?</h2>
                    <div class="rating-container">
                        <div class="rating-card">
                            <div class="stars">
                                <input type="radio" id="star5" name="rating" value="5" class="star-input">
                                <label for="star5" class="star-label">★</label>
                                <input type="radio" id="star4" name="rating" value="4" class="star-input">
                                <label for="star4" class="star-label">★</label>
                                <input type="radio" id="star3" name="rating" value="3" class="star-input">
                                <label for="star3" class="star-label">★</label>
                                <input type="radio" id="star2" name="rating" value="2" class="star-input">
                                <label for="star2" class="star-label">★</label>
                                <input type="radio" id="star1" name="rating" value="1" class="star-input">
                                <label for="star1" class="star-label">★</label>
                            </div>
                        </div>
                    </div>

                    <div style="width:100%; display: flex">
                        <button class="stepBtn  option" data-next="4">
                            <span>Next</span>
                        </button>
                    </div>
                </div>

                <div class="step-container" data-step="4">
                    <h2>Please share any comments or feedback about the dinner?</h2>
                    <div style="width:100%; display: flex">
                        <textarea rows="5"  placeholder=""></textarea>
                    </div>

                    <div style="width:100%; display: flex">
                        <button class="stepBtn option" data-next="5">
                            <span>Next</span>
                        </button>
                    </div>
                </div>

                <div class="step-container" data-step="5">
                    <h2>Thank you!</h2>
                    <div class="completion-message">
                        <i class="fas fa-check-circle"></i>
                        <p>Your feedback has been provided.</p>
                    </div>
                </div>

                <div class="navigation">
                    <button class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

    <script>


        $(document).ready(function () {
            let answers = {}; // Store answers as key-value pairs
            const totalSteps = $('.step-container').length;

            // Handle answer selection for options
            $('.answer').on('click', function () {
                const step = $(this).closest('.step-container').data('step');
                const question = $(this).closest('.step-container').find('h2').text();
                const answer = $(this).find('span').text();

                answers['exp_feedback'] = { question: question, answer: answer };

                // Move to the next step
                const nextStep = $(this).data('next');
                if (nextStep) {
                    showStep(nextStep);
                }
            });

            // Handle voting
            $('.vote-btn').on('click', function () {
                const step = $(this).closest('.step-container').data('step');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const vote = $(this).data('vote');

                if (!answers['voting']) {
                    answers['voting'] = [];
                }

                answers['voting'].push({ name: name, email:email, vote: vote });
            });

            // Handle star rating
            $('.star-input').on('change', function () {
                const step = $(this).closest('.step-container').data('step');
                const question = $(this).closest('.step-container').find('h2').text();
                const rating = $(this).val();

                answers['rating'] = { question: question, rating: rating };
            });

            // Handle textarea feedback
            $('textarea').on('blur', function () {
                const step = $(this).closest('.step-container').data('step');
                const question = $(this).closest('.step-container').find('h2').text();
                const feedback = $(this).val();

                answers['txt_feedback'] = { question: question, feedback: feedback };
            });

            // Navigation for steps
            $('.stepBtn').on('click', function () {
                const nextStep = $(this).data('next');
                if (nextStep) {
                    showStep(nextStep);
                }
            });

            $('.back-btn').on('click', function () {
                const currentStep = $('.step-container.active').data('step');
                if (currentStep > 1) {
                    showStep(currentStep - 1);
                }
            });

            // Function to show a step
            function showStep(step) {
                $('.step-container').removeClass('active');
                $(`.step-container[data-step="${step}"]`).addClass('active');
            }

            // Log answers when the user completes the form
            // $('.completion-message').on('click', function () {
            //     console.log('Collected Answers:', JSON.stringify(answers, null, 2));
            //     alert('Thank you for your feedback!');
            // });



            // Handle option clicks
            $('.option').on('click', function () {

                // If it's the last step, log the JSON
                if ($(this).data('next') ===  totalSteps) {
                    const jsonString = JSON.stringify(answers, null, 2);
                    console.log(jsonString);

                    saveAnswers(jsonString)
                }
            });

            // Handle next button clicks for short-text, long-text, and date
            $('.next-button').on('click', function () {
                // If it's the last step, log the JSON
                if ($(this).data('next') ===  totalSteps) {

                    const jsonString = JSON.stringify(answers, null, 2);
                    console.log(jsonString);

                    saveAnswers(jsonString)

                }
            });

            function saveAnswers(jsonString) {
                $.ajax({
                    url: '<?php echo e(route('feedback.store')); ?>', // Backend route to store answers temporarily
                    type: 'POST',
                    data: {
                        event_id: '<?php echo $eventId; ?>',
                        feedback_json: jsonString,
                        _token: "<?php echo csrf_token(); ?>"// CSRF token
                    },
                    success: function (response) {
                        // Redirect user to login/signup page
                        window.location.href = response.redirect_to;
                    },
                    error: function (xhr) {
                        console.error('Failed to save answers:', xhr.responseText);
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            let currentStep = 1;
            const totalSteps = $('.step-container').length;

            function initializeVoting() {
                const votes = new Map();

                $('.voting-container').on('click', '.vote-btn', function() {
                    const $btn = $(this);
                    const name = $btn.data('name');
                    const vote = $btn.data('vote');

                    $btn.closest('.voting-options').find('.vote-btn').removeClass('selected');
                    $btn.addClass('selected');
                });

                $('.voting-container').on('click', '.next-btn', function() {
                    if (!$(this).prop('disabled')) {
                        goToStep(5);
                    }
                });
            }

            initializeVoting();

            function updateProgress() {
                const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
                $('.progress').css('width', `${progress}%`);
            }

            function updateBackButton() {
                if (currentStep > 1) {
                    $('.back-btn').fadeIn();
                } else {
                    $('.back-btn').fadeOut();
                }
            }

            function goToStep(step) {
                $('.step-container').removeClass('active');
                $(`.step-container[data-step="${step}"]`).addClass('active');
                currentStep = step;
                updateProgress();
                updateBackButton();
            }

            // Handle option selection
            $('.option').click(function() {
                const nextStep = $(this).data('next');
                if (nextStep) {
                    goToStep(nextStep);
                }
            });

            // Handle back button
            $('.back-btn').click(function() {
                if (currentStep > 1) {
                    goToStep(currentStep - 1);
                }
            });

            // Initialize
            // updateProgress();
            updateBackButton();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/web/feedback.blade.php ENDPATH**/ ?>