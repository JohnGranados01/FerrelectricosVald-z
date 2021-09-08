<!-- Requerimos la BD -->
<?php
    require 'database.php';

    $message='';

    if (!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['confirmar_password'])) {
        if($_POST['password'] == $_POST['confirmar_password']){
            $sql = "INSERT INTO users (usuario, password) VALUES (:usuario, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario', $_POST['usuario']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                $message = 'Usuario Creado Satisfactoriamente!';
            } else {
                $message = 'Lamentablemente no se pudeo crear el Usuario!';
            }
        }else{
            $message = 'Las Contraseñas no coinciden!';
        }
        

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php
        require 'resours/header.php'
    ?>

    <?php
        if(!empty($message)):
    ?>
    <p>
        <?= $message
        ?>
    </p>
    <?php endif; ?>

    <h1>Registrarse</h1>
    <span> ó 
        <a href="login.php">Ingresa</a>
    </span>
    <form action="registrarse.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingrese su usuario" required>
      <input name="password" type="password" placeholder="Ingresa la contraseña" required>
      <input name="confirmar_password" type="password" placeholder="Confirma tu contraseña" required>
      <button type="submit" class="btn btn-warning" onclick="validatePasssword()">Registrar</button>
    </form>
    <script src="scripts/script.js"></script>
</body>
</html>