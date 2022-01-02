<?php
session_start();
if(isset($_SESSION["SESSION_EMAIL"])){
  header("Location: statistici.php ");
}

if(isset($_POST["submit"])){
  include 'config.php';
  $name=mysqli_real_escape_string($conn, $_POST["name"]);
  $email=mysqli_real_escape_string($conn, $_POST["email"]);
  $password=mysqli_real_escape_string($conn, $_POST["password"]);
  $cpassword=mysqli_real_escape_string($conn, $_POST["cpassword"]);

 if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM utilizatori where email='{$email}'"))>0){
   echo "<script>alert('{$email}- Acest email este deja inregistrat.')</script>";
 }else {
   if($password === $cpassword){
     $sql = "INSERT INTO utilizatori (name,email,password) VALUES ('{$name}','{$email}','{$password}')";
      $result = mysqli_query($conn,$sql);
      if($result){
        header("Location: index1.php");
      }else{
        echo "<script>Error: ".$sql.mysqli_error($conn)."</script>";
      }

   }else{
     echo "<script>alert('Parola nu coincide cu campul confirma parola. ')</script>";
   }
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
  <h2 class="title">Inregistrare</h2>
  <form action="" method="post" class="form">
    <div class="input-field">
      <label for="name" class="input-label">Nume complet</label>
      <input type="name" name="name"  id="name" class="input" placeholder="Introduce numele complet" required>
    </div>
    <div class="input-field">
      <label for="email" class="input-label">Email</label>
      <input type="email" id="email" name="email" class="input" placeholder="Introduce email" required>
    </div>
    <div class="input-field">
      <label for="password" class="input-label">Parola</label>
      <input type="password" id="password" name="password" class="input" placeholder="Introduce parola" required>
    </div>
    <div class="input-field">
      <label for="cpassword" class="input-label">confirma parola</label>
      <input type="password" id="cpassword" name="cpassword" class="input" placeholder="Introduce parola" required>
    </div>
    <button class="btn" name="submit">Inregistrare</button>
    <p>Ai deja un cont! <a href="index1.php">Login</a>.</p>

  </form>
</div>
</body>
</html>
