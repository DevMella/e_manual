<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit(); 
}

include "connect.php";
$matric = $_SESSION['matric'];
$select = "SELECT * FROM `manual` WHERE `matric` = '$matric'";
$signin_details = mysqli_query($conn, $select);
$signin = mysqli_fetch_assoc($signin_details);

if (isset($_GET['image']) && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['code']) && isset($_GET['pdf'])) {
    $image = $_GET['image'];
    $name = $_GET['name'];
    $price = $_GET['price'];
    $code = $_GET['code'];
    $filename = $_GET['pdf'];
} else {
    header("Location: books.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e_manual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/93483d eb2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <link rel="stylesheet" href="payment.css">
    <style>
        .mop span{
            font-size: 20px;
        }
        .but{
            width: 100%;
            height: 40px;
            border-radius: 20px;
            background-color: #54baac;
            color: white;
            border: none;
            outline: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
         @keyframes float {
            0%, 100% {
            transform: translate(80px, 50px);
        }
        50% {
            transform: translate(50px, 50px);
        }
        }
        #downloadButton{
            text-decoration: none;
            width: 100%;
            padding: 5px 8px 8px 8px;
            border-radius: 20px;
            background-color: #54baac;
            color: white;
        }
        .button__text{
            margin-left: 60px;
        }
        .button__icon{
            margin-left: 29px;
            animation: float 3s infinite;
        }
        .odo input,.odo select{
            background-color: #f5f5f5;
            border-radius: 10px;
            width: 100%;
            border: none;
            height: 70px;
            outline: none;
            padding: 30px 10px 10px 60px;
            color: gray;
        }
        .odo select{
            padding: 10px 10px 10px 54px; 
        }
        .top{
            align-items: center;
        }
        @media (max-width:764px) {
            .main-body{
                width: 100%;
                margin-left: 0px !important;
                padding:  0px 10px 30px 10px !important;
                margin-bottom: 60px;
            }
            .top{
                width: 100%;
                padding: 20px 24px 15px 0px;
            }
            .icons a{
                text-decoration: none;
            }
            .icons{
                padding: 13px 14px 0px 14px;
            }
            #downloadButton{
            text-decoration: none;
            width: 100%;
            padding: 5px 8px 8px 5px;
            border-radius: 20px;
            background-color: #54baac;
            color: white;
        }
        .button__text{
            margin-left: 40px;
        }
        .button__icon{
            margin-left: 29px;
            animation: float 3s infinite;
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
                <a href="dashboard.php">
                    <div class="icon d-flex gap-2 mb-3" id="dashboard">
                        <i class="bi bi-house-add"></i>
                        <p>Dashboard</p>
                    </div>
                </a>
                <a href="books.php">
                    <div class="icon d-flex gap-2 mb-3" id="available-books">
                        <i class="bi bi-book"></i>
                        <p>Available Manuals</p>
                    </div>
                </a>
                <a href="transaction.php">
                    <div class="icon d-flex gap-2 mb-3" id="transaction">
                        <i class="bi bi-cash-coin"></i>
                        <p>Payment</p>
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
                        <h6 class="mop">Hi, <span><?php echo $signin['name']?></span></h6>
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
                            <a href="dashboard.php" class="d-flex flex-column align-items-center">
                                <i class="bi bi-house-add-fill text-center fs-4"></i>
                                <p>Home</p>
                            </a>
                        </div>
                        <div>
                            <a href="transaction.php" class="d-flex flex-column align-items-center">
                                <i class="bi bi-cash-coin fs-4"></i>
                                <p>Payment</p>
                            </a>
                        </div>
                        <div>
                            <a href="books.php" class="d-flex flex-column align-items-center">
                                <i class="bi bi-cash-coin fs-4"></i>
                                <p>Books</p>
                            </a>
                        </div>
                        <div>
                            <a href="profile.php" class="d-flex flex-column align-items-center">
                                <i class="bi bi-person fs-4"></i>
                                <p>Me</p>
                            </a>
                        </div>
                    <div>
                        <a href="logout.php" class="d-flex flex-column align-items-center">
                            <i class="bi bi-box-arrow-right fs-4"></i>
                            <p>Chat</p>
                        </a>
                    </div>
                </div>
                    <div class="mine row">
                        <div class="col col-lg-6">
                            <h5>Payment Summary </h5>
                            <form id="paymentForm" class="mt-2">
                                <div class="odo">
                                    <div class="input-box">
                                        <span class="icon"><i class="bi bi-envelope"></i></span>
                                        <input type="email" id="email" required>
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="input-box mt-3">
                                        <span class="icon"><i class="bi bi-cash"></i></span>
                                        <input type="number" id="amount" value="<?php echo htmlspecialchars($price); ?>" required>
                                        <label for="amount">Amount</label>
                                    </div>
                                    <div class="input-box mt-3">
                                        <span class="icon"><i class="bi bi-book"></i></span>
                                        <select id="manual" name="manual" required>
                                            <option value="<?php echo htmlspecialchars($name); ?>"><?php echo htmlspecialchars($name); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="boom mt-5">
                                <div class="d-flex gap-2">
                                    <div class="d-flex ken gap-1">
                                        <i class="bi bi-check-circle-fill" style="color: #54baac;"></i>
                                        <p style="font-weight: 600;">Choice</p>
                                    </div>
                                    |
                                    <p style="font-weight: 600;"><?php echo $signin['department']?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="pay">
                                        <img src="lecturer/<?php echo htmlspecialchars($image); ?>" alt="Book Image" style="max-width: 200px;">
                                    </div>
                                    <div>
                                        <p><?php echo htmlspecialchars($name); ?></p>
                                        <p style="margin-top: -10px;"><?php echo htmlspecialchars($code); ?></p>
                                        <h5><?php echo htmlspecialchars($price); ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-6">
                            <div class="omo">
                                <h5>Summary</h5>
                                <div class="d-flex justify-content-between">
                                    <p>Subtotal</p>
                                    <p><?php echo htmlspecialchars($price); ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Promo Code</p>
                                    <p>None</p>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h6>Total</h6>
                                    <h5><?php echo htmlspecialchars($price); ?></h5>
                                </div>
                                <div class="ano">
                                    <p class="text-center mt-3">Upon clicking 'make payment' I confirm I have read and acknowledged the payment summary.</p>
                                </div>
                                <form action="" class="d-flex gap-3 " id="paymentForm">
                                    <button type="button" class="but mt-3" onclick="payWithPaystack()">Make Payment</button>
                                    <a id="downloadButton" class="mt-3" style="display: none;" href="lecturer/<?php echo htmlspecialchars($filename); ?>" download>
                                        <span class="button__text">Download</span>
                                        <span class="button__icon"><i class="bi bi-download"></i></span>
                                     </a>
                                </form>
                            </div>
                            <div class="jabo mt-3">
                                <div class="loga">
                                    <h4>&ecaron;coursie</h4>
                                </div>
                                <p>&ecaron;_manual keeps your information and payment safe</p>
                                <div class="min d-flex" style="width: 120px;">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShqlEP0qWHv6nFrvoiGj1SSyyVuKhVr1-VwA&s" alt="">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMhgbuS6DxtOUbw46YXj1tsgjcyoH3TAKsRA&s" alt="">
                                    <img src="./logo-no-background.png" width="100%" class="mx-3" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="success-message mt-3">
                        <div class="alert" style="display:none;" role="alert">
                            Payment successful! Click the button below to download your manual.
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const currentPageId = "transaction";
        document.getElementById(currentPageId).classList.add("active");
        const icaElements = document.querySelectorAll(".ica");
        let expandedElement = null;
        function getFormattedDate() {
            const months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            const days = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ];

            const now = new Date();
            const dayOfWeek = days[now.getDay()];
            const month = months[now.getMonth()];
            const dayOfMonth = now.getDate();
            const year = now.getFullYear();

            return `${dayOfWeek}, ${month} ${dayOfMonth}, ${year}`;
            }

            document.getElementById("currentDate").textContent = getFormattedDate();

            const calendarElement = document.getElementById("calendar");
            const monthYearElement = document.getElementById("month-year");
            const prevButton = document.getElementById("prev");
            const nextButton = document.getElementById("next");

            let today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();

            const monthNames = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
            ];

            function updateCalendar() {
            calendarElement.innerHTML = "";
            monthYearElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement("div");
                dayElement.classList.add("day");
                if (
                day === today.getDate() &&
                currentMonth === today.getMonth() &&
                currentYear === today.getFullYear()
                ) {
                dayElement.classList.add("today");
                }
                dayElement.textContent = day;
                calendarElement.appendChild(dayElement);
            }
            }

            prevButton.addEventListener("click", () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            updateCalendar();
            });

            nextButton.addEventListener("click", () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            updateCalendar();
            });

            updateCalendar();

    </script>

    <script>
        function payWithPaystack() {
            var email = document.getElementById('email').value;
            var amount = document.getElementById('amount').value;
            var successMessage = document.querySelector('.success-message');
            var downloadButton = document.getElementById('downloadButton');

            if (email && amount) {
                successMessage.style.display = 'block';

                setTimeout(function() {
                    successMessage.style.display = 'none';  
                    downloadButton.style.display = 'block'; 
                }, 20000); 

                var handler = PaystackPop.setup({
                    key: 'pk_test_49b64a8597a6acb79338ddb6b580bdf2c2d2200e',
                    email: email,
                    amount: amount * 100, 
                    currency: 'NGN',
                    ref: 'PSK-' + Math.floor((Math.random() * 1000000000) + 1),
                    metadata: {
                        custom_fields: [
                            {
                                display_name: "Manual",
                                variable_name: "manual",
                                value: document.getElementById('manual').value
                            }
                        ]
                    },
                });
                handler.openIframe();
            }
        }
    </script>
</body>
</html>

