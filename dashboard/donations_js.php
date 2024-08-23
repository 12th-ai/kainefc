<?php 
   session_start();
   if(!isset($_SESSION['logged'])){
      header('location: ../login.php');
   }
   include 'connection.php';
   if(isset($_GET['page'])){
      $page = $_GET['page'];
   }else{
      $page = 1;
   }
   $recordToShow = 5;
   $offset = ($page - 1) * $recordToShow;
   $sql = mysqli_query($con, "SELECT * FROM donation LIMIT $offset, $recordToShow");
   $all = mysqli_query($con, "SELECT * FROM donation");
   $allPages = ceil(mysqli_num_rows($all) / $recordToShow);
   if(isset($_GET['q'])){
      $search = $_GET['q'];
      $sql = mysqli_query($con, "SELECT * FROM `donation` WHERE Ot_id LIKE '%$search%' OR Name LIKE '%$search%' OR date LIKE '%$search%'OR type LIKE '%$search%' OR amount LIKE '%$search%'");
   }
   if(isset($_POST['add'])){
      $name = $_POST['name'];
      $date = $_POST['date'];
      $type = $_POST['type'];
      $amount = $_POST['amount'];

      $query = mysqli_query($con, "INSERT INTO donation VALUES ('', '$name', '$date', '$type', '$amount')");
      if($query) {
         $msg = "Data Inserted In Donations Successfully <br> Refreshing Web In <span>4</span> Seconds...";
      }
   }
   if(isset($_POST['update'])){
      $name = $_POST['name'];
      $date = $_POST['date'];
      $type = $_POST['type'];
      $amount = $_POST['amount'];
      $update = $_POST['toUpdate'];
      $query = mysqli_query($con, "UPDATE donation SET Name = '$name', date = '$date', type = '$type', amount = '$amount' WHERE Ot_id = '$update'");
      if($query) {
         $msg = "Donation Updated Successfully <br> Refreshing Web In <span>4</span> Seconds...";
      }
   }
   if(isset($_POST['filter'])){
      $from = $_POST['from'];
      $to = $_POST['to'];
      $sql = mysqli_query($con, "SELECT * FROM `donation` WHERE date BETWEEN '$from' AND '$to'");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Donations - Kaine FC</title>
   <link rel="shortcut icon" href="../icon.svg" type="image/x-icon">
   <link rel="stylesheet" href="../css/dash.css">
   <script src="../app.js" ></script>
   <?php if (isset($msg) && !isset($msgerr)){?>
      <meta http-equiv="refresh" content="4; url=donations.php">
   <?php } ?>
</head>
<body>
   <aside>
      <div class="main_nav">
         <img src="logo.svg" alt="Logo">
         <nav>
            <a href="./">Dashboard</a>
            <a href="donations.php" class="active">Donations</a>
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
         <h1>
            Donations (<?php echo mysqli_num_rows($sql);?>)
         </h1>
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
               <a href="">
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
         <br>
         <div class="data_div">
            <h1 class="title">Filter / Search</h1>
            <div class="filter">
               <div class="date_search">
                  <form method="POST">
                     <div class="data_each">
                        From
                        <input type="date" name="from" value="<?php if(isset($_POST['filter'])){echo $from;}?>">
                     </div>
                     <span>-</span>
                     <div class="data_each">
                        To
                        <input type="date" name="to" value="<?php if(isset($_POST['filter'])){echo $to;}?>">
                     </div>
                     <button class="myBtns" name="filter">Filter</button>
                  </form>
               </div>
               <?php if(isset($_POST['filter']) || isset($_GET['q'])){ ?>
                  <a href="donations.php" class="myBtns">Reset Filters</a>
               <?php } ?>
               <div class="reg_search">
                  <form method="GET">
                     <input type="search" name="q" value="<?php if(isset($_GET['q'])){echo $_GET['q'];}?>" id="" placeholder="Search Here">
                     <button class="myBtns">Search</button>
                  </form>
               </div>
            </div>
            <br>
            <button class="myBtns openPop" onclick="popUp()">Add In Donations</button>
            <?php if(isset($_GET['q'])){?>
               <p class="table_title"><?php echo mysqli_num_rows($sql)?> Search Results For "<span><?php echo $_GET['q']?></span>"</p>
            <?php } ?>
            <?php if(isset($_POST['filter'])){?>
               <p class="table_title"><?php echo "Report From <span>".$from."</span> To <span>".$to."</span>"; ?></p>
            <?php } ?>
            <?php 
               if(mysqli_num_rows($sql) > 0){
            ?>
               <div class="data_table">
                  <table>
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <?php if($loggedPrivilege == 2){?>
                           <th class="actions">Actions</th>
                        <?php } ?>
                     </tr>
                     <?php 
                        while($fetch = mysqli_fetch_assoc($sql)){
                           $offset++;
                     ?>
                     <tr>
                        <td><?php echo $offset?></td>
                        <td><?php echo $fetch['Name'];?></td>
                        <td><?php echo $fetch['date'];?></td>
                        <td><?php echo $fetch['type'];?></td>
                        <td><?php echo number_format($fetch['amount'],2,'.',',')." FRW ";?></td>
                        <?php if($loggedPrivilege == 2) { ?>
                           <td class="actions">
                              <a href="./donations.php?delete=<?php echo $fetch['Ot_id']?>" class="myBtns deleteBtn">Delete</a>
                              <button class="myBtns" onclick='popUpdate(<?php echo json_encode($fetch)?>)'>Update</button>
                           </td>
                        <?php } ?>
                     </tr>
                     <?php } ?>
                  </table>
                  <div class="data_more">
                     <p>Viewing Page <?php echo $page?> Out Of <?php echo $allPages?></p>
                     <div class="actions">
                        <button onclick="window.print()" class="myBtns">Print Report</button>
                        <div class="pagination">
                           <a href="./donations.php?page=<?php echo $page - 1;?>" class="goTo <?php if($page == 1) {echo 'disabled';}?>">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><path d="M33.960938 2.9804688 A 2.0002 2.0002 0 0 0 32.585938 3.5859375L13.585938 22.585938 A 2.0002 2.0002 0 0 0 13.585938 25.414062L32.585938 44.414062 A 2.0002 2.0002 0 1 0 35.414062 41.585938L17.828125 24L35.414062 6.4140625 A 2.0002 2.0002 0 0 0 33.960938 2.9804688 z"/></svg>
                           </a>
                           <span><?php echo $page?></span>
                           <a href="./donations.php?page=<?php echo $page + 1?>" class="goTo <?php if($page >= $allPages){echo 'disabled';}?>">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><path d="M17.586,44.414C17.977,44.805,18.488,45,19,45s1.023-0.195,1.414-0.586l19-19c0.781-0.781,0.781-2.047,0-2.828l-19-19 c-0.781-0.781-2.047-0.781-2.828,0s-0.781,2.047,0,2.828L35.172,24L17.586,41.586C16.805,42.367,16.805,43.633,17.586,44.414z"/></svg>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            <?php } else { ?>
               <p class="no_data">No Data Found In 'Donations'</p>
            <?php } ?>
         </div>
      </div>
   </main>
   <div class="popup reg_pop">
      <div class="addForm popUpform">
         <h1>Add In Donations</h1>
         <form method="POST">
            <div class="form-inputs">
               <label>Name</label>
               <input type="text" name="name" required>
            </div>
            <div class="form-inputs">
               <label>Date</label>
               <input type="date" name="date" min="<?php echo date('Y-m-d')?>" required>
            </div>
            <div class="form-inputs">
               <label>Type</label>
               <input type="text" name="type" required>
            </div>
            <div class="form-inputs">
               <label>Amount (RWF)</label>
               <input type="number" name="amount" placeholder="Ex: 90900" required>
            </div>
            <div class="form-buttons">
               <button type="submit" class="confirm" name="add">Add</button>
               <button type="reset">Reset</button>
            </div>
         </form>
      </div>
      <div class="close" onclick="popUp()">
         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"><path d="M7.21875 5.78125L5.78125 7.21875L14.5625 16L5.78125 24.78125L7.21875 26.21875L16 17.4375L24.78125 26.21875L26.21875 24.78125L17.4375 16L26.21875 7.21875L24.78125 5.78125L16 14.5625Z"/></svg>
      </div>
   </div>
   <div class="popup update_pop">
      <div class="addForm popUpform">
         <h1>Update Donation</h1>
         <form method="POST" >
            <div class="form-inputs">
               <label>Name</label>
               <input type="text" name="name" required>
            </div>
            <div class="form-inputs">
               <label>Date</label>
               <input type="date" name="date" min="<?php echo date('Y-m-d')?>" required>
            </div>
            <div class="form-inputs">
               <label>Type</label>
               <input type="text" name="type" required>
            </div>
            <div class="form-inputs">
               <label>Amount (RWF)</label>
               <input type="number" name="amount" placeholder="Ex: 90900" required>
            </div>
            
            <div class="form-buttons">
               <button type="submit" class="confirm" name="update">Update</button>
               <button type="reset">Reset</button>
            </div>
            <input type="text" name="toUpdate" hidden readonly>
         </form>
      </div>
      <div class="close" onclick="closeUpdate()">
         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"><path d="M7.21875 5.78125L5.78125 7.21875L14.5625 16L5.78125 24.78125L7.21875 26.21875L16 17.4375L24.78125 26.21875L26.21875 24.78125L17.4375 16L26.21875 7.21875L24.78125 5.78125L16 14.5625Z"/></svg>
      </div>
   </div>
   <?php if(isset($msg)){ ?>
      <div class="notification <?php if(isset($msgerr)){echo 'error';}?>">
         <?php echo $msg?>
      </div>
      <script>
         popup()
      </script>
   <?php } ?>
   <script>
      function popUp(){
         let pop = document.querySelector('.reg_pop');
         pop.classList.toggle('active');
      }
      function popUpdate(obj){
         let pop = document.querySelector('.update_pop');
         pop.classList.toggle('active');
         pop.querySelector("form input[name = 'name']").value = obj.Name;
         pop.querySelector("form input[name = 'date']").value = obj.date;
         pop.querySelector("form input[name = 'type']").value = obj.type;
         pop.querySelector("form input[name = 'amount']").value = obj.amount;
         pop.querySelector("form input[name = 'toUpdate']").value = obj.Ot_id;
      }
      function closeUpdate() {
         let pop = document.querySelector('.update_pop');
         // pop.querySelector("form button[type = 'reset']").click();
         pop.querySelector("form").reset();
         pop.classList.toggle('active');
      }
      let drop = document.querySelector('.more_options button');
      drop.addEventListener('click', function() {
         this.parentElement.classList.toggle('active');
      })
   </script>
</body>
</html>