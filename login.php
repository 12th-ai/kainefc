<?php 
   session_start();
   include 'dashboard/connection.php';

   if(isset($_GET['logout'])){
      session_destroy();
      $msg = "You're Logged Out! Successfuly";
   }

   if(isset($_SESSION['logged']) && !isset($_GET['logout'])){
      header('location: ./dashboard/');
   }

   if(isset($_POST['login'])){
      $uname = $_POST['username'];
      $pw = $_POST['pw'];

      $check = mysqli_query($con, "SELECT * FROM users WHERE u_name = '$uname' AND u_password = '$pw'");

      if(mysqli_num_rows($check) > 0){
         $msg = "Login Successful <br> Redirecting To Dashboard In <span>4</span> Seconds...";
         $fetch = mysqli_fetch_array($check);
         $_SESSION['logged'] = $fetch['user_id'];
      }else{
         $msg = "Sorry! User Doesn't Exist <br> Create Account";
         $msgerr = '';
      }
   }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="./css/dash.css">
   <link rel="shortcut icon" href="icon.svg" type="image/x-icon">
   <?php if (isset($msg) && !isset($msgerr)){?>
      <meta http-equiv="refresh" content="4; url=./dashboard/">
   <?php } ?>
   <script src="app.js" ></script>
</head>
<body>
   <div class="addForm">
      <h1>Login</h1>
      <form method="POST">
         <div class="logo">
            <img src="logo.svg" alt="">
         </div>
         <div class="form">
            <div class="form-inputs">
               <label>Username</label>
               <input type="text" name="username" required>
            </div>
            <br>
            <div class="form-inputs">
               <label>Password</label>
               <input type="password" name="pw" required>
            </div>
            <br>
            <div class="form-buttons">
               <button type="submit" name="login" class="confirm">Login</button>
            </div>
            <p>No Account? <a href="signup.php">Sign Up</a></p>
         </div>
      </form>
   </div>
   <?php if(isset($msg)){ ?>
      <div class="notification <?php if(isset($msgerr)){echo 'error';}?>">
         <?php echo $msg?>
      </div>
      <script>
         popup()
      </script>
   <?php } ?>
   <style>
      body{
         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
         background: #fff;
      }
      .addForm{
         box-shadow: 0 0px 20px rgba(0,0,0,.1);
         max-width: 600px !important;
      }
      form{
         display: flex;
         flex-direction: row !important;
         align-items: center;
         column-gap: 10px;
      }
      form .logo{
         width: 320px;
         display: flex;
      }
      form .logo img {
         width: 100%;
         height: 100%;
      }
      .form{
         width: 400px !important;
      }
   </style>
</body>
</html>