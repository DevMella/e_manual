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

    if(isset($_POST['update_profile'])){
        $name = $_POST['name'];
        $level = $_POST['level'];
        $department = $_POST['department'];
        $faculty = $_POST['faculty'];

        $update = mysqli_query($conn,"UPDATE `manual` SET `name`='$name',`level`='$level', `department`='$department', `faculty`='$faculty' WHERE `matric` = '$matric'");
        
        if($update){
            header("location:profile.php");
        }else{
            echo "Error updating profile.";
        }
    }

    
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
    <link rel="stylesheet" href="profile.css">
    <style>
        .tee{
            width: 66%;
            padding-left: 5px;
        }
        .kin a{
            text-decoration: none;
            color: black;
        }
        .kin a:hover{
            width: 300px;
            height: 40px;
            background-color: #54baac;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px 1px 10px 1px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .main-body{
            width: 81%;
            margin-left: 273px !important;
            padding:  0px 0px 0px 0px !important;
        }
        .kin{
            box-shadow: #63636333 0px 1px 4px 0px;
            width: 100%;
            border-radius: 3px;
            padding: 50px 20px 50px 20px;
            display: flex;
            align-items: center;
            flex-direction: column;
            transform: translateY(-18%);
            background: white;
        }
        .kan{
            box-shadow: #63636333 0px 1px 4px 0px;
            width: 100%;
            border-radius: 3px;
            padding: 30px 15px 35px 15px;
            display: flex;
            flex-direction: column;
            transform: translateY(-19%);
            background: white;
        }
        .mop span{
            font-size: 20px;
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
        .but{
            width: 100px;
            height: 40px;
            background-color: #54baac;
            color: white;
            border: none;
            margin-top: 20px;
            border-radius: 10px;
        }
        @media (max-width:764px) {
            .main-body{
                width: 100%;
                margin-left: 0px !important;
                padding:  0px 0px 30px 0px !important;
                margin-bottom: 60px;
            }
            .top{
                width: 100%;
                padding: 20px 20px 15px 15px;
            }
            .icons a{
                text-decoration: none;
            }
            .icons{
                padding: 13px 14px 0px 14px;
            }
            .con{
                padding: 20px !important;
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
                <div class="owo">
                    <div class="wan"></div>
                    <div class="con row px-4">
                        <div class="col col-lg-4">
                            <div class="kin">
                                <div class="cou">
                                    <img width="100%" style="border-radius: 50%; height: 120px; object-fit: cover;" src="https://i.pinimg.com/564x/5b/37/80/5b37801cdf77566b0c65b3812fab38b9.jpg" alt="">
                                </div>
                                <div class="paa" style="width: 30px; height: 30px; background-color: #54baac; color: white; display: flex; justify-content: center; align-items: center; border-radius: 50%;"><i class="bi bi-card-image"></i></div>
                                <h6 class="mt-3"><?php echo $signin['name']?></h6>
                                <div class="tab" id="profile-tab">
                                    <h6 class="mt-3">Profile</h6>
                                </div>
                                <div class=" tab" id="password-tab">
                                    <h6>Password</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-8 mt-4">
                            <div class="kan" id="profile-content">
                                <h6>Profile</h6>
                                <div class="line"></div>
                                <?php echo $signin['password']?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col col-lg-6 col-12">
                                            <label for="" class="mt-3">Full Name</label> <br>
                                            <input type="text" value="<?php echo $signin['name']?>" name="name" id="">
                                        </div>
                                        <div class="col col-lg-6 col-12">
                                            <label for="" class="mt-3">Matric Number</label> <br>
                                            <input type="text" value="<?php echo $signin['matric']?>" name="matric" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col col-lg-6 col-12">
                                            <label for="" class="mt-3">Level</label> <br>
                                            <input type="text" value="<?php echo $signin['level']?>" name="level" id="">
                                        </div>
                                        <div class="col col-lg-6 col-12">
                                            <label for="" class="mt-3">Email</label> <br>
                                            <input type="email" value="<?php echo $signin['email']?>" name="email" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col col-lg-6 col-12">
                                            <label for="" class="mt-3">Department</label> <br>
                                            <input type="text" value="<?php echo $signin['department']?>" name="department" id="">
                                        </div>
                                        <div class="col col-lg-6 col-12">
                                            <label for="" class="mt-3">Faculty</label> <br>
                                            <input type="text" value="<?php echo $signin['faculty']?>" name="faculty" id="">
                                        </div>
                                    </div>
                                    <button class="but" type="submit" name="update_profile">update</button>
                                </form>

                            </div>
                            <div class="kan" id="password-content" style="display: none;">
                                <h6>Password</h6>
                                <div class="lane"></div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col col-lg-12 col-12 mt-3">
                                            <label for="">Old Password</label> <br>
                                            <input type="password" value="<?php echo $signin['password']?>"  id="">
                                            <i class="bi bi-eye-slash toggle-password" id="toggleConfirmPassword" style="position: absolute; right: 30px; top: 112px; cursor: pointer;"></i>
                                        </div>
                                        <div class="col col-lg-12 col-12 mt-3">
                                            <label for="">New Password</label> <br>
                                            <input type="password" name="new_password" id="">
                                            <i class="bi bi-eye-slash toggle-password" id="toggleConfirmPassword" style="position: absolute; right: 30px; top: 200px; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col col-lg-12">
                                            <label for="">Confirm New Password</label> <br>
                                            <input type="password" name="confirm_password" id="">
                                            <i class="bi bi-eye-slash toggle-password" id="toggleConfirmPassword" style="position: absolute; right: 30px; top: 285px; cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    <button class="but" type="submit" name="update_password">Update</button>
                                </form>
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
        const currentPageId = "profile";
        document.getElementById(currentPageId).classList.add("active");
        const icaElements = document.querySelectorAll(".ica");
        let expandedElement = null;
        document.addEventListener("DOMContentLoaded", function() {
            const profileTab = document.getElementById('profile-tab');
            const passwordTab = document.getElementById('password-tab');
            const profileContent = document.getElementById('profile-content');
            const passwordContent = document.getElementById('password-content');

            profileContent.style.display = 'block';
            passwordContent.style.display = 'none';
            profileTab.classList.add('active-tab');
            passwordTab.classList.remove('active-tab');
        });

        document.getElementById('profile-tab').addEventListener('click', function() {
            document.getElementById('profile-content').style.display = 'block';
            document.getElementById('password-content').style.display = 'none';
            document.getElementById('profile-tab').classList.add('active-tab');
            document.getElementById('password-tab').classList.remove('active-tab');
        });

        document.getElementById('password-tab').addEventListener('click', function() {
            document.getElementById('profile-content').style.display = 'none';
            document.getElementById('password-content').style.display = 'block';
            document.getElementById('profile-tab').classList.remove('active-tab');
            document.getElementById('password-tab').classList.add('active-tab');
        });

        document.addEventListener('DOMContentLoaded', function() {
        var toggleIcons = document.querySelectorAll('.toggle-password');

        toggleIcons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                var input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('bi-eye-slash');
                    this.classList.add('bi-eye');
                } else {
                    input.type = 'password';
                    this.classList.remove('bi-eye');
                    this.classList.add('bi-eye-slash');
                }
            });
        });
    });
    </script>
    <script>
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
</body>
</html>
