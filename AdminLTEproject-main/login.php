
<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select = mysqli_query($conn, "SELECT * FROM `admindetail` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $fetch = mysqli_fetch_assoc($select);
      ob_end_clean();
      $_SESSION['id'] = $fetch['id'];
      $_SESSION['email'] = $fetch['email'];
      $_SESSION['username'] = $fetch['name'];
      if ($fetch['Role'] == 'admin') {

         header('Location: profile.php');
         exit();
      } else if ($fetch['Role'] == 'user') {
         header('Location:userPanel/index.html');
         exit();
      }


   } else {
      $message[] = 'incorrect email or password!';
   }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>login now</h3>
      <?php
      if (isset($message)) {
         foreach ($message as $message) {
            echo '<div class="message">' . $message . '</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
      <p><a href="forgot_password.php">Forgot password?</a></p>
      <?php
      define('MYSITE', true);

      ?>
      <p>don't have an account? <a href="register.php">regiser now</a></p>
   </form>

</div>

</body>
</html>