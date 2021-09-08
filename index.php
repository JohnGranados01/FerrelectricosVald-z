<?php
    session_start();

    require 'database.php';

    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, usuario, password FROM users WHERE id = :id ');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><!-- Clase de bootsrap CSS-->
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php if(!empty($user)):?>
    
    <body>
    <nav class="navbar navbar-light" style="background-color: #C2824F;">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.html" style="margin-left: 80px;">Ferrelectricos Valdéz</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: #C2824F;">
            <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Facturación Web</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                Bienvenido <?= $user['usuario'] ?>
                <a href="logout.php">Cerrar Sesión</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="cliente.html">Clientes</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Factura
                </a>
                <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                    <li><a class="dropdown-item" href="Factura/registrar_Factura.html" target="_blank">Registrar Factura</a></li>
                    <li><a class="dropdown-item" href="Factura/consultar_Factura.html" target="_blank">Consular Factura</a></li>
                    <li><a class="dropdown-item" href="Factura/eliminar_Factura.html" target="_blank">Eliminar Factura</a></li>
                    <li><a class="dropdown-item" href="Factura/ver_Factura.html" target="_blank">Ver Factura</a></li>
                </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="item.html">Items</a>
                </li>
            </ul>
            </div>
        </div>
        </div>
  </nav>
  <div class="container">
    </div>
    </body>
    <!-- si no esta registrado el usuario muestra esto -->
    <?php else: ?>
        <div class="container">
            <h1>Por favor ingrese o registrese</h1>
            <!-- <p style="text-aling:center;"> -->
                <a href="login.php">Ingresar</a> ó
                <a href="registrarse.php">Registrarse</a>
            <!-- </p> -->
        </div>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="scripts/script.js"></script>
</body>
</html>