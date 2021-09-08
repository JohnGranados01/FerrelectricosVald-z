<!-- Requerimos la BD -->
<?php

    session_start(); 

    if (isset($_SESSION['user_id'])) {
        header('Location: /FacturacionWeb2');
      }

    require 'database.php';

    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, usuario, password FROM users WHERE usuario = :usuario');
        $records->bindParam(':usuario', $_POST['usuario']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';
    
        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
          $_SESSION['user_id'] = $results['id'];
          header("Location: /FacturacionWeb2");
        } else {
          $message = 'Lo siento, no se encontraron coincidencias!';
        }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <?php
        require 'resours/header.php'
    ?>

   <!--  <header>
        <a href="/FacturacionWeb2">Ferrelectricos Valdez</a>
    </header> -->

    <h1>Login</h1>
    <span> ó
        <a href="registrarse.php">Registrarse</a>
    </span>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <br>
    <form action="login.php" method="POST">
            
            <input type="text" name="usuario" id="text" class="form-control" placeholder="Ingresa tu usuario.." required>
            <input class="text" type="password" class="form-control" id="password" name="password" placeholder="Ingresa la contraseña" required>
            <button type="submit" value="send" class="btn btn-warning">Enviar</button>
        
    </form>
</body>
</html>