<?php
session_start();
include "connect.php";  

$errorMsg = ""; 

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email']; 
    $matric = $_POST['matric']; 
    $password = $_POST['password'];
    $faculty = $_POST['faculty']; 
    $level = $_POST['level']; 
    $department = $_POST['department']; 

    $_SESSION["form_data"] = $_POST;
    
    if (empty($name) || empty($email) || empty($password) || empty($matric) || empty($faculty) || empty($level) || empty($department)) {
        $errorMsg = '<h3 style="color: white;">Kindly fill out the form</h3>';  
    } else {
        $selectAccount = mysqli_query($conn, "SELECT * FROM `manual` WHERE `matric` = '$matric'");
        $resultAccount = mysqli_num_rows($selectAccount);
        
        if ($resultAccount > 0) {
            $errorMsg = '<h6 style="color: red; margin-top:10px;">Account already exists</h6>';
        } else {
            $insertQuery = "INSERT INTO `manual`(`name`, `email`, `matric`, `department`, `level`, `password`, `faculty`) VALUES ('$name','$email','$matric','$department','$level','$password','$faculty')";
            if (mysqli_query($conn, $insertQuery)) {
                header("Location: login.php");
                exit(); 
            } else {
                $errorMsg = '<h6 style="color: red; margin-top:10px;">Error inserting record: ' . mysqli_error($conn) . '</h6>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e_manual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/93483deb2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@200..700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="sign.css">
    <style>
        .all {
            width: 100%;
            background: linear-gradient(15deg, #54baac, white);
            height: 100vh;
        }
        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 700px;
            padding: 40px;
            margin: 20px auto;
            transform: translate(-50%, -50%);
            background: rgba(0,0,0,.9);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.6);
            border-radius: 10px;
        }
        button {
            background-color: transparent;
            border: none;
        }
        .user-box {
            width: 100%;
            position: relative;
        }
        .user-box input[type="password"] {
            padding-right: 30px;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #fff;
        }
        .login-box form a {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            font-weight: bold;
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 26px !important;
            letter-spacing: 3px;
        }
        .user-box select {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
        }
        .user-box i{
          margin-top: -15px;
        }
        @media (max-width: 764px) {
            .one {
                flex-direction: column;
            }
            .login-box {
                top: 4%;
                left: 0%;
                width: 100%;
                padding: 40px;
                transform: translate(0%, 0%);
                background: rgba(0,0,0,.9);
            }
            .login-box p:first-child {
                margin: 0 0 0px;
                padding: 0;
                color: #fff;
                text-align: center;
                font-size: 1.5rem;
                font-weight: bold;
                letter-spacing: 1px;
            }
            .all {
                padding-top: 10px !important;
            }
        }
    </style>
</head>
<body>
    <div class="all">
        <div class="login-box">
            <p>Signup</p>
            <?php echo $errorMsg; ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="d-flex gap-4 w-100 one">
                    <div class="user-box">
                        <input required name="name" type="text">
                        <label>Name</label>
                    </div>
                    <div class="user-box">
                        <input required name="email" type="email">
                        <label>Email</label>
                    </div>
                </div>
                <div class="d-flex gap-4 w-100 one">
                    <div class="user-box">
                        <input required name="matric" type="number">
                        <label>Matric Number</label>
                    </div>
                    <div class="user-box">
                        <select name="department" id="department">
                            <option value="Computer Science">Computer Science</option>
                            <option value="Cyber Security">Cyber Security</option>
                            <option value="Information System">Information System</option>
                            <option value="Agricultural Economics">Agricultural Economics</option>
                            <option value="Pure & Applied Chemistry">Pure & Applied Chemistry</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="faculty" id="faculty">
                <div class="d-flex gap-4 w-100 one">
                    <div class="user-box">
                        <input required name="level" type="text">
                        <label>Level</label>
                    </div>
                    <div class="user-box">
                        <input required name="password" id="password" type="password">
                        <label>Password</label>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <button class="uiverse" name="submit">
                    <div class="wrapper">
                        <span>LOGIN</span>
                        <div class="circle circle-12"></div>
                        <div class="circle circle-11"></div>
                        <div class="circle circle-10"></div>
                        <div class="circle circle-9"></div>
                        <div class="circle circle-8"></div>
                        <div class="circle circle-7"></div>
                        <div class="circle circle-6"></div>
                        <div class="circle circle-5"></div>
                        <div class="circle circle-4"></div>
                        <div class="circle circle-3"></div>
                        <div class="circle circle-2"></div>
                        <div class="circle circle-1"></div>
                    </div>
                </button>
            </form>
            <p>Don't have an account? <a href="login.php" class="a2">Login!</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.querySelector('form').addEventListener('submit', function() {
        var department = document.getElementById('department').value;
        var facultyField = document.getElementById('faculty');
        
        if (department === 'Computer Science' || department === 'Cyber Security' || department === 'Information System') {
          facultyField.value = 'FCI';
        } else if (department === 'Agricultural Economics') {
          facultyField.value = 'FAG';
        } else if (department === 'Pure & Applied Chemistry') {
          facultyField.value = 'PASSA';
        }
      });

      document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
      });
    </script>
</body>
</html>
