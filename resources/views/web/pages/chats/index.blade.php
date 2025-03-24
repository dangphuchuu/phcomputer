@extends('web.layout.index')
@section('css')
<link href="web_assets/css/listing.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="/vendors/feather/feather.css">
<link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">

<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" type="text/css" href="/usertemplate/js/select.dataTables.min.css">
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="/css/vertical-layout-light/style.css">
@endsection
@section('content')
<style>
    .chat-list {
        max-height: 500px;
        overflow-y: auto;
    }

    .chat-item {
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
    }

    .chat-item:hover {
        background-color: #f5f5f5;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .chat-details {
        flex: 1;
    }

    .chat-title {
        display: flex;
        align-items: center;
        padding: 10px;
    }

    .chat-message {
        display: flex;
        margin-bottom: 10px;
    }

    .message-avatar {
        margin-right: 10px;
    }

    .message-content {
        background-color: #f2f2f2;
        padding: 10px;
        border-radius: 10px;
    }

    .sender .message-content {
        background-color: #dcf8c6;
    }

    .card-footer {
        padding: 10px;
    }

    .chat-window {
        max-height: 500px;
        overflow-y: auto;
    }

    .chat-message-container {
        min-height: 400px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #ffffff;
        ;
        margin-bottom: 10px;
    }

    .chat-message.sender {
        margin-bottom: 10px;
        text-align: left;
    }

    .chat-message.receiver {
        margin-bottom: 10px;
        text-align: right;
    }

    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #4B49AC;
        border-color: #4B49AC;
    }

    .chat-message {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .chat-message .message-avatar img {
        width: 40px;
        height: 40px;
    }

    .chat-message .message-content {
        display: inline-block;
        padding: 10px;
        border-radius: 5px;
        background-color: #f1f1f1;
        margin: 0 10px;
        max-width: 70%;
    }

    .chat-message.sender .message-content {
        background-color: #d1e7dd;
        /* Example color for sender */
        text-align: right;
        margin-left: auto;
        /* Align right */
    }

    .chat-message.sender {
        flex-direction: row-reverse;
    }

    .chat-message .timestamp {
        font-size: 0.8em;
        color: #888;
    }

    .chat-message.sender .timestamp {
        margin-right: 10px;
    }

    .profile_card {
        display: flex;
        align-items: center;
        padding: 15px;
        margin: 10px 0;
        background-color: #f8f9fa;
        /* Light background color */
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        transition: transform 0.2s;
        /* Animation for hover effect */
    }

    .profile_card:hover {
        transform: translateY(-5px);
        /* Lift the card on hover */
    }

    .profile_img {
        width: 60px;
        /* Avatar size */
        height: 60px;
        margin-right: 15px;
        border: 2px solid #007bff;
        /* Border color matching badge */
    }

    .chat-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .profile_name {
        font-size: 1.1em;
        /* Slightly larger font size */
        font-weight: bold;
        color: #343a40;
        /* Darker text color */
        margin-bottom: 5px;
    }

    .badge-primary {
        background-color: #007bff;
        /* Badge background color */
        color: #fff;
        /* Badge text color */
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9em;
        align-self: flex-start;
        /* Align the badge to the start */
    }
    #chat_img {
    display: none;
    }
