<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php
include 'config.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
  header('location:login.php');
  exit();
}


if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  $select_admin = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND user_type = ?");
  $select_admin->execute([$email, 'admin']);
  $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);

  if ($fetch_admin && password_verify($password, $fetch_admin['password'])) {
    $_SESSION['admin_id'] = $fetch_admin['id'];
    header('location:admin_page.php');
    exit();
  } else {
    $error_msg = 'Incorrect email or password!';
  }
}

?>

<div class="container">

  <form action="" method="POST" class="login-form">
    <h3>Admin Login</h3>
    <?php if (isset($error_msg)) : ?>
      <p class="error-msg"><?= $error_msg ?></p>
    <?php endif; ?>
    <input type="email" name="email" class="box" placeholder="Enter your email" required>
    <input type="password" name="password" class="box" placeholder="Enter your password" required>
    <input type="submit" value="Login" name="login" class="btn">
  </form>

</div>

</body>
</html>
