<?php
session_start();
if(!isset($_SESSION["SESSION_EMAIL"])){
  header("Location: index1.php ");
}
 ?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
        content="width=device-width, user-scable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0>">
   <title>Covid Statistics</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
   <link rel="stylesheet" href="style-pagina11.css">
</head>
<body>
<a href="pagina3vreausamavaccinez.html">  <button class="button button1">Vreau sa ma vaccinez</button></a>
<a href="pagina2statistici.html">  <button class="button button2">Statistici</button></a>
</body>
</html>
