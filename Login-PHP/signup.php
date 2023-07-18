<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql); //PREPARA SQL
    $stmt->bindParam(':email', $_POST['email']); //VALIDAR PARAMETROS
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //CIFRAR
    $stmt->bindParam(':password', $password); //VALIDAR PARAMETROS

    if ($stmt->execute()) {
      $message = 'Se creo';
    } else {
      $message = 'No se creo';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>

    <?php require 'partials/header.php'
    ?>

    <?php
        if(!empty($message)):
    ?>

    <p><?=$message?></p>

    <?php endif; ?>
    
    <h1>Signup</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <!--LO QUE YO PONGO EN NAME LO USO EN EL METODO POST DE PHP-->
        <input type="password" name="password" placeholder="Enter your password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="Sent">
    </form>
</body>
</html>