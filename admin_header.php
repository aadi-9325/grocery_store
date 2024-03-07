

<?php

// session_start();
// $admin_id = 123; // Replace with the actual admin ID from your login logic
// $_SESSION['admin_id'] = $admin_id;
?>
<?php

include 'config.php';   
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_contacts.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            if ($fetch_profile !== false) {
               // Now it's safe to use $fetch_profile as an array
               echo '<img src="uploaded_img/' . $fetch_profile['image'] . '" alt="">';
               echo '<p>' . $fetch_profile['name'] . '</p>';
           } else {
               // Handle the case where no user was found with the given ID
               echo 'No user';
            }
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><b><u><strong>Aditya Ghodke</strong></u></b></p>
         <!-- <p><?= $fetch_profile['name']; ?></p> -->
         <a href="admin_update_profile.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>

   </div>

</header>