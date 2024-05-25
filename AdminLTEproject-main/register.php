
<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
include 'config.php';

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = $_POST['password'];
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $subject = 'You have successfully Resgistered.';
   $message1 = "<html>
   <head>
     <title>Registration Confirmation</title>
   </head>
   <body>
     <p>You have successfully registered.</p>
     <p>Your registered email is: $email</p>
     <p>Your registered password is: $password</p>
     <p><a href='localhost/loginauthenticate/login.php'> Click here to Login </a></p>
   </body>
   </html>";



   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   $role = 'user';
   if (mysqli_num_rows($select) > 0) {
      $message[] = 'user already exist';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm password not matched!';
      } else {
         $insert = mysqli_query($conn, "INSERT INTO `admindetail`(name,phone, email, password ,Role) VALUES('$name','$phone', '$email', '$pass', '$role')") or die('query failed');

         if ($insert) {
            $message[] = 'registered successfully!';
            header('location:login.php');
         } else {
            $message[] = 'registeration failed!';
         }
      }
   }
   $errors = [];

   if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $errors[] = 'please enter a valid email address';
   }
   if ($subject == '') {
      $errors[] = 'please enter a subject';
   }
   if ($message1 == '') {
      $errors[] = "please enter a message";
   }

   if (empty($errors)) {

      $mail = new PHPMailer(true);

      try {

         $mail->isSMTP();
         $mail->Host = "smtp.gmail.com";
         $mail->SMTPAuth = "true";
         $mail->Username = "adhaaditya77@gmail.com";
         $mail->Password = "rudvvixclycjpmnh";
         $mail->SMTPSecure = "tls";
         $mail->Port = 587;

         $mail->setFrom('adhaaditya77@gmail.com');
         $mail->addAddress($_POST["email"]);
         $mail->addReplyTo($email);
         $mail->Subject = $subject;
         $mail->isHTML(true);
         $mail->Body = $message1;
         $mail->send();
         $sent = true;

         header('location: login.php');
         echo '<script>';
         echo 'alert("Email is sent to your registered account!");';
         echo '</script>';
      } catch (Exception $e) {
         $errors[] = $mail->ErrorInfo;
      }
   }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if (isset($message)) {
         foreach ($message as $message) {
            echo '<div class="message">' . $message . '</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter username" class="box" required>
        <input type="phone" name="phone" placeholder="enter phone number" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
     
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>

