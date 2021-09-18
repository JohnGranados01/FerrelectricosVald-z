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
    <title>Consulta de Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><!-- Clase de bootsrap CSS-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-light" style="background-color: #C2824F;">
    <div class="container-fluid">
      <a class="navbar-brand" href="registrar_Factura.php">Registrar Factura</a>
      <a class="navbar-brand" href="eliminar_Factura.php">Eliminar Factura</a>
      <a class="navbar-brand" href="ver_Factura.php">Ver Factura</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: #C2824F;">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Ferrelectricos Valdéz</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
                Bienvenido <?= $user['usuario'] ?>
                <a href="logout.php">Cerrar Sesión</a>
                </li>

            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="../index.php">index</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../cliente.php">Clientes</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Factura
              </a>
              <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="registrar_Factura.html">Registrar Factura</a></li>
                <li><a class="dropdown-item" href="eliminar_Factura.html">Eliminar Factura</a></li>
                <li><a class="dropdown-item" href="ver_Factura.html">Ver Factura</a></li>
              </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../item.php">Items</a>
              </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="container">
    <br>
    <h5 style="text-align: center;">Ingrese los datos para consultar factura</h5>
    <!-- <form class="needs-validation" novalidate> -->
      <form action="">
      <div class="row">
        <div class="col-md-4 position-absulute">
          <label for="criterioBusqueda" class="form-label">Seleccione el criterio de busqueda:</label>
          <select class="form-select" id="criterioBusqueda" required>
            <option selected disabled value="">Escoja...</option>
            <option value="0">Identificación Cliente</option>
            <option value="1">Identificación Factura</option>
          </select>
          <div class="valid-feedback">
            Looks good!
          </div>
          <div class="invalid-feedback">
            Please choose a unique and valid username.
          </div>
        </div>
        <div class="col-md-4 position-absulute">
          <label for="id" class="form-label">Diguite el el criterio de busqueda:</label>
          <input type="number" class="form-control" id="id" required>
          <div class="valid-feedback">
            Datos Correctos!.
          </div>
          <div class="invalid-feedback">
            Datos Incorrectos!.
          </div>
        
        </div>
      
        
      </div>
        
      <br>
      <div class="row">
        <div class="col-sm">
          <button class="btn btn-warning" type="button" onclick="showFacturaId()">Consultar</button>
        </div>
      </div>
      
    </form>
    <br>
    <p id="table">

    </p>
    <br>
    <!-- <div class="row">
      <div class="col-md-6">
        <label for="nombreCliente" class="form-label">Nombre del cliente:</label>
        <label id="nombreCliente">si o no</label>
      </div>
      <div class="col-md-6">
        <label for="id" class="form-label">Identificación:</label>
        <label id="id">si o no</label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label for="fecha" class="form-label">Fecha:</label>
        <label id="fecha">si o no</label>
      </div>
      <div class="col-md-6">
        <label for="direccion" class="form-label">Dirección:</label>
        <label id="direccion">si o no</label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label for="telefono" class="form-label">Telefono:</label>
        <label id="telefono">si o no</label>
      </div>
      <div class="col-md-6">
        <label for="ciudad" class="form-label">Ciudad:</label>
        <label id="ciudad" class="form-label">ioi</label>
      </div>
    </div>
    <br>
    <table class="table">
      <thead class="table-secondary">
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry the Bird</td>
          <td>@twitter</td>
          <td>hola cristina</td>
        </tr>
        <tr>
          <th scope="row"></th>
          <td colspan="2" style="text-align: center;">SubTotal:</td>
          <td>AQUI EL SUBTOTAL DINAMICO</td>
        </tr>
        <tr>
          <th scope="row"></th>
          <td colspan="2" style="text-align: center;">Iva:</td>
          <td>AQUI EL IVA DINAMICO</td>
        </tr>
        <tr>
          <th scope="row"></th>
          <td colspan="2" style="text-align: center;">Valor neto a pagar:</td>
          <td>AQUI EL VALOR NETO A PAGAR</td>
        </tr>
      </tbody>
    </table> -->
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script><!-- Clase de bootsrap Bundle-->
    <script src="../logica/factura.js"></script> <!-- Clase de logica para factura-->
    <script src="../logica/pago.js"></script> <!-- Clase de logica para factura-->
    <script src="../scripts/script.js"></script> <!-- Clase de script para factura-->
</body>
<br>
<footer style="background-color: #000000;">
  <div class="container">
    <br>
    <div class="row">
      
        <div class="col-sm">
          <p style="color: white;">Ferreléctricos Valdéz</p>
          
        </div>
        <div class="col-sm">
          <p style="color: white;">313 7144775</p>
        </div>
      
    </div>
    <div class="row">
      <div class="col-sm">
        <p style="color: white;">Dirección</p>
      </div>
      <div class="col-sm">
        <p style="color: white;">Carrera 26 #9 - 151 Sogamoso, Boyacá, Colombia</p>
      </div>
    </div>
    <div class="row">
    <p style="color: white;">Facturación WEB 2021</p>
    </div>
    <br>
  </div>
</footer>
</html>