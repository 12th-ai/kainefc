<?php 
   session_start();
   if(!isset($_SESSION['logged'])){
      header('location: ../login.php');
   }
   include './connection.php';
   // session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard - Kaine FC</title>
   <link rel="shortcut icon" href="../icon.svg" type="image/x-icon">
   <link rel="stylesheet" href="../css/dash.css">
</head>
<body>
   <aside>
      <div class="main_nav">
         <img src="logo.svg" alt="Logo">
         <nav>
            <a href="./" class="active">Dashboard</a>
            <a href="donations.php">Donations</a>
            <a href="donors.php">Donors</a>
         </nav>
      </div>
      <a href="../login.php?logout">
         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><path d="M12.5 5C9.4802259 5 7 7.4802259 7 10.5L7 37.5C7 40.519774 9.4802259 43 12.5 43L24.5 43C27.519774 43 30 40.519774 30 37.5L30 28L27 28L27 37.5C27 38.898226 25.898226 40 24.5 40L12.5 40C11.101774 40 10 38.898226 10 37.5L10 10.5C10 9.1017741 11.101774 8 12.5 8L24.5 8C25.898226 8 27 9.1017741 27 10.5L27 20L30 20L30 10.5C30 7.4802259 27.519774 5 24.5 5L12.5 5 z M 34.484375 15.484375 A 1.50015 1.50015 0 0 0 33.439453 18.060547L37.878906 22.5L15.5 22.5 A 1.50015 1.50015 0 1 0 15.5 25.5L37.878906 25.5L33.439453 29.939453 A 1.50015 1.50015 0 1 0 35.560547 32.060547L42.560547 25.060547 A 1.50015 1.50015 0 0 0 42.560547 22.939453L35.560547 15.939453 A 1.50015 1.50015 0 0 0 34.484375 15.484375 z"/></svg>
         Logout
      </a>
   </aside>
   <main>
      <div class="top_nav">
         <h1>Dashboard</h1>
         <div class="more_options">
            <button>
               <?php echo "$loggedFname <span>$loggedLname</span>"?>
               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><path d="M38.5,13h-29c-0.57,0-1.092,0.323-1.345,0.835c-0.253,0.511-0.193,1.122,0.152,1.575l14.5,19 C23.092,34.782,23.532,35,24,35s0.908-0.218,1.192-0.59l14.5-19c0.346-0.453,0.405-1.064,0.152-1.575 C39.592,13.323,39.07,13,38.5,13z"/></svg>
            </button>
            <div class="options">
               <a href="./profile.php">
                  View Profile
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><path d="M15.978516 5.9804688 A 2.0002 2.0002 0 0 0 14.585938 9.4140625L29.171875 24L14.585938 38.585938 A 2.0002 2.0002 0 1 0 17.414062 41.414062L33.414062 25.414062 A 2.0002 2.0002 0 0 0 33.414062 22.585938L17.414062 6.5859375 A 2.0002 2.0002 0 0 0 15.978516 5.9804688 z"/></svg>
               </a>
               <a href="./changepw.php">
                  Change Password
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><path d="M15.978516 5.9804688 A 2.0002 2.0002 0 0 0 14.585938 9.4140625L29.171875 24L14.585938 38.585938 A 2.0002 2.0002 0 1 0 17.414062 41.414062L33.414062 25.414062 A 2.0002 2.0002 0 0 0 33.414062 22.585938L17.414062 6.5859375 A 2.0002 2.0002 0 0 0 15.978516 5.9804688 z"/></svg>
               </a>
               <a href="../login.php?logout">
                  Log Out
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><path d="M15.978516 5.9804688 A 2.0002 2.0002 0 0 0 14.585938 9.4140625L29.171875 24L14.585938 38.585938 A 2.0002 2.0002 0 1 0 17.414062 41.414062L33.414062 25.414062 A 2.0002 2.0002 0 0 0 33.414062 22.585938L17.414062 6.5859375 A 2.0002 2.0002 0 0 0 15.978516 5.9804688 z"/></svg>
               </a>
            </div>
         </div>
      </div>
      <div class="main_data">
         <h1 class="greetings">Hello, <span><?php echo $loggedLname ?></span></h1>
         <hr>
         <div class="data_div">
            <h1 class="title">Overall Statistics</h1>
            <div class="all_statistics">
               <a href="#" class="each_statistic">
                  <p>
                     <?php 
                        $sql = mysqli_query($con, "SELECT * FROM users");
                        echo mysqli_num_rows($sql);
                     ?>
                  </p>
                  <h1>Users</h1>
               </a>
               <a href="donations.php" class="each_statistic">
                  <p>
                     <?php 
                        $sql = mysqli_query($con, "SELECT * FROM donation");
                        echo mysqli_num_rows($sql);
                     ?>
                  </p>
                  <h1>Donations</h1>
               </a>
               <a href="donors.php" class="each_statistic">
                  <p>
                     <?php 
                        $sql = mysqli_query($con, "SELECT * FROM donors");
                        echo mysqli_num_rows($sql);
                     ?>
                  </p>
                  <h1>Donors</h1>
               </a>
               <a href="profile.php" class="each_statistic">
                  <h2 align="center">My Profile</h2>
               </a>
            </div>
            <br><br>
            <!-- <h1 class="title">My Statistics</h1>
            <div class="all_statistics">
               <a href="" class="each_statistic">
                  <p>5</p>
                  <h1>Added Donors</h1>
               </a>
               <a href="" class="each_statistic">
                  <p>5</p>
                  <h1>Added Donations</h1>
               </a>
            </div> -->
         </div>
      </div>
   </main>
   <script>
      let drop = document.querySelector('.more_options button');
      drop.addEventListener('click', function() {
         this.parentElement.classList.toggle('active');
      })
   </script>
</body>
</html>