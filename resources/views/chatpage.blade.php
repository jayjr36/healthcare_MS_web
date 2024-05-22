<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Chat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Chat with Patients</h2>
        <div class="row">
            <div class="col-md-3">
                <div id="user-list" class="border p-3" style="height: 300px; overflow-y: scroll;">
                    <!-- User list will be populated here -->
                </div>
            </div>
            <div class="col-md-9">
                <div id="chat-box" class="border p-3" style="height: 300px; overflow-y: scroll;"></div>
                <input type="text" id="message" class="form-control mt-3" placeholder="Type your message...">
                <button id="send" class="btn btn-primary mt-2">Send</button>
            </div>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const messageInput = document.getElementById('message');
        const sendButton = document.getElementById('send');
        const userList = document.getElementById('user-list');
        let currentUser = null;
        let currentDoctorId = 1; // Replace with actual logged-in doctor id
        let currentPatientId = null;

        // Function to load user list via AJAX
        function loadUsers() {
            fetch('/get-users', {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')  // Adjust as needed for your auth method
                }
            })
            .then(response => response.json())
            .then(users => {
                userList.innerHTML = '';
                users.forEach(user => {
                    const userElement = document.createElement('div');
                    userElement.classList.add('user-item');
                    userElement.innerHTML = `
                        <span>${user.name}</span>
                        <button class="btn btn-sm btn-primary ml-2" data-user-id="${user.id}">Chat</button>
                    `;
                    userElement.querySelector('button').addEventListener('click', () => startConversation(user));
                    userList.appendChild(userElement);
                });
            });
        }

        // Function to start a conversation
        function startConversation(user) {
            currentUser = user;
            currentPatientId = user.id;
            chatBox.innerHTML = '';  // Clear previous chat
            loadMessages(currentDoctorId, currentPatientId);
        }

        // Function to load messages via AJAX
        function loadMessages(doctorId, patientId) {
            fetch(`/get-messages/${doctorId}/${patientId}`, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')  // Adjust as needed for your auth method
                }
            })
            .then(response => response.json())
            .then(messages => {
                chatBox.innerHTML = '';
                messages.forEach(message => {
                    chatBox.innerHTML += `<p><strong>${message.user.name}:</strong> ${message.message}</p>`;
                });
            });
        }

        // Function to send a message via AJAX
        function sendMessage() {
            const message = messageInput.value;
            if (message.trim() !== '' && currentPatientId) {
                fetch(`/send-message/${currentPatientId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Authorization': 'Bearer ' + localStorage.getItem('token')  // Adjust as needed for your auth method
                    },
                    body: JSON.stringify({
                        message: message
                    })
                }).then(response => response.json())
                  .then(data => {
                      chatBox.innerHTML += `<p><strong>You:</strong> ${data.message}</p>`;
                      messageInput.value = '';
                  });
            }
        }

        sendButton.addEventListener('click', sendMessage);

        // Periodically check for new messages
        setInterval(() => {
            if (currentPatientId) {
                loadMessages(currentDoctorId, currentPatientId);
            }
        }, 1000);

        // Initial load of users
        loadUsers();
    </script>
</body>
</html>
