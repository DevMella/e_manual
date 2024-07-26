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

    $pick = "SELECT * FROM `manuals`";
    $content = mysqli_query($conn, $pick);

    $last = "SELECT * FROM `manuals`";
    $latest = mysqli_query($conn, $last);
    
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
    <link rel="stylesheet" href="books.css">
    <style>
        .tee{
            width: 66%;
            padding-left: 5px;
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
        .mus img{
            border-radius: 10px;
        }
        @media (max-width:764px) {
            .main-body{
                width: 100%;
                margin-left: 0px !important;
                padding:  0px 20px 30px 20px !important;
                margin-bottom: 60px;
            }
            .ori{
                flex-direction: column;
            }
            .tee,.tat{
                width: 100%;
            }
            .lat img{
                width: 100%;
                height: 330px;
            }
            .tat{
                padding: 0px 0px 20px 0px;
            }
            .top{
                width: 100%;
                padding: 20px 34px 15px 0px;
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
                        <h5>Uplaoded Manuals</h5>
                        <div class="row">
                            <?php while ($picked = mysqli_fetch_assoc( $content)): ?>
                                <div class="col col-lg-4">
                                    <div class="son mb-4">
                                        <div style="width: 100%; height:250px;">
                                            <img width="100%" style="height:250px;object-fit:cover;" src="<?php echo htmlspecialchars($picked['manual_image']); ?>" alt="Book Image">
                                        </div>
                                        <h6><?php echo htmlspecialchars($picked['course_name']); ?></h6>
                                        <div class="d-flex justify-content-between">
                                            <h6><?php echo htmlspecialchars($picked['amount']); ?></h6>
                                            <h6><?php echo htmlspecialchars($picked['course_units']); ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="tat">
                        <div class="d-lg-block d-none">
                            <h6 >Profile</h6>
                            <div class="mus d-flex  justify-content-between align-items-center">
                                <div>
                                    <p class="bad"><?php echo $signin['name']?></p>
                                    <p class="bad">Department:<?php echo $signin['department']?></p>
                                </div>
                                <img src="https://i.pinimg.com/564x/97/bb/06/97bb067e30ff6b89f4fbb7b9141025ca.jpg" alt=""> 
                            </div>
                        </div>
                        <div class="rec mt-5">
                            <h5 class="mb-3">Recently uploaded manual</h5>
                            <?php while($row = mysqli_fetch_assoc($latest)): ?>
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
        const currentPageId = "available-books";
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
