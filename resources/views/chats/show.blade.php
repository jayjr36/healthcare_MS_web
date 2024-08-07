@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-items-center py-3">
        <div class="col-md-7 card">
            <h3>Chat with {{ $user->name }}</h3>
            <div id="messages">
                @foreach ($messages as $message)
                    <p data-message-id="{{ $message->id }}" style="background-color: {{ $message->sender_id == Auth::id() ? 'lightgreen' : 'lightgrey' }};">
                        {{ $message->message }}
                    </p>
                @endforeach
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <form id="sendMessage" method="POST" class="d-flex">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                        <textarea name="message" id="messageInput" class="form-control me-2" rows="1" style="resize: none;" required></textarea>
                        <button class="btn btn-success" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sendMessage').on('submit', function(e) {
            e.preventDefault();
            let message = $('#messageInput').val();
            let receiver_id = $('input[name="receiver_id"]').val();

            $.ajax({
                url: "{{ route('chats.send') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message: message,
                    receiver_id: receiver_id
                },
                success: function(response) {
                    appendMessage(response);
                    $('#messageInput').val('');
                },
                error: function(xhr, status, error) {
                    console.error('Error sending message:', error);
                }
            });
        });

        // Function to append a message to the chat
        function appendMessage(message) {
            let messageColor = message.sender_id == {{ Auth::id() }} ? 'lightgreen' : 'lightgrey';
            $('#messages').append('<p data-message-id="' + message.id + '" style="background-color: ' + messageColor + ';">' + message.message + '</p>');
        }

        // Function to fetch messages
        function fetchMessages() {
            $.ajax({
                url: "{{ route('chats.show', $user->id) }}",
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Fetched messages:', data);
                    if (Array.isArray(data)) {
                        $('#messages').empty(); // Clear existing messages
                        data.forEach(function(message) {
                            appendMessage(message);
                        });
                    } else {
                        console.error('Received unexpected response:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching messages:', error);
                }
            });
        }

        setInterval(fetchMessages, 500); // Fetch new messages every 500ms
    });
</script>
@endsection
