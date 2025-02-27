@extends('layouts.web.master')

@section('styles')
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            font-weight: 800;
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

        .stepBtn:disabled , .stepBtn:disabled:hover span{
            background: #666;
            cursor: not-allowed;
            transform: none;
        }


        @media (max-width: 768px) {
            .stepBtn {

                width: 100%;
                font-size: 15px;
            }

            h2{
                font-size: 1.2rem;
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

    <style>
        .option:hover {
            background-color: #37577e;
            transform: translateY(-1px);
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            border: 1px solid #a39a9d2b;
        }

        .checkbox-option:hover {

            background-color: #37577e;
            transform: translateY(-1px);
        }

        .checkbox-input {
            display: none;
        }

        .checkbox-custom {
            width: 24px;
            height: 24px;
            border: 2px solid white;
            border-radius: 6px;
            margin-right: 1rem;
            position: relative;
            transition: all 0.2s ease;
        }

        .checkbox-custom:after {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: #fff;
            font-size: 14px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.2s ease;
        }

        .checkbox-input:checked + .checkbox-custom {
            background: #37577e;
        }

        .checkbox-input:checked + .checkbox-custom:after {
            transform: translate(-50%, -50%) scale(1);
        }

        .checkbox-label {
            font-size: 1.1rem;
            color: #fff;
        }

        .error-message {
            color: #ff7675;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            display: none;
        }

        .error-message.visible {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: -19px;
        }


        .phone-input-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
            width: 80%;
            margin: auto;
            margin-bottom: 1rem;
        }

        .country-code {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #333;
            border-radius: 6px;
            font-weight: 500;
        }

        .phone-input {
            flex: 1;
            /*padding: 1rem;*/
            border: 1px solid #333;
            border-radius: 6px;
            background: #000;
            color: #fff;
            font-size: 1.1rem;
        }


    </style>
@endsection
@section('content')

    <div class="py-100 bg-dark">
        <div class="container">
            <div class="form-container">
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
                {{--<h2>Tab4Six</h2>--}}

                <input class="old_answers" hidden value="{{ $old_answers }}">
                <input class="old_step" hidden value="{{ $next_step ?? 1 }}">

                <div class="step-container @if(!$next_step) active @endif" data-step="1">
                    <h2>Join Dinners with 5 amazing Strangers</h2>
                    <div style="width:100%; display: flex">
                        <button class="stepBtn option" data-next="2">
                            <span>Get Started</span>
                        </button>
                    </div>
                    @auth()
                    @else
                    <div style="width:100%; display: flex">
                        <a href="{{ route('login') }}" style="margin-top: 15px; text-align: center; text-decoration: none;" class="stepBtn " data-next="2">
                            <span>Already have an account</span>
                        </a>
                    </div>
                    @endauth
                </div>

                @php
                    $stepNumber = 1; // Start from 1 for the first question
                    $currentLabel = null;
                @endphp

                @foreach($questions as $question)
                    @if($question['type'] == 'label')
                        @php
                            $currentLabel = $question['name'];
                        @endphp
                    @else
                        @php ++$stepNumber; @endphp {{-- Increment step number for non-label questions --}}
                        <div class="step-container @if($next_step && $next_step ==  $stepNumber) active @endif" data-id="{{ $question['id'] }}" data-step="{{ $stepNumber }}">
                            @if ($currentLabel) {{-- Display label if one exists --}}
                            <div class="label-container">
                                <h2>{{ $currentLabel }}</h2>
                            </div>
                            @endif

                            <h2>{{ $question['name'] }}</h2>

                            @if($question['type'] == "multi-choice")
                                @php $answers = json_decode($question['answers_arr'] ,true); @endphp

                                @if(count($answers) == 1)
                                    <div style="width:100%; display: flex">
                                        <input hidden >
                                    </div>
                                    <div style="width:100%; display: flex">
                                        <button class="stepBtn next-button option" data-next="{{ $stepNumber+1 }}">
                                            <span>{{ $answers[0] }}</span>
                                        </button>
                                    </div>

                                @elseif(count($answers) == 3)
                                        <div class="options mutli-choice-option" style="grid-template-columns: repeat(3, minmax(100px, 1fr))">
                                            @foreach($answers as $answer)
                                                <div class="option answer" data-next="{{ $stepNumber+1 }}">
                                                    <span>{{ $answer }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                @else
                                    <div class="options mutli-choice-option" style="grid-template-columns: repeat(2, minmax(100px, 1fr))">
                                        @foreach($answers as $answer)
                                            <div class="option answer" data-next="{{ $stepNumber+1 }}">
                                                <span>{{ $answer }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @elseif($question['type'] == "multi-choice-checkbox")
                                    @php $answers = json_decode($question['answers_arr'] ,true); @endphp

                                    <div class="checkbox-container">
                                        @foreach($answers as $answer)
                                            <label class="checkbox-option">
                                                <input type="checkbox" class="checkbox-input" value="{{ $answer }}">
                                                <div class="checkbox-custom"></div>
                                                <span class="checkbox-label">{{ $answer }}</span>
                                            </label>
                                        @endforeach
                                    </div>

                                    <div class="checkbox-button-container" style="width:100%; display: flex">
                                        <button class="stepBtn checkbox-button option" disabled  data-next="{{ $stepNumber+1 }}">
                                            <span>Next</span>
                                        </button>
                                    </div>

                            @elseif($question['type'] == "phone")
                                <div class="phone-container">
                                    <div class="phone-input-wrapper">
                                        <div class="country-code">
                                            <span>+1</span>
                                        </div>
                                        <input type="text"
                                               class="phone-input"
                                               placeholder="(123) 456-7890">
                                    </div>
                                    <div class="error-message">Please enter a valid phone number</div>
                                    <div class="phone-button-container" style="width:100%; display: flex">
                                        <button class="stepBtn next-button option" disabled  data-next="{{ $stepNumber+1 }}">
                                            <span>Next</span>
                                        </button>
                                    </div>
                                </div>
                            @elseif($question['type'] == "short-text")
                                <div class="short-text-container" style="width:100%; display: flex">
                                    <input  class="short-input">
                                </div>
                                <div class="short-button-container" style="width:100%; display: flex">
                                    <button class="stepBtn next-button option" disabled data-next="{{ $stepNumber+1 }}">
                                        <span>Next</span>
                                    </button>
                                </div>
                            @elseif($question['type'] == "long-text")
                                <div style="width:100%; display: flex">
                                    <textarea  placeholder=""></textarea>
                                </div>
                                <div style="width:100%; display: flex">
                                    <button class="stepBtn next-button option" data-next="{{ $stepNumber+1 }}">
                                        <span>Next</span>
                                    </button>
                                </div>
                            @elseif($question['type'] == "date")
                                    <div class="date-container" >
                                        <input style="display: block;" type="date" class="date-input" >
                                        <br>
                                        <div class="error-message">You must be at least 18 years old to continue.</div>
                                    </div>
                                    <div class="date-button-container" style="width:100%; display: flex">
                                        <button class="stepBtn next-button option"  disabled data-date="1" data-next="{{ $stepNumber+1 }}">
                                            <span>Next</span>
                                        </button>
                                    </div>
                            @elseif($question['type'] == "scale")
                                <div class="options">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="option answer" data-next="{{ $stepNumber+1 }}"><span>{{ $i }}</span></div>
                                    @endfor
                                </div>

                                <br>
                                <span style="color: white" class="mt"> {{ $question['scale_1'] }}</span>
                                <span style="color: white;float: inline-end;"> {{ $question['scale_2'] }}</span>
                            @endif

                        </div>
                    @endif
                @endforeach
                <div class="step-container  @if($next_step == $stepNumber+1) active @endif" data-step="{{ $stepNumber+1 }}">
                    <h2>Thank you!</h2>
                    <div class="completion-message">
                        <i class="fas fa-check-circle"></i>
                        <p>Your preferences have been recorded.</p>
                    </div>
                    <div style="width:100%; display: flex">
                        <a style="text-decoration: none; text-align: center" href="{{ route('register') }}" class="stepBtn saveAnswers" >
                            <span>Next</span>
                        </a>
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

@endsection


@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // handle data collection
        $(document).ready(function () {
            const totalSteps = $('.step-container').length;

            const answersArray = [];

            // Handle option clicks
            $('.answer').on('click', function () {
                const questionId = $(this).closest('.step-container').data('id');
                const questionName = $(this).closest('.step-container').find('h2').text();
                const answer = $(this).find('span').text().trim();

                // Store the answer
                answersArray.push({
                    [questionId]: {
                        questionName: questionName,
                        answer: answer
                    }
                });

                var next_step = $(this).data('next');

                // If it's the last step, log the JSON
                // if (next_step ===  totalSteps) {
                // $('.back-btn').remove();

                const jsonString = JSON.stringify(answersArray, null, 2);
                console.log(jsonString);

                saveAnswers(jsonString,next_step)
                // }
            });

            // Handle next button clicks for short-text, long-text, and date
            $('.next-button').on('click', function () {
                const questionId = $(this).closest('.step-container').data('id');
                const questionName = $(this).closest('.step-container').find('h2').text();
                const answer = $(this).closest('.step-container').find('input, textarea').val().trim();

                // Store the answer
                answersArray.push({
                    [questionId]: {
                        questionName: questionName,
                        answer: answer
                    }
                });


                var next_step = $(this).data('next');

                // If it's the last step, log the JSON
                // if (next_step ===  totalSteps) {
                // $('.back-btn').remove();

                const jsonString = JSON.stringify(answersArray, null, 2);
                console.log(jsonString);

                saveAnswers(jsonString,next_step)
                // }
            });


            $('.checkbox-button').on('click', function () {
                // Find the closest step container
                const stepContainer = $(this).closest('.step-container');
                const questionId = stepContainer.data('id'); // e.g., data-id="step2"
                const questionName = stepContainer.find('h2').text().trim();

                // Find all checked checkboxes within this step container
                const checkedCheckboxes = stepContainer.find('input.checkbox-input:checked');

                // If no checkboxes are selected, alert the user and exit
                if (checkedCheckboxes.length === 0) {
                    return;
                }

                const selectedValues = checkedCheckboxes.map(function() {
                    return $(this).val();
                }).get(); // Converts to a standard array


                answersArray.push({
                    [questionId]: {
                        questionName: questionName,
                        answer: selectedValues, // Use selectedLabels if you prefer labels
                    }
                });

                var next_step = $(this).data('next');

                // If it's the last step, log the JSON
                // if (next_step ===  totalSteps) {
                // $('.back-btn').remove();

                    const jsonString = JSON.stringify(answersArray, null, 2);
                    console.log(jsonString);

                    saveAnswers(jsonString,next_step)
                // }
            });

            function saveAnswers(jsonString, step_number) {
                // Retrieve old answers from the hidden field
                let old_answers = $('.old_answers').val();

                // Ensure old_answers is a valid JSON object
                if (old_answers !== "") {
                    old_answers = JSON.parse(old_answers);
                } else {
                    old_answers = {};
                }

                // Send the AJAX request to store answers
                $.ajax({
                    url: '{{ route('answers.store') }}', // Backend route to store answers temporarily
                    type: 'POST',
                    data: {
                        answers_json: jsonString,
                        old_answers: JSON.stringify(old_answers), // Send as a JSON string
                        next_step: step_number,
                        _token: "{!! csrf_token() !!}" // CSRF token
                    },
                    success: function (response) {
                        console.log('Answers saved successfully.');
                    },
                    error: function (xhr) {
                        console.error('Failed to save answers:', xhr.responseText);
                    }
                });
            }
        });
    </script>

    <script>
        // handle steps
        $(document).ready(function() {
            var old_step = $('.old_step').val(); 

            let currentStep = 1;

            if(old_step){
                currentStep = old_step;
            }
            const totalSteps = $('.step-container').length;

            function updateProgress() {
                const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
                $('.progress').css('width', `${progress}%`);
            }

            function updateBackButton() {
                if (currentStep > old_step) {
                    $('.back-btn').fadeIn();
                }
                else {
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

            // Handle checkbox validation
            $('.checkbox-input').change(function() {
                const checkedCount = $('.checkbox-input:checked').length;
                $('.checkbox-button-container .stepBtn').prop('disabled', checkedCount === 0);
            });

            // const defaultDate = new Date('2000-01-01');
            // $('.date-input').val(defaultDate.toISOString().split('T')[0]);

            // Set min date to 1940
            const minDate = new Date('1940-01-01');
            $('.date-input').attr('min', minDate.toISOString().split('T')[0]);

            // Set max date to today
            const today = new Date();
            $('.date-input').attr('max', today.toISOString().split('T')[0]);


            $('.date-input').change(function() {
                const birthDate = new Date($(this).val());
                const today = new Date();
                const age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();


                // Adjust age if birthday hasn't occurred this year
                const isEighteen = (age > 18 ||
                    (age === 18 && monthDiff >= 0 &&
                        today.getDate() >= birthDate.getDate()));

                // Check if date is before 1940
                if (birthDate < minDate) {
                    $('.error-message').text('Date cannot be earlier than 1940').addClass('visible');
                    $('.date-button-container .stepBtn').prop('disabled', true);
                    return;
                }

                // Check if date is in the future
                if (birthDate > today) {
                    $('.error-message').text('You need to be 18 at least').addClass('visible');
                    $('.date-button-container .stepBtn').prop('disabled', true);
                    return;
                }

                const $errorMessage = $('.error-message');
                const $nextBtn = $('.date-button-container').find('.stepBtn');

                if (!isEighteen) {
                    $errorMessage.addClass('visible');
                    $nextBtn.prop('disabled', true);
                } else {
                    $errorMessage.removeClass('visible');
                    $nextBtn.prop('disabled', false);
                }
            });

            document.querySelectorAll('.short-input').forEach((input) => {
                input.addEventListener('input', () => {
                    // Find the nearest .short-text-container
                    const container = input.closest('.short-text-container');

                    // Get its sibling .short-button-container
                    const buttonContainer = container.nextElementSibling;

                    // Inside it, find the .stepBtn button
                    const button = buttonContainer.querySelector('.stepBtn');

                    // Enable or disable based on input value
                    button.disabled = !input.value.trim();
                });
            });


            const $phoneInput = $('.phone-input');
            const $errorMessage = $('.error-message');
            const $nextBtn = $('.phone-button-container .stepBtn');

            // Function to format the phone number
            function formatPhoneNumber(value) {
                let number = value.replace(/\D/g, ''); // Remove non-digits
                number = number.substring(0, 10); // Limit to 10 digits

                let formattedNumber = '';
                if (number.length > 0) {
                    formattedNumber += '(' + number.substring(0, 3);
                    if (number.length > 3) {
                        formattedNumber += ') ' + number.substring(3, 6);
                        if (number.length > 6) {
                            formattedNumber += '-' + number.substring(6, 10);
                        }
                    }
                }
                return formattedNumber;
            }

            // Function to validate the phone number
            function validatePhoneNumber(number) {
                return /^\(\d{3}\) \d{3}-\d{4}$/.test(number);
            }

            // Handle the input event
            $phoneInput.on('input', function (e) {
                let cursorPosition = this.selectionStart; // Get current cursor position
                let oldValue = this.value;
                let newValue = formatPhoneNumber(this.value);

                // Update input value
                this.value = newValue;


                // Validate the phone number and update the UI
                const isValid = validatePhoneNumber(newValue);
                $errorMessage.toggleClass('visible', !isValid);
                $nextBtn.prop('disabled', !isValid);
            });


            // Handle option selection
            $('.option').click(function() {
                const nextStep = $(this).data('next');

                const is_date = $(this).data('date');
                if(is_date){
                    const answer = $(this).closest('.step-container').find('input, textarea').val().trim();

                    if(answer === ""){
                        $('.error-message').text('Date is required').addClass('visible');
                        $('.date-button-container .stepBtn').prop('disabled', true);
                        // Swal.fire({
                        //     title: 'Error!',
                        //     text: 'please fill this field',
                        //     icon: 'error',
                        //     confirmButtonText: 'Cool'
                        // })
                    }else {
                        if (nextStep) {
                            goToStep(nextStep);
                        }
                    }
                }else {
                    if (nextStep) {
                        goToStep(nextStep);
                    }
                }
            });

            // Handle back button
            $('.back-btn').click(function() {
                if (currentStep > 1) {
                    goToStep(currentStep - 1);
                }

                updateBackButton();

            });

            // Initialize
            updateProgress();
            updateBackButton();
        });
    </script>
@endsection