<?php

    session_start(); 

    require '../database.php';

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
    <title>Registro de Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><!-- Clase de bootsrap CSS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  </head>
<body>
  <?php if(!empty($user)):?>
  <nav class="navbar navbar-light" style="background-color: #C2824F;">
    <div class="container-fluid">
      <a class="navbar-brand" href="consultar_Factura.html">Consultar Factura</a>
      <a class="navbar-brand" href="eliminar_Factura.html">Eliminar Factura</a>
      <a class="navbar-brand" href="ver_Factura.html">Ver Factura</a>
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
                <li><a class="dropdown-item" href="consultar_Factura.php">Consular Factura</a></li>
                <li><a class="dropdown-item" href="eliminar_Factura.php">Eliminar Factura</a></li>
                <li><a class="dropdown-item" href="ver_Factura.php">Ver Factura</a></li>
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
        <h5 style="text-align: center;">Ingrese los datos para registrar factura</h5>
        <!-- <form class="needs-validation" novalidate> -->
          <form id="form">
          <div class="row g-3">
            <div class="col-md-4 position-absulute">
              <label for="nombre" class="form-label">Nombre del cliente:</label>
              <input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
            <div class="col-md-4 position-absulute">
              <label for="id" class="form-label">Identificación:</label>
              <input type="number" class="form-control" id="id" placeholder="C.C." required>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 position-absulute">
              <label for="fecha" class="form-label">Fecha:</label>
              <div class="input-group has-validation">
                <input type="date" class="form-control" id="fecha" aria-describedby="validationTooltipUsernamePrepend" required>
                <div class="valid-feedback">
                  Campos validos.
                </div>
                <div class="invalid-feedback">
                  Campo Requerido.
                </div>
              </div>
              </div>
            <div class="col-md-4 position-absulute">
              <label for="direccion" class="form-label">Dirección:</label>
              <input type="text" class="form-control" id="direccion" placeholder="Dirección" required>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 position-absulute">
              <label for="telefono" class="form-label">Telefono:</label>
              <input type="number" class="form-control" id="telefono" placeholder="Telefono" required>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
            <div class="col-md-4 position-absulute">
              <label for="ciudad" class="form-label">Ciudad</label>
              <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" required>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
          </div>
            
          <br>
        <div class="row">
          <div class="col-sm">
            <button class="btn btn-warning" type="button" onclick="registrar()">Registrar</button>
          </div>
        </div>
        
          
        </form>

        <div class="form-group col-sm">
          <br>
          <p id="table">
            
          </p>
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
        </table>
    </div>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script><!-- Clase de bootsrap Bundle-->
    <script src="../logica/factura.js"></script> <!-- Clase de logica para factura-->
    <script src="../logica/pago.js"></script> <!-- Clase de logica para factura-->
    <script src="../scripts/script.js"></script> <!-- Clase de script para factura-->
</body>
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