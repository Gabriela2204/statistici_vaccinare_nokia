<?php
session_start();
if(!isset($_SESSION["SESSION_EMAIL"])){
  header("Location: index1.php ");
}
include 'config.php';
 ?>
 <!doctype html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport"
         content="width=device-width, user-scable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0>">
    <title>Statistici Covid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="style-pagina11.css?ts=<?=time()?>" />
    <style>
    .line{
    color: #4CAF50;
     list-style-type: none;
     position: absolute;
    right:20px; top:2px;
     margin: 0;
     padding: 0;
     font-family: 'Poppins', sans-serif;
     display: flex;
    }
    .imagine{
margin: 0 auto;
width: 70px;
height: auto;
position: absolute;
left: 25px;
top: -30px

    }

.button_log{
    background-color: #4CAF50;
    color: white;
    padding: 12px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    

}


    </style>
 </head>
 <body>

  </iframe></div>
  <div class="btnholder">
 <a href="pagina3vreausamavaccinez.php">  <button class="button button1 hfsu"><span>Vreau sa ma vaccinez</span></button></a>
 <!-- modific si dau href catre o pagina test , cea buna fiind pagina2statistici.php -->
 <a href="pagina2statistici.php">  <button class="button button2 hfsu"><span>Statistici</span></button></a>
</div>
<div>
  <?php
  $sql= "SELECT * from utilizatori where email='{$_SESSION["SESSION_EMAIL"]}'" ;
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);}
?>
</div>
<div class="line">
<h3> Bine ai venit, <?php echo $row["name"]; ?><span class="form"><a href="logout.php"><p><div class="btnholder2"><button class="button button_log hfsu"><span>Logout</span> </button></div></h3>
</div>
<div class="imagine">
  <a href="test_grafice.php"> <img src="Logo.png"  alt="Logo" width="150" height="150">
</div>
 </body>
 </html>
