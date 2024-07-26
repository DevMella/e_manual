<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit(); 
    }
    
    include "connect.php";
    $email = $_SESSION['email'];
    $select = "SELECT * FROM `lecturer` WHERE `email` = '$email'";
    $signin_details = mysqli_query($conn, $select);
    $signin = mysqli_fetch_assoc($signin_details);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e_manual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/93483deb2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="chat.css">
    <style>
        .tee{
            width: 66%;
            padding-left: 5px;
        }
        .ori{
            width: 100%;
            display: flex;
            padding-top: 70px;
            gap: 20px;
        }
        .tat{
            width: 35%;
            padding: 0px 20px 20px 20px;
        }
        .icon-picker-container {
            display: none;
            position: absolute;
            bottom: 60px;
            left: 10px;
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            z-index: 1;
        }
        .icon-picker-container i {
            font-size: 24px;
            margin: 5px;
            cursor: pointer;
        }
        @media (max-width:764px) {
        .main-body{
            width: 100%;
            margin-left: 0px !important;
            padding:  0px 12px 30px 12px !important;
        }
        .top{
            width: 100%;
        }
        .top{
            width: 100%;
            padding: 20px 30px 15px 3px;
        } 
        .icons a{
                text-decoration: none;
            }
            .icons{
                padding: 13px 14px 0px 14px;
            }
            .bii{
                font-size: 20px;
            }
    }
    </style>
</head>
<body>
    <div class="all">
        <div class="body">
            <div class="side d-lg-block d-none">
                <div class="logo">
                    <h4>&ecaron;_manual</h4>
                </div>
                <a href="lecturer.php">
                    <div class="icon d-flex gap-2 mb-3" id="lecturer">
                        <i class="bi bi-house-add"></i>
                        <p>Dashboard</p>
                    </div>
                </a>
                <a href="acess.php">
                    <div class="icon d-flex gap-2 mb-3" id="all-courses">
                        <i class="bi bi-database "></i>
                        <p>Payment History</p>
                    </div>
                </a>
                <a href="books.php">
                    <div class="icon d-flex gap-2 mb-3" id="available-books">
                        <i class="bi bi-book"></i>
                        <p>Uploaded Manuals</p>
                    </div>
                </a>
                <a href="chat.php">
                    <div class="icon d-flex gap-2 mb-3" id="chat">
                        <i class="bi bi-chat-dots"></i>
                        <p>Chat</p>
                    </div>
                </a>
                <a href="profile.php">
                    <div class="icon d-flex gap-2 mb-3 bab" id="profile">
                        <i class="bi bi-person-add"></i>
                        <p>Profile</p>
                    </div>
                </a>
                <a href="logout.php">
                    <div class="icon d-flex gap-2 mb-3" id="logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </div>
                </a>
            </div>
            <div class="main-body">
                <div class="top">
                    <h6 class="mop">Hi, <?php echo $signin['name'] ?></h6>
                    <div class="d-flex gap-3 gbo">
                        <p id="currentDate" class="mt-2"></p>
                        <div class="d-lg-block d-none">
                            <form action="" class="d-flex">
                                <input type="text" placeholder="Search books">
                                <i class="bi bi-search"></i>
                            </form>
                        </div>
                        <div class="cir"><i class="bi bi-bell"></i></div>
                    </div>
                </div>
                <div class="icons d-flex justify-content-between  fixed-bottom w-100 d-lg-none d-md-none d-block gap-2">
                    <div>
                        <a href="lecturer.php" class="d-flex flex-column align-items-center">
                            <i class="bi bi-house-add-fill text-center fs-4"></i>
                            <p>Home</p>
                        </a>
                    </div>
                    <div>
                        <a href="books.php" class="d-flex flex-column align-items-center">
                            <i class="bi bi-cash-coin fs-4"></i>
                            <p>Books</p>
                        </a>
                    </div>
                    <div>
                        <a href="acess.php" class="d-flex flex-column align-items-center">
                             <i class="bi bi-database bii"></i>
                            <p>History</p>
                        </a>
                    </div>
                    <div>
                        <a href="profile.php" class="d-flex flex-column align-items-center">
                            <i class="bi bi-person fs-4"></i>
                            <p>Me</p>
                        </a>
                    </div>
                    <div>
                        <a href="chat.php" class="d-flex flex-column align-items-center">
                            <i class="bi bi-box-arrow-right fs-4"></i>
                            <p>Chat</p>
                        </a>
                    </div>
                </div>
                <div class="chat">
                    <div class="chat-container">
                        <div class="messages" id="messages"></div>
                        <div style="display: flex; margin: 20px 50px 0px 0px; position: relative;">
                            <button id="iconButton" style="display: flex; align-items: center; justify-content: center;"><i class="bi bi-emoji-smile"></i></button>
                            <input type="text" id="messageInput" placeholder="Type your message...">
                            <button id="sendButton" style="display: flex; align-items: center; justify-content: center;"><i class="bi bi-send"></i></button>
                            <div class="icon-picker-container" id="iconPickerContainer">
                                <i class="bi bi-emoji-smile" data-emoji="😊"></i>
                                <i class="bi bi-emoji-heart-eyes" data-emoji="😍"></i>
                                <i class="bi bi-emoji-laughing" data-emoji="😂"></i>
                                <i class="bi bi-emoji-angry" data-emoji="😠"></i>
                                <i class="bi bi-emoji-sunglasses" data-emoji="😎"></i>
                                <i class="bi bi-heart-fill" data-emoji="❤"></i>
                                <i class="bi bi-arrow-through-heart-fill" data-emoji="💕"></i>
                                <i class="bi bi-hand-thumbs-up-fill" data-emoji="👍"></i>
                                <i class="bi bi-gift" data-emoji="🎁"></i> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const currentPageId = "chat";
        document.getElementById(currentPageId).classList.add("active");
        const icaElements = document.querySelectorAll(".ica");
        let expandedElement = null;
    
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const messagesContainer = document.getElementById('messages');
        const iconButton = document.getElementById('iconButton');
        const iconPickerContainer = document.getElementById('iconPickerContainer');
    
        function addMessage(content, type, isHtml = false) {
            const messageElement = document.createElement('div');
            const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }); 
            let messageContent = `<div style="display:flex; gap:5px">
                <span class="message-content" style="font-size:18px;">${content}</span><span class="message-time mt-3" >${timestamp}</span>
                </div>`;
            
            if (isHtml) {
                messageElement.innerHTML = messageContent;
            } else {
                messageElement.innerHTML = messageContent;
            }
            
            messageElement.classList.add('message', type);
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    
        sendButton.addEventListener('click', () => {
            const message = messageInput.value.trim();
            if (message) {
                addMessage(message, 'sent');
                messageInput.value = '';
            }
        });
    
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const message = messageInput.value.trim();
                if (message) {
                    addMessage(message, 'sent');
                    messageInput.value = '';
                }
            }
        });
    
        iconButton.addEventListener('click', () => {
            iconPickerContainer.style.display = iconPickerContainer.style.display === 'none' ? 'block' : 'none';
        });
    
        iconPickerContainer.addEventListener('click', (e) => {
            if (e.target.tagName === 'I') {
                const emoji = e.target.getAttribute('data-emoji');
                messageInput.value += emoji;
                iconPickerContainer.style.display = 'none';
            }
        });
    
        setTimeout(() => {
            addMessage('Thank you for contacting ě_manual! Please let us know how we can help you.', 'received');
        }, 10000);
    </script>
</body>
</html>
