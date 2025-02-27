@extends('layouts.web.master')

@section('styles')


    <style>
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
            position: relative;
        }

        .profile-image-container {
            position: relative;
            width: 100px;
            height: 100px;
            margin-bottom: 12px;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .edit-image-btn {
            color: black;
            background: none;
            border: none;
            font-size: 14px;
            cursor: pointer;
            padding: 8px;
        }

        #image-upload {
            display: none;
        }

        .section-card {
            background: #37577e0a;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #333;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #666;
            font-size: 14px;
            min-width: 120px;
        }

        .info-value {
            flex: 1;
            color: #333;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .info-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            margin-left: 12px;
            outline: none;
            transition: border-color 0.3s;
        }

        .info-input:focus {
            border-color: black;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: black;
        }

        input:checked + .slider:before {
            transform: translateX(20px);
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

        .save-btn {
            background-color: black;
            color: white;
            margin-top: 24px;
        }

        .save-btn:hover {
            background-color: black;
        }

        .logout-btn {
            background-color: #fff;
            color: black;
            border: 1px solid black;
        }

        .logout-btn:hover {
            background-color: #37577e0a;
        }

        .delete-btn {
            background-color: #fff;
            color: black;
            border: 1px solid black;
        }

        .delete-btn:hover {
            background-color: #37577e0a;
        }

        .support-text {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 24px;
        }

        @media (min-width: 768px) {
            .container {
                padding: 40px;
            }

            .section-card {
                padding: 24px;
            }

            .info-item {
                padding: 16px 0;
            }

            .info-label, .info-value, .info-input {
                font-size: 16px;
            }
        }
    </style>

    <style>
        /* Modal */
        .modal {
            visibility: hidden;
            opacity: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease-out;
        }

        .modal.active {
            visibility: visible;
            opacity: 1;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            padding: 32px;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        .modal.active .modal-content {
            transform: scale(1);
            opacity: 1;
        }

        .modal-header {
            display: block;
            margin-bottom: 0px;
            text-align: center;
            padding: 0;
            border: none;

        }

        .modal-title {
            color: #333;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .modal-description {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .modal-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .cancel-btn {
            background-color: #f5f5f5;
            color: #333;
        }

        .cancel-btn:hover {
            background-color: #eaeaea;
        }

        .confirm-btn {
            background-color: #ff4444;
            color: white;
        }

        .confirm-btn:hover {
            background-color: #ff2222;
        }

        @media (max-width: 480px) {
            .modal-content {
                padding: 24px;
            }

            .modal-buttons {
                flex-direction: column;
            }

            .modal-btn {
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container pt-130 pb-130 mt-n10 ">
        <div class="row gh-1 gv-1 align-items-center align-items-lg-stretch flex-column flex-lg-row">
            <div class="col-lg-1 d-none d-lg-block order-2 order-lg-2"></div>
            <div class="col-12 col-lg ms-lg-n30 order-4 order-lg-3 show-on-scroll" data-show-duration="600" data-show-distance="10">

                <div class="h5 text-center" style="">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <span class="text-danger" role="alert">
                        <strong style="font-size: 13px; font-weight: 400;">{{ $error }}</strong><br>
                    </span>
                        @endforeach
                    @endif
                    @include('flash::message')
                </div>
                <form  id="profile-form" class="form" method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">

                    @csrf
                    <br>
                    <br>
                    <div class="profile-header">
                        <div class="profile-image-container">
                            <img src="@if(isset(auth()->user()->profile_pic)) {{ asset(auth()->user()->profile_pic) }} @else {{ asset('avatar.png') }} @endif" alt="Profile" class="profile-image" id="profile-image">
                        </div>
                        <input type="file" id="image-upload" name="image" accept="image/*">
                        <button type="button" class="edit-image-btn" onclick="document.getElementById('image-upload').click()">Edit Image</button>
                    </div>

                    <div class="section-card">
                        <h2 class="section-title">BASIC INFO</h2>
                        <div class="info-item">
                            <span class="info-label">name</span>
                            <div class="info-value">
                                <input type="text" class="info-input" name="name" value="{{ auth()->user()->name }}" required>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <div class="info-value">
                                <input type="email" class="info-input" name="email" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Password</span>
                            <div class="info-value">
                                <input type="password" class="info-input" name="password" autocomplete="" autofocus  >
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Confirm Password</span>
                            <div class="info-value">
                                <input type="password" class="info-input" name="password_confirmation" autocomplete="off" >
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone number</span>
                            <div class="info-value">
                                <input type="tel" class="info-input" name="phone" value="">
                            </div>
                        </div>
                    </div>

                    <div class="section-card">
                        <h2 class="section-title">NOTIFICATIONS</h2>
                        {{--<div class="info-item">--}}
                            {{--<span class="info-label">App Notification</span>--}}
                            {{--<label class="toggle-switch">--}}
                                {{--<input type="checkbox" name="enable_app_ntf" checked>--}}
                                {{--<span class="slider"></span>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        <div class="info-item">
                            <span class="info-label">Email Notification</span>
                            <label class="toggle-switch">
                                <input type="checkbox" name="enable_notifications" @if(auth()->user()->enable_notifications) checked @endif>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    @if(auth()->user()->subscribed())
                        <div class="section-card">
                            <h2 class="section-title">SUBSCRIPTION</h2>
                            <div class="info-item">
                                <a href="{{ route('subscription') }}" class="info-label">Manage My Subscription</a>
                                <span class="info-value">›</span>
                            </div>
                        </div>
                    @endif

                    <div class="section-card">
                        <h2 class="section-title">LEGAL</h2>
                        <div class="info-item">
                            <span class="info-label">Privacy Policy</span>
                            <span class="info-value">›</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Terms & Conditions</span>
                            <span class="info-value">›</span>
                        </div>
                    </div>

                    <button type="submit" class="action-button save-btn">Save Changes</button>
                    {{--<button type="button" class="action-button logout-btn">Log out</button>--}}
                    <a style="text-decoration: none; justify-content: center; display: flex" onclick="openResetModal()" data-action="{{ route('submission.reset') }}" type="button" class="action-button delete-btn restBtn">Reset my submission</a>

                    <a style="text-decoration: none; justify-content: center; display: flex; background: red; color: white" onclick="openModal()" data-action="{{ route('account.delete') }}" type="button" class=" action-button delete-btn delBtn">Delete my account</a>

                    <p class="support-text">Please email us at info@tab4six.com</p>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Delete Account</h2>
                <br>
                <p class="modal-description">
                    Are you sure you want to delete your account? This action cannot be undone and all your data will be permanently deleted.
                </p>
            </div>
            <div class="modal-buttons">
                <button class="modal-btn cancel-btn" onclick="closeModal()">Cancel</button>
                <a id="delete_record_btn" style="text-decoration: none; text-align: center" href="" class="modal-btn confirm-btn">Delete Account</a>
            </div>
        </div>
    </div>

    <div class="modal" id="resetModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reset Your Submission</h2>
                <br>
                <p class="modal-description">
                    Are you sure you want to reset your submission? This action cannot be undone.
                </p>
            </div>
            <div class="modal-buttons">
                <button class="modal-btn cancel-btn" onclick="closeResetModal()">Cancel</button>
                <a id="reset_record_btn" style="text-decoration: none; text-align: center" href="" class="modal-btn confirm-btn">Reset</a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Handle image upload
        const imageUpload = document.getElementById('image-upload');
        const profileImage = document.getElementById('profile-image');

        imageUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle form submission
        function handleSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData);
            console.log('Form data:', data);
            // Here you would typically send the data to your backend
            alert('Profile updated successfully!');
        }

        // Handle logout
        document.querySelector('.logout-btn').addEventListener('click', () => {
            if (confirm('Are you sure you want to log out?')) {
                console.log('Logging out...');
                // Add logout logic here
            }
        });

        // Handle account deletion
        document.querySelector('.delete-btn').addEventListener('click', () => {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                console.log('Deleting account...');
                // Add account deletion logic here
            }
        });
    </script>

    <script>
        const modal = document.getElementById('deleteModal');

        const reset_modal = document.getElementById('resetModal');

        function openModal() {
            modal.classList.add('active');

            var action = $('.delBtn').data('action');

            $('#delete_record_btn').attr('href', action);
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        function openResetModal() {
            reset_modal.classList.add('active');

            var action = $('.restBtn').data('action');

            $('#reset_record_btn').attr('href', action);
        }

        function closeResetModal() {
            reset_modal.classList.remove('active');
        }

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
                closeResetModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
                closeResetModal();
        }
        });
    </script>

@endsection