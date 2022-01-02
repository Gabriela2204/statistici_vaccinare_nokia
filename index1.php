<?php
session_start();
if(isset($_SESSION["SESSION_EMAIL"])){
  header("Location: statistici.php ");
}

if(isset($_POST["login"])){
  include 'config.php';
 $email = mysqli_real_escape_string($conn, $_POST["email"]);
 $password = mysqli_real_escape_string($conn, $_POST["password"]);

 $sql = "SELECT * from utilizatori WHERE email='{$email}' AND password='{$password}' ";
 $result = mysqli_query($conn,$sql);
 $count= mysqli_num_rows($result);
 if($count === 1){
 $_SESSION["SESSION_EMAIL"] = $email;
 header("Location: statistici.php");
 }else{
   echo "<script>alert('Datele sunt incorecte .');</script>";
 }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"  >
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="styleLogin.css">
  <title>Login</title>
</head>
<body>
<div class="wrapper">
  <h2 class="title">Login</h2>
  <form action="" method="post" class="form">
    <div class="input-field">
      <label for="email" class="input-label">Email</label>
      <input type="email" id="email" name="email" class="input" placeholder="Introduce email" required>
    </div>
    <div class="input-field">
      <label for="password" class="input-label">Parola</label>
      <input type="password" id="password" name="password" class="input" placeholder="Introduce parola" required>
    </div>
    <button class="btn" name="login"><a href="statistici.php">Login</button>
    <p>Creaza un cont! <a href="register.php">Register</a>.</p>

  </form>
</div>
</body>
</html>
