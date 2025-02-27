@extends('layouts.web.master')

@section('styles')
    <style>
        .notifications-list {
            background: #37577e0a;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .notification-item {
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f0f0f0;
            flex-shrink: 0;
        }

        .notification-content {
            flex: 1;
        }

        .notification-text {
            color: #333;
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .restaurant-info {
            color: #666;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .time-ago {
            color: #999;
            font-size: 12px;
        }

        .user-name {
            color: #333;
            font-weight: 600;
        }

        .important-update {
            color: #ff4f4f;
            font-weight: 600;
        }

        @media (max-width: 480px) {
            .container {
                padding: 12px;
            }

            .header {
                padding: 12px 0;
            }

            .header h1 {
                font-size: 20px;
            }

            .notification-item {
                padding: 12px;
            }

            .avatar {
                width: 32px;
                height: 32px;
            }

            .notification-text {
                font-size: 13px;
            }

            .restaurant-info {
                font-size: 12px;
            }

            .time-ago {
                font-size: 11px;
            }
        }
    </style>

@endsection
@section('content')
    <div class="container pt-130 pb-130 mt-n10 ">
        <div class="row gh-1 gv-1 align-items-center align-items-lg-stretch flex-column flex-lg-row">
            <div class="col-lg-1 d-none d-lg-block order-2 order-lg-2"></div>
            <div class="col-12 col-lg ms-lg-n30 order-4 order-lg-3 show-on-scroll" data-show-duration="600" data-show-distance="10">

                <div class="container">
                    <header class="header">
                        <h6>Earlier</h6>
                    </header>

                    <div class="notifications-list">
                        {{--<div class="notification-item">--}}
                            {{--<img src="https://i.pravatar.cc/150?img=1" alt="Kshitij" class="avatar">--}}
                            {{--<div class="notification-content">--}}
                                {{--<p class="notification-text">--}}
                                    {{--<span class="user-name">Kshitij</span> will be late--}}
                                {{--</p>--}}
                                {{--<p class="restaurant-info">Table 2 - Urban Grill Indian Cuisine</p>--}}
                                {{--<p class="time-ago">18 days ago</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        @foreach($data as $row)

                            <div class="notification-item">
                                {{--<div class="avatar" style="background-color: #ffe5e5;">--}}
                                    {{--<svg viewBox="0 0 24 24" fill="#ff4f4f" width="40" height="40">--}}
                                        {{--<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>--}}
                                    {{--</svg>--}}
                                {{--</div>--}}
                                <div class="notification-content">
                                    {{--<p class="notification-text"><span class="important-update">Important update</span> </p>--}}
                                    <p class="restaurant-info">{{ $row['message'] }}</p>
                                    <p class="time-ago" style="margin: 0">{{ Carbon\Carbon::parse($row['created_at'])->format('D, d M Y , h:s a') }}</p>
                                </div>
                            </div>

                        @endforeach


                    </div>
                </div>

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
@endsection