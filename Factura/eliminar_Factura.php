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
  function getComprobantes(){
    require '../database.php';
    $consulta = $conn->query("SELECT id AS id FROM comprobante");
    return $consulta;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><!-- Clase de bootsrap CSS-->

</head>
<body>
  <nav class="navbar navbar-light" style="background-color: #C2824F;">
    <div class="container-fluid">
      <a class="navbar-brand" href="registrar_Factura.php">Registrar Factura</a>
      <a class="navbar-brand" href="consultar_Factura.php">Consultar Factura</a>
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
                <li><a class="dropdown-item" href="registrar_Factura.php">Registrar Factura</a></li>
                <li><a class="dropdown-item" href="consultar_Factura.php">Consular Factura</a></li>
                <li><a class="dropdown-item" href="ver_Factura.php">Ver Factura</a></li>
              </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../item.html">Items</a>
              </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="container">
    <br>
    <br>
    <h5 style="text-align: center;">Ingrese los datos para eliminar factura</h5>
    <br>
    <br>
    <form class="needs-validation" novalidate>
      <div class="row">
        <div class="col-md-4 position-absulute">
          <label for="criterioBusqueda" class="form-label">Seleccione el criterio de busqueda:</label>
          <select class="form-select" id="criterioBusqueda" required>
            <option selected disabled value="">OBLIGATORIO...</option>
            <option>Por id de factura</option>
          </select>
          <div class="valid-feedback">
            Campo correcto!
          </div>
          <div class="invalid-feedback">
            Por favor seleccione la opcion.
          </div>
        </div>
        <div class="col-md-4 position-absulute">
          <label for="idFactura" class="form-label">Seleccione el número de la factura:</label>
          <select name="id" class="form-select" id="id" required>
                <option value="">OBLIGATORIO</option>
                <?php
                  require '../database.php';
                  $array = getComprobantes();
                  foreach($array as $res){
                    echo '<option value="'.$res['id'].'">'.$res['id'].'</option>';
                  }
                ?>
              </select>
          <div class="valid-feedback">
            Campo Correcto!
          </div>        
          <div class="invalid-feedback">
            Por favor seleccione # Factura.
          </div>
        </div>
      
        <div class="row">
        <div class="col-sm">
          <br>
          <input class="btn btn-warning" type="submit" name="eliminar" value="Eliminar">
        </div>
      </div>
      </div>
        
      <br>
      
      <?php
      /*Codigo que permite eliminar un comprobante por id
      */ 
      if(isset($_GET['eliminar'])){
        require '../database.php';
        $id = $_GET['id'];
        $result= $conn->query("DELETE FROM comprobante WHERE id=$id");
       
        if(!empty($result)){
          echo '<script language="javascript">alert("El comprobante con id '.$id.
          ' se eliminó con éxito");</script>';
        }else{
        }
      }
      ?>

    </form>
    <br>
  </div>
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