<?php 
   include 'dashboard/connection.php';
   if(isset($_POST['signup'])){
      $uname = $_POST['username'];
      $pw = $_POST['pw'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $priv = $_POST['privilege'];

      $check = mysqli_query($con, "SELECT * FROM users WHERE u_name = '$uname'");

      
      if(mysqli_num_rows($check) > 0){
         $msg = "Sorry! Username Already Exists <br> Try Another One";
         $msgerr = '';
      }else{
         $insert = mysqli_query($con, "INSERT INTO users VALUES ('', '$uname', '$pw', '$fname', '$lname', '$priv')");
         $msg = "User Created Successfully <br> Redirecting To Login In <span>4</span> Seconds...";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Signup</title>
   <link rel="stylesheet" href="./css/dash.css">
   <link rel="shortcut icon" href="icon.svg" type="image/x-icon">
   <?php if (isset($msg) && !isset($msgerr)){ ?>
      <meta http-equiv="refresh" content="4; url=login.php">
   <?php } ?>
   <script src="app.js"></script>
</head>
<body>
   <div class="addForm">
      <h1>SIGN UP - KAINE FC</h1>
      <form method="POST">
         <div class="logo">
            <img src="logo.svg" alt="">
         </div>
         <div class="form">
            <div class="form-inputs">
               <label>Firstname</label>
               <input type="text" name="fname" required>
            </div></br>
            <div class="form-inputs">
               <label>Lastname</label>
               <input type="text" name="lname" required>
            </div><br>
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
            <div class="form-inputs">
               <label>Privilege</label>
               <div class="form-inputs-parts">
                  <div class="part">
                     <input type="radio" name="privilege" value="1" id="accountant" required>
                     <label for="accountant">Accountant</label>
                  </div>
                  <div class="part">
                     <input type="radio" name="privilege" value="2" id="manager" required>
                     <label for="manager">Manager</label>
                  </div>
               </div>
            </div>
            <br>
            <div class="form-buttons">
               <button type="submit" class="confirm" name="signup">Signup</button>
            </div>
            <p>Have Account? <a href="login.php">Login</a></p>
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