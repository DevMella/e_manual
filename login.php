
<?php
session_start();
include "connect.php";

$errorMsg = "";

if(isset($_POST["submit"])){
    $matric = $_POST['matric'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM `manual` WHERE `matric` = ? AND `password` = ?");
    $stmt->bind_param("ss", $matric, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        $_SESSION["matric"] = $user["matric"];
        $_SESSION["password"] = $user["password"];
        header("location: dashboard.php");
        exit();
    } else {
        $errorMsg = '<h6 style="color: red; margin-top:10px;">Invalid matric number or password</h6>';
    }
    $stmt->close();
    $conn->close();
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
        width: 600px;
        padding: 40px;
        margin: 20px auto;
        transform: translate(-50%, -55%);
        background: rgba(0, 0, 0, .9);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        border-radius: 10px;
      }
      .user-box i{
          margin-top: -10px;
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
      @media (max-width:764px) {
        .one {
          flex-direction: column;
        }
        .login-box {
          position: absolute;
          top: 27%;
          left: 0%;
          width: 100%;
          padding: 40px;
          margin: 0px auto;
          transform: translate(0%, 0%);
          background: rgba(0, 0, 0, .9);
          box-sizing: border-box;
          box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
          border-radius: 10px;
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
            <p>Login</p>
            <form action="login.php" method="post">
              <div class="user-box">
                <input required name="matric" type="number">
                <label>Matric Number</label>
              </div>
              <div class="user-box">
                <input required name="password" id="password" type="password">
                <label>Password</label>
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
              </div>
              <button class="uiverse" type="submit" name="submit">
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
            <p>Don't have an account? <a href="signup.php" class="a2">Sign up!</a></p>
            <?php echo $errorMsg; ?>
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
      });
    </script>
</body>
</html>
