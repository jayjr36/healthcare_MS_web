<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Video Call</title>
    <script src="https://cdn.agora.io/sdk/web/AgoraRTCSDK-4.5.0.js"></script>
</head>

<body>
    <div id="local_stream"></div>
    <div id="remote_stream"></div>
    <button onclick="endCall()">End Call</button>

    <script>
        const appId = '1ff91545cedb4f4c91ab2eb157fdd07e'; // Replace with your Agora App ID
        const serverUrl = 'http://127.0.0.1:8000/api';

        let rtc = {
            client: null,
            localAudioTrack: null,
            localVideoTrack: null,
            remoteUsers: []
        };

        async function startCall(channelName) {
            let userId = localStorage.getItem('user_id');
            if (!userId) {
                userId = prompt('Enter your user ID:');
                localStorage.setItem('user_id', userId);
            }

            try {
                // Create Agora client
                rtc.client = AgoraRTC.createClient({
                    mode: 'live',
                    codec: 'h264'
                });
                rtc.client.init(appId, () => console.log('AgoraRTC client initialized'));

                // Join a channel
                rtc.client.join(null, channelName, userId, () => {
                    console.log('User ' + userId + ' joined channel ' + channelName);
                    // Create local audio and video tracks
                    rtc.localVideoTrack = AgoraRTC.createCameraVideoTrack();
                    rtc.localAudioTrack = AgoraRTC.createMicrophoneAudioTrack();

                    // Publish the local tracks to the channel
                    rtc.client.publish([rtc.localAudioTrack, rtc.localVideoTrack]);

                    // Play the local video track
                    rtc.localVideoTrack.play('local_stream');
                });

                // Listen for remote users joining
                rtc.client.on('user-published', async (user, mediaType) => {
                    await rtc.client.subscribe(user, mediaType);
                    console.log('User subscribed:', user);
                    if (mediaType === 'video') {
                        const remoteVideoTrack = user.videoTrack;
                        rtc.remoteUsers.push(user);
                        remoteVideoTrack.play('remote_stream');
                    }
                });

                // Listen for remote users leaving
                rtc.client.on('user-unpublished', user => {
                        console.log('User unpublished:',);
                            // Find and remove the user from remoteUsers array
                            const index = rtc.remoteUsers.findIndex(u => u.uid === user.uid);
                            if (index !== -1) {
                                rtc.remoteUsers.splice(index, 1);
                            }
                        });

                    // Listen for the call ending
                    rtc.client.on('user-left', user => {
                        console.log('User left:', user);
                        // Find and remove the user from remoteUsers array
                        const index = rtc.remoteUsers.findIndex(u => u.uid === user.uid);
                        if (index !== -1) {
                            rtc.remoteUsers.splice(index, 1);
                        }
                    });

                }
                catch (error) {
                    console.error('Failed to initialize AgoraRTC:', error);
                }
            } 
            // catch (error) {
            //     console.error('Failed to join channel:', error);
            // }
        

        function endCall() {
            rtc.client.leave(() => {
                // Clear local and remote tracks
                rtc.localAudioTrack.close();
                rtc.localVideoTrack.close();
                rtc.remoteUsers.forEach(user => {
                    const remoteVideoTrack = user.videoTrack;
                    remoteVideoTrack.close();
                });
                // Stop all local and remote tracks
                rtc.client.removeAllListeners();
                // Clear the remoteUsers array
                rtc.remoteUsers = [];
                // Clear the user ID from local storage
                localStorage.removeItem('user_id');
                console.log('Left channel successfully');
            });
        }

        // Start the call when the page loads
        window.onload = () => {
            const channelName = prompt('Enter channel name:');
            startCall(channelName);
        };
    </script>
</body>

</html>