</style>
<div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">


                                <br>
                                <div class="col-md-12 mt-4 grid-margin">
                                    <div class="row">
                                        <!-- Left column: Chat list -->
                                        <div class="col-md-4 col-lg-3">
                                            <div class="card shadow-sm">
                                                <div class="card-header bg-primary text-white">
                                                    <h4 class="mb-0">Chats</h4>
                                                </div>
                                                <div class="list-group chat-list" id="chatList" style="max-height: 500px; overflow-y: auto;">
                                                    <ul class="list-group list-group-flush">
                                                        @if(isset($admins))
                                                        @foreach ($admins as $admin)
                                                        <li class="list-group-item d-flex align-items-center chat-item">
                                                            @if($admin->image == NULL)
                                                            <img src="images/avatar/avatar.png" class="profile_img rounded-circle mr-3" style="width: 40px; height: 40px;" alt="Profile Picture">
                                                            @else
                                                            @if(strstr($admin->image,"https") == "")
                                                            <img src="https://res.cloudinary.com/{{env('CLOUD_NAME')}}/image/upload/{{$admin->image}}.jpg" class="profile_img rounded-circle mr-3" style="width: 40px; height: 40px;" alt="Profile Picture">
                                                            @else
                                                            <img src="images/avatar/avatar.png" class="profile_img rounded-circle mr-3" style="width: 40px; height: 40px;" alt="Profile Picture">
                                                            @endif
                                                            @endif
                                                            <div class="profile_info">
                                                                <span class="profile_name font-weight-bold">{{ $admin->firstname }}</span>
                                                                <span class="id" style="display: none;">{{ $admin->id }}</span>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right column: Chat area -->
                                        <div class="col-md-8 col-lg-9">
                                            <div class="card shadow-sm">
                                                <div class="card-header bg-primary text-white">
                                                    <div class="d-flex align-items-center">
                                                        <img id="chat_img" src="" class="rounded-circle mr-3" alt="Profile Picture" style="width: 40px; height: 40px;">
                                                        <h4 class="mb-0" id="chat_name">Chatting with</h4>
                                                    </div>
                                                </div>

                                                <div class="card-body chat-window" style="height: 400px; overflow-y: auto;">
                                                    <div class="chat-message-container" id="chatMessageContainer">
                                                        <!-- Chat messages will be dynamically loaded here -->
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <form id="messageForm" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="receiver_id" id="receiver_id">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Type your message here..." id="messageInput" name="message">
                                                            <button class="btn btn-primary" type="submit" id="sendMessageButton">Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">

                        </div>
                    </div>



                  
                </div>
                <!-- main-panel ends -->
            </div>
@endsection
@section('scripts')
<script src="web_assets/js/sticky_sidebar.min.js"></script>
<script src="web_assets/js/specific_listing.js"></script>
<script src="{{ asset('/build/assets/app-D1ylovWN.js') }}"></script>

        <!-- container-scroller -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- plugins:js -->
        <script src="/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="/vendors/chart.js/Chart.min.js"></script>
        <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="/js/dataTables.select.min.js"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="/js/off-canvas.js"></script>
        <script src="/js/hoverable-collapse.js"></script>
        <script src="/js/template.js"></script>
        <script src="/js/settings.js"></script>
        <script src="/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="/js/dashboard.js"></script>
        <script src="/js/Chart.roundedBarCharts.js"></script>
        <!-- End custom js for this page-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
        <script>
    // Initialize Pusher
    var pusher = new Pusher('b3395ea5489aee8f8c14', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe to the 'admin-messages' channel
    var channel = pusher.subscribe('admin-messages');

    // Bind to the 'admin-message' event
    channel.bind('admin-message', function(data) {
        console.log('Message received:', data);

        let senderId = data.sender_id;
        let message = data.message;
        let senderName = data.admin.name;
        let senderImage = data.admin.image;
        let messageTime = new Date(data.created_at).toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        });

        // Create message HTML with proper asset URL
        let messageHtml = `
            <div class="chat-message receiver"> <!-- Left alignment for received messages -->
                <div class="message-avatar">
                    <img src="https://res.cloudinary.com/{{env('CLOUD_NAME')}}/image/upload/${senderImage}.jpg" class="rounded-circle avatar" alt="${senderName} Avatar">
                </div>
                <div class="message-content">
                    <p><strong>${senderName}:</strong> ${message}</p>
                    <div class="timestamp">${messageTime}</div>
                </div>
            </div>`;

        // Append message to chat container
        document.getElementById('chatMessageContainer').insertAdjacentHTML('beforeend', messageHtml);
    });
</script> 
    <!-- JavaScript to handle profile card click -->
    <script>
