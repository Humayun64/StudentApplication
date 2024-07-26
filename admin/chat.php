<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $messageText = trim($_POST['message']);
    if ($messageText !== '') {
        // Add the new message to the session
        $_SESSION['messages'][] = ['type' => 'sender', 'text' => htmlspecialchars($messageText)];
        // Reload the page to display the new message
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">Welcome to Our Live Chat</h2>
        <div class="chat-container">
            <div class="messages" id="messages">
                <?php
                    if (!isset($_SESSION['messages'])) {
                        $_SESSION['messages'] = [
                            ['type' => 'sender', 'text' => 'Hello, how are you?'],
                            ['type' => 'replyer', 'text' => 'I am good, thank you!'],
                            ['type' => 'sender', 'text' => 'Great to hear that.'],
                        ];
                    }

                    // Display messages from the session
                    foreach ($_SESSION['messages'] as $message) {
                        $class = $message['type'] == 'sender' ? 'message sender' : 'message replyer';
                        echo "<div class='$class'>{$message['text']}</div>";
                    }
                ?>
            </div>
            <form class="input-container" method="POST" action="">
                <input type="text" name="message" id="messageInput" class="form-control" placeholder="Type a message">
                <button type="submit" name="send" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
