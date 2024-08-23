<?php 
   $con = mysqli_connect('localhost','root','','kainefc');

   if(isset($_SESSION['logged'])){
      $sessionid = $_SESSION['logged'];
      $getUser = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$sessionid'");
      $fetch = mysqli_fetch_assoc($getUser);
      $loggedFname = $fetch['fname'];
      $loggedLname = $fetch['lname'];
      $loggedPrivilege = $fetch['privilege'];
   }
?>