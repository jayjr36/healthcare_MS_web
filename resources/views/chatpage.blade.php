<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Chat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Chat with Patients</h2>
        <div id="chat-box" class="border p-3" style="height: 300px; overflow-y: scroll;"></div>
        <input type="text" id="message" class="form-control mt-3" placeholder="Type your message...">
        <button id="send" class="btn btn-primary mt-2">Send</button>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const messageInput = document.getElementById('message');
        const sendButton = document.getElementById('send');

        sendButton.addEventListener('click', () => {
            const message = messageInput.value;
            // Send the message via AJAX
        });

        // Initialize Pusher
        Pusher.logToConsole = true;

        const pusher = new Pusher('your-pusher-key', {
            cluster: 'your-pusher-cluster'
        });

        const channel = pusher.subscribe('chat');
        channel.bind('message', function(data) {
            // Append the message to the chat box
            chatBox.innerHTML += `<p><strong>${data.user.name}:</strong> ${data.message}</p>`;
        });
    </script>
</body>
</html>
