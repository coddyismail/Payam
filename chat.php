<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room</title>
    <link rel="stylesheet" href="ct.css">
   
    <script>
        let ws;

        function connectWebSocket() {
            ws = new WebSocket("ws://localhost:8080");

            ws.onopen = function() {
                console.log("✅ Connected to WebSocket server.");
            };

            ws.onmessage = function(event) {
                displayMessage(event.data);
            };

            ws.onclose = function() {
                console.log("❌ Disconnected from WebSocket server. Reconnecting...");
                setTimeout(connectWebSocket, 3000); // Auto-reconnect after 3 seconds
            };

            ws.onerror = function(error) {
                console.error("⚠️ WebSocket Error:", error);
            };
        }

        function sendMessage() {
    let message = document.getElementById("message").value.trim();
    if (message !== "") {
        let formattedMessage = "<?php echo $_SESSION['username']; ?>: " + message;

        if (ws.readyState === WebSocket.OPEN) {
            ws.send(formattedMessage);
            displayMessage(formattedMessage);
        } else if (ws.readyState === WebSocket.CONNECTING) {
            console.warn("⚠️ WebSocket is still connecting. Please wait...");
        } else {
            console.warn("⚠️ WebSocket not open. Attempting to reconnect...");
            connectWebSocket();  // Try reconnecting
            setTimeout(() => {
                if (ws.readyState === WebSocket.OPEN) {
                    ws.send(formattedMessage);
                    displayMessage(formattedMessage);
                } else {
                    console.error("🚫 Failed to reconnect. Message not sent.");
                }
            }, 1000); // Delay retry for 1 second
        }

        document.getElementById("message").value = "";
    }
}


        function displayMessage(text) {
            let chatBox = document.getElementById("chat-box");

            // Create a new paragraph element safely
            let messageElement = document.createElement("p");
            messageElement.textContent = text; 

            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll
        }

        window.onload = connectWebSocket;
    </script>
</head>
<body>
<div class="chat-container">
        <div class="chat-header">
            Welcome, <?php echo $_SESSION['username']; ?>!
        </div>
        
        <div id="chat-box"></div>

        <div class="chat-input">
            <input type="text" id="message" placeholder="Type a message..." onkeypress="if(event.keyCode === 13) sendMessage();">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <div class="logout">
        <a href="home.php" style="background-color: #191919;">Logout</a>
        <!-- <span class="tooltip-text">Created using अजगर (.Py)</span> -->
    </div>
</body>
</html>