$(document).ready(function() {
    // Lấy tin nhắn cũ khi trang tải
    fetchMessages();
    
// Bind click event to the chat-item list elements
$('.chat-item').on('click', function() {
    fetchMessages($(this));
});
function fetchMessages(element = null) {
    let receiverId = element ? element.find('.id').text() : $('#receiver_id').val();
    let profileImage = element ? element.find('.profile_img').attr('src') : $('#chat_img').attr('src');
    let profileName = element ? element.find('.profile_name').text() : $('#chat_name').text().replace('Chatting with ', '');

    if (element) {
        $('#receiver_id').val(receiverId);
        $('#chat_img').attr('src', profileImage);
        $('#chat_name').text('Chatting with ' + profileName);
        $('#chat_img').css('display', 'inline-block'); 
    }

    $.ajax({
        url: '{{ route('fetch.messagesFromSellerToAdmin') }}',
        method: 'GET',
        data: {
            receiver_id: receiverId
        },
        success: function(response) {
            $('#chatMessageContainer').empty();

            response.messages.forEach(function(message) {
                let isSender = message.sender_id == '{{ session('LoggedUserInfo') }}';
                let userAvatar = isSender ? '{{ $LoggedUserInfo->image }}' : profileImage;
                let userName = isSender ? '{{ $LoggedUserInfo->firstname }}' : profileName;

                let messageTime = new Date(message.created_at).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                let imageUrl = getImageUrl(userAvatar);

                let messageHtml = `
                    <div class="chat-message ${isSender ? 'sender' : 'receiver'}">
                        <div class="message-avatar">
                            <img src="${imageUrl}" class="rounded-circle avatar" alt="User Avatar">
                        </div>
                        <div class="message-content">
                            <p><strong>${userName}:</strong> ${message.message}</p>
                            <div class="timestamp">${messageTime}</div>
                        </div>
                    </div>`;

                $('#chatMessageContainer').append(messageHtml);
            });

            $('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0].scrollHeight);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching messages:', error);
        }
    });
}
function getImageUrl(userAvatar) {
    let cloudName = `{{ env('CLOUD_NAME') }}`; 
    let imageUrl = '';

    if (userAvatar.startsWith('https://res.cloudinary.com/')) {
        imageUrl = userAvatar;
    } else if (userAvatar.includes('/')) {
        imageUrl = `https://res.cloudinary.com/${cloudName}/image/upload/${userAvatar}`;
    } else {
        imageUrl = `https://res.cloudinary.com/${cloudName}/image/upload/${userAvatar}.jpg`;
    }

    return imageUrl;
}
    $('#messageForm').on('submit', function(e) {
    e.preventDefault();

    let message = $('#messageInput').val().trim();
    let receiverId = $('#receiver_id').val();

    if (message === "") {
        alert("Message cannot be empty.");
        return;
    }

    $.ajax({
        type: 'POST',
        url: '{{ route('send.Messageofsellertoadmin') }}',
        data: {
            _token: $('input[name="_token"]').val(),
            message: message,
            receiver_id: receiverId
        },
        beforeSend: function() {
            // Disable the send button and change its text to "Sending..."
            $('#sendMessageButton').text('Sending...').attr('disabled', true);
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message, "Success");
                $('#messageInput').val(''); // Clear the input

                let userAvatar = '{{ $LoggedUserInfo->image }}';
                let userName = '{{ $LoggedUserInfo->firstname }}';

                let messageTime = new Date().toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                let messageHtml = `
                    <div class="chat-message sender">
                        <div class="message-avatar">
                            <img src="https://res.cloudinary.com/{{env('CLOUD_NAME')}}/image/upload/${userAvatar}.jpg" class="rounded-circle avatar" alt="User Avatar">
                        </div>
                        <div class="message-content">
                            <p><strong>${userName}:</strong> ${message}</p>
                            <div class="timestamp">${messageTime}</div>
                        </div>
                    </div>`;

                $('#chatMessageContainer').append(messageHtml);

                // Scroll to the bottom of the chat container after sending a message
                $('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0].scrollHeight);
            } else {
                toastr.error(response.message, "Error");
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseJSON.message);
            toastr.error('Failed to send message', "Error");
        },
        complete: function() {
            // Re-enable the send button and change its text back to "Send"
            $('#sendMessageButton').text('Send').attr('disabled', false);
        }
    });
});
});
</script>
@endsection