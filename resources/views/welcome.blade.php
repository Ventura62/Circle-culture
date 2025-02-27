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
            background-image: url({{ asset('cover.jpeg') }});
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

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="text-danger" role="alert">
                        <strong style="font-size: 13px; font-weight: 400;">{{ $error }}</strong><br>
                    </span>
                    @endforeach
                @endif
                @include('flash::message')
            </div>
            <br>

            <h1 style="font-weight: 500; ">72 DUO INTEREST FORM</h1>
            <span>We group people in 3-5 other compatible individuals for dinner.
                <br/>
We will notify you via email once 72 Duo officially launches.</span>

            <br>
            <br>

            <form id="nameForm"  action="{{ route('submission.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="firstName">Full name</label>
                    <input type="text" id="name" name="name" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="lastName">Email</label>
                    <input type="email" id="email" name="email" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="lastName">City</label>
                    <input type="text" id="city" name="city" placeholder="" required>
                </div>

                <div class="input-group">
                    <label for="lastName">Social Media/LinkedIn URL</label>
                    <input type="text" id="lastName"  name="social_media" placeholder="" required>
                </div>
                <button id="submitBtn" type="submit" class="next-button">
                    <span>Submit</span>
                </button>
            </form>
        </div>
    </div>
    <div class="image-section"></div>
</div>
<script>
    document.getElementById('submitBtn').addEventListener('click', function (e) {
        // Get the submit button and its original text
        const submitButton = this.querySelector('.next-button span');

        // Check if the form is valid
        const form = document.getElementById('nameForm');
        if (form.checkValidity()) {
            // Change button text to "Please wait..." if the form is valid
            submitButton.textContent = 'Please wait...';

            // Submit the form
            form.submit();
        } else {
            // If form is invalid, prevent submission
            e.preventDefault();
            form.reportValidity(); // Optionally show validation errors
        }
    });


</script>
</body>
</html>