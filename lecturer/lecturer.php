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
    $errorMsg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lecturer_name = $_POST['lecturer_name'];
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];
        $amount = $_POST['amount'];
        $course_units = $_POST['course_units'];
        
        $manual_pdf = $_FILES['manual_pdf'];
        $manual_image = $_FILES['manual_image'];
    
        $pdf_target_dir = "uploads/manuals/";
        $image_target_dir = "uploads/images/";
        
        $pdf_target_file = $pdf_target_dir . basename($manual_pdf['name']);
        $image_target_file = $image_target_dir . basename($manual_image['name']);
    
        if (move_uploaded_file($manual_pdf['tmp_name'], $pdf_target_file) && move_uploaded_file($manual_image['tmp_name'], $image_target_file)) {
            $sql = "INSERT INTO manuals (lecturer_name, course_name, course_code, amount, course_units, manual_pdf, manual_image) 
                    VALUES ('$lecturer_name', '$course_name', '$course_code', '$amount', '$course_units', '$pdf_target_file', '$image_target_file')";
            
            if (mysqli_query($conn, $sql)) {
                $errorMsg = '<p style="color: #54baac; margin-top:10px;">Manual uploaded sucessfully.</p>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $errorMsg = '<h6 style="color: red; margin-top:10px;">Sorry, there was an error uploading your files..</h6>';
        }
    }
    $pick = "SELECT * FROM `manuals`";
    $content = mysqli_query($conn, $pick);
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
    <link rel="stylesheet" href="lecturer.css ">
    <style>
        .check{
            box-shadow: #63636333 0px 1px 4px 0px;
            width: 100%;
            border-radius: 10px;
            padding: 10px 25px 15px 25px;
        }
        .mop span{
            font-size: 19px;
        }
        .mus img{
            border-radius: 10px;
        }
        .ori{
            width: 100%;
            display: flex;
            padding-top: 70px;
            gap: 30px;
        }
        .top{
            align-items: center;
        }
        .icons{
            width: 100%;
            background-color: #54baac;
        }
        .icons a{
            color: white;
            text-decoration: none;
        }
        .tat{
            width: 34%;
            padding: 0px 0px 20px 20px;
        }
        @media (max-width:764px) {
        .main-body{
            width: 100%;
            margin-left: 0px !important;
            padding:  0px 10px 30px 10px !important;
        }
        .top{
            width: 100%;
        }
        .ori{
            flex-direction: column;
        }
        .top{
            width: 100%;
            padding: 20px 30px 15px 3px;
        }
        .icons{
            padding: 13px 14px 0px 14px;
        }
        .tee,.tat{
            width: 100%;
        }
        .bii{
            font-size: 20px;
        }
        .check{
            box-shadow: #63636333 0px 1px 4px 0px;
            width: 100%;
            border-radius: 10px;
            padding: 10px 15px 15px 15px;
        }
        .lat img{
            width: 100%;
            height: 330px;
        }
        .tat{
            padding: 0px 10px 20px 10px;
        }
        .rec{
            margin-top: 0px !important;
            margin-bottom: 60px;
        }
        .cal i{
            margin-top: 10px;
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
                    <h6 class="mop">Hi,<span><?php echo $signin['name']?></span></h6>
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
                <div class="ori mt-3">
                    <div class="tee">
                        <h5>Upload Manuals</h5>
                        <div class="check mt-4">
                            <div class="cal" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <i class="bi bi-bookmark-plus-fill" style="font-size: 120px; margin-top:20px;"></i>
                                <form  method="post" enctype="multipart/form-data">
                                    <input type="file" name="manual_pdf" accept="application/pdf" required>
                                    <input type="text" name="lecturer_name" placeholder="Lecturer's Name">
                                    <input type="text" name="course_name" placeholder="Course Name">
                                    <input type="text" name="course_code" placeholder="Course Code">
                                    <input type="number" name="amount" placeholder="Amount">
                                    <input type="text" name="course_units" placeholder="Course Units">
                                    <input type="file" placeholder="manual" name="manual_image" accept="image/*" required>
                                    <button class="button" type="submit" name="submit">
                                        Upload Manual
                                        <svg id="UploadToCloud" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="16px" width="16px" class="icon">
                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                        <path class="color000000 svgShape" fill="white"
                                            d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l4.65-4.65c.2-.2.51-.2.71 0L17 13h-3z"></path>
                                        </svg>
                                    </button>
                                </form>

                                <?php echo $errorMsg; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tat">
                        <div class="d-lg-block d-none">
                            <h6 >Profile</h6>
                            <div class="mus d-flex  justify-content-between align-items-center">
                                <div>
                                    <p class="bas"><?php echo $signin['name']?></p>
                                    <p class="bad">Department:<?php echo $signin['department']?></p>
                                </div>
                                <img src="https://i.pinimg.com/564x/97/bb/06/97bb067e30ff6b89f4fbb7b9141025ca.jpg" alt=""> 
                            </div>
                        </div>
                        <div class="rec mt-5">
                            <h5 class="mb-3">Recently uploaded manual</h5>
                            <?php while($row = mysqli_fetch_assoc($content)): ?>
                                <?php
                                $json_data = json_encode([
                                    "amount" => "₦" . $row['amount'],
                                    "department" => "Science",
                                    "datetime" => "2024-07-18 12:34:56"
                                ]);
                                ?>
                                <div class="ica mb-3" data-details='<?php echo htmlspecialchars($json_data, ENT_QUOTES, 'UTF-8'); ?>'>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div><i class="bi bi-book-half fs-3"></i></div>
                                            <div class="free">
                                                <p><?php echo htmlspecialchars($row['course_code'], ENT_QUOTES, 'UTF-8'); ?></p>
                                                <h5><?php echo htmlspecialchars($row['course_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                            </div>
                                        </div>
                                        <i class="bi bi-caret-left-fill arrow"></i>
                                    </div>
                                </div>
                                <?php
                                error_log("JSON data: " . $json_data);
                                ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const currentPageId = "lecturer";
        document.getElementById(currentPageId).classList.add("active");
        document.addEventListener("DOMContentLoaded", function() {
        const icaElements = document.querySelectorAll(".ica");
        let expandedElement = null;

        icaElements.forEach((ica) => {
            const arrow = ica.querySelector(".arrow");
            arrow.addEventListener("click", function (event) {
                event.stopPropagation();

                if (expandedElement && expandedElement !== ica) {
                    expandedElement.classList.remove("expanded");
                    const detailsToRemove = expandedElement.querySelector(".details");
                    if (detailsToRemove) detailsToRemove.remove();
                }

                if (expandedElement === ica) {
                    expandedElement.classList.remove("expanded");
                    const detailsToRemove = expandedElement.querySelector(".details");
                    if (detailsToRemove) detailsToRemove.remove();
                    expandedElement = null;
                } else {
                    try {
                        const details = JSON.parse(ica.getAttribute("data-details"));
                        const detailsDiv = document.createElement("div");
                        detailsDiv.classList.add("details");
                        detailsDiv.innerHTML = `
                            <p>Amount: ${details.amount}</p>
                            <p>Department: ${details.department}</p>
                            <p>Purchased on: ${details.datetime}</p>
                        `;
                        ica.appendChild(detailsDiv);
                        setTimeout(() => {
                            ica.classList.add("expanded");
                        }, 10);
                        expandedElement = ica;
                    } catch (error) {
                        console.error("Failed to parse JSON:", error);
                    }
                }
            });
        });
    });
</script>


    <script src="main.js"></script>
</body>
</html>
