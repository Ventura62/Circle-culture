@extends('layouts.web.master')

@section('styles')

    <style>
        p {
            margin-bottom: 0;
        }

        .chat-container {
            display: flex;
            height: 100vh;
            background: #f0f2f5;
            overflow: hidden;
        }

        /* Users list styles */
        .users-list {
            width: 100%;
            background: white;
            border-right: 1px solid #e5e7eb;
            flex-shrink: 0;
            height: 100vh;
            overflow-y: auto;
            margin-top: 90px;
        }

        .users-header {
            position: sticky;
            top: 0;
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            background: white;
            z-index: 10;
        }

        .users-header h1 {
            font-size: 20px;
            color: #1a1a1a;
        }



        .user-item:hover {
            background-color: #f5f6f7;
        }

        .user-item.active {
            background-color: #e7f0ff;
        }

        .user-item {
            display: flex;
            align-items: center;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .delete-contact {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 12px;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease;
        }


        .user-item:hover .delete-contact {
            opacity: 1;
        }

        .delete-contact:hover {
            background: #b91c1c;
            color: white;
        }

        .unread-badge {
            position: absolute;
            right: 51px;
            top: 50%;
            transform: translateY(-50%);
            background: #0084ff;
            color: white;
            border-radius: 12px;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 600;
            /*display: none;*/
        }

        .unread-badge.visible {
            display: block;
        }


        /* Avatar styles */
        .avatar-container {
            position: relative;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .status-dot {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .status-dot.online {
            background-color: #22c55e;
        }

        .status-dot.offline {
            background-color: #94a3b8;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-info h3 {
            font-size: 14px;
            color: #1a1a1a;
            margin-top: 5px;
            margin-bottom: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-info p {
            font-size: 12px;
            color: #64748b;
        }

        .actions-dropdown {
            position: relative;
            margin-left: auto;
            padding-left: 16px;
        }



        .actions-dropdown button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .actions-dropdown .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 8px 0;
            z-index: 10;
        }

        .actions-dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropwon-togle {
            background: none;
            border: none;
            padding: 4px;
            cursor: pointer;
            color: #64748b;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .user-item:hover .dropwon-togle {
            opacity: 1;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            min-width: 120px;
            z-index: 100;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 8px 16px;
            color: #1a1a1a;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-item:hover {
            background-color: #f5f6f7;
        }

        .dropdown-item.delete {
            color: #dc2626;
        }

        .dropdown-item svg {
            width: 16px;
            height: 16px;
        }

        /* Chat area styles */
        .chat-area {
            margin-top: 90px;
            display: none;
            flex: 1;
            flex-direction: column;
            background: #f8fafc;
        }

        .chat-area.active {
            display: flex;
        }

        .chat-header {
            padding: 16px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .messages {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message {
            max-width: 85%;
            clear: both;
            word-wrap: break-word;
        }

        .message-content {
            padding: 12px 16px;
            border-radius: 16px;
            position: relative;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .message.sent {
            align-self: flex-end;
        }

        .message.sent .message-content {
            background: #000;
            color: white;
            border-bottom-right-radius: 4px;
        }

        .message.received {
            align-self: flex-start;
        }

        .message.received .message-content {
            background: white;
            color: #1a1a1a;
            border-bottom-left-radius: 4px;
        }

        .message-time {
            font-size: 12px;
            margin-top: 4px;
            opacity: 0.7;
            text-align: right;
        }

        /* Input area styles */
        .input-area {
            padding: 16px;
            background: white;
            border-top: 1px solid #e5e7eb;
            position: sticky;
            bottom: 0;
        }

        .input-container {
            display: flex;
            gap: 8px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .message-input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            outline: none;
            font-size: 15px;
            transition: border-color 0.2s ease;
        }

        .message-input:focus {
            border-color: #000;
        }

        .send-button {
            padding: 12px 24px;
            background: #000;
            color: white;
            border: none;
            border-radius: 24px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .send-button:hover {
            background: #000;
        }

        .send-button svg {
            width: 20px;
            height: 20px;
        }

        /* Empty state styles */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #64748b;
            text-align: center;
            padding: 24px;
        }

        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            color: #94a3b8;
        }

        .empty-state p {
            font-size: 16px;
            max-width: 300px;
            line-height: 1.5;
        }

        /* Back button styles */
        .back-button {
            display: none;
            margin-right: 12px;
            padding: 8px;
            background: none;
            border: none;
            cursor: pointer;
            color: #64748b;
            font-size: 24px;
        }

        /* Responsive styles */
        @media (min-width: 768px) {
            .users-list {
                width: 320px;
            }

            .chat-area {
                display: flex;
            }

            .back-button {
                display: none !important;
            }
        }

        @media (max-width: 767px) {
            .messages {
                margin-bottom: 183px;
            }
            .chat-container {
                position: relative;
            }

            .input-area {
                position: fixed;
                width: 100%;
                bottom: 0;
            }

            .users-list {
                width: 100%;
            }

            .chat-area {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 20;
            }

            .chat-area.active {
                display: flex;
            }

            .back-button {
                display: block;
            }

            .message {
                max-width: 90%;
            }
        }

        @media (max-width: 480px) {
            .user-item {
                padding: 12px;
            }

            .avatar {
                width: 40px;
                height: 40px;
            }

            .message {
                max-width: 95%;
            }

            .message-input {
                padding: 10px 14px;
            }

            .send-button {
                padding: 10px 16px;
            }

            .send-button span {
                display: none;
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
    <div class="chat-container">
        <div class="users-list">
            <div class="users-header">
                <h1>Contacts</h1>
            </div>
            <div class="users-container">
                @foreach($contacts as $contact)
                    <div style="text-decoration: none" class="user-item" data-user-id="{{ $contact['id'] }}" onclick="openChat('{{ $contact['id'] }}')">
                        <div class="avatar-container">
                            <img src="@if(isset($contact['profile_pic'])) {{ asset($contact['profile_pic']) }} @else {{ asset('avatar.png') }} @endif" alt="John Doe" class="avatar">
                        </div>
                        <div class="user-info">
                            <h3 style="font-weight: 800">{{ $contact['name'] }}</h3>
                            <div style="font-weight: 300" class="last-message">{{ $contact['last_message'] ?? '' }}</div>
                        </div>
                        @if($contact['unread_count'] > 0)
                            <div class="unread-badge">{{ $contact['unread_count'] }}</div>
                        @endif
                        <div class="actions-dropdown" onclick="event.stopPropagation();">
                            <button class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('contact.remove', $contact['id']) }}" class="dropdown-item submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    Delete
                                </a>

                                <a onclick="openModal(this)"  data-id="{{ $contact['id'] }}" class="dropdown-item">
                                    <span class="nav-link-name"><i class="fa fa-pen"></i></span>

                                    Report
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="chat-area">
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p>Select a user to start chatting</p>
            </div>

        </div>
    </div>

    <div class="modal" id="reportModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Report User</h2>
                <br>

            </div>
            <form method="post" action="{{ route('contact.report') }}">
                <div class="modal-body">
                    @csrf

                    <input hidden name="contact_id" class="form-control contact_id">
                    <p class="modal-description">
                        Tell us what went wrong
                    </p>
                    <br>
                    <textarea class="form-control" name="message" placeholder=""></textarea>
                </div>
                <div class="modal-buttons">
                    <button class="modal-btn cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" style="text-decoration: none; text-align: center" href="" class="modal-btn confirm-btn">Report</button>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')


    <script>
        function openChat(userId) {
            window.location.href = `/chat?user_id=${userId}`;
        }

        $(document).ready(function() {
            // Close dropdowns when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('.actions-dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });

            // Toggle dropdown
            $('.dropwon-togle').click(function(e) {
                e.stopPropagation();
                const dropdown = $(this).siblings('.dropdown-menu');
                $('.dropdown-menu').not(dropdown).removeClass('show');
                dropdown.toggleClass('show');
            });

            // Delete action
            $('.dropdown-item.delete').click(function(e) {
                e.stopPropagation();
                if (confirm('Are you sure you want to delete this contact?')) {
                    $(this).closest('.user-item').remove();
                }
                $(this).closest('.dropdown-menu').removeClass('show');
            });

            // Previous click handlers remain the same
            $('.user-item').click(function(e) {
                if (!$(e.target).closest('.actions-dropdown').length) {
                    $('.user-item').removeClass('active');
                    $(this).addClass('active');
                    $('.chat-area').addClass('active');
                }
            });

            // Rest of the previous JavaScript remains the same
        });
    </script>

    <script>
        const modal = document.getElementById('reportModal');

        function openModal(instance) {
            modal.classList.add('active');

            var id = $(instance).data('id');

            $('.contact_id').val(id)
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        function deleteAccount() {


            closeModal();
        }

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
            }
        });
    </script>
@endsection