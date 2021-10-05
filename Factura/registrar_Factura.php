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
    
    function getClientes(){
      require '../database.php';
      $consulta = $conn->query("SELECT identificacion, nombre FROM cliente");
      return $consulta;
    }
    function getComprobantes(){
      require '../database.php';
      $consulta = $conn->query("SELECT MAX(id) AS id FROM comprobante");
      return $consulta;
    }
    function getItems(){
      require '../database.php';
      $consulta = $conn->query("SELECT Id, denominacion FROM item");
      return $consulta;
    }


      if(isset($_POST['addComprobante_btn'])){
        require '../database.php';
        $dia = 86400;
        $message='';
        $fecha = strtotime($_REQUEST['fecha']);
        $id = $_POST['idCliente'];
          for($i=0; $i<=$fecha; $i=$i+$dia){
            $fechaUno = date("Y-m-d");
            $sql = "INSERT INTO comprobante (fecha, idCliente, total) VALUES (:fecha, '$id')";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fecha', $fechaUno);
            if ($stmt->execute()) {
              $message = 'Comprobante Creado Satisfactoriamente!';
            } else {
              $message = 'Lamentablemente no se pudo crear el Comprobante!';
            }
    
          }
          
        }
         if(isset($_POST['adddetalleComprobante_btn'])){
          require '../database.php';
          $msj='';
          $comprobanteId = $_POST['idComprobante'];
          $itemId = $_POST['idItem'];
          $cantidad = $_POST['cantidadItem'];
          $sql = "INSERT INTO detallecompra (comprobanteId, itemId, cantidad, total) VALUES ('$comprobanteId', '$itemId', '$cantidad', 0)";
          $stmt = $conn->prepare($sql);
          if ($stmt->execute()) {
            $msj = 'Detalle de compra Creado Satisfactoriamente ';
          } else {
            $msj = 'Lamentablemente no se pudo crear el detalle de esa compra!';
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
      <a class="navbar-brand" href="consultar_Factura.php">Consultar Factura</a>
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
        <h5 style="text-align: center;">Ingrese los datos para registrar Comprobante</h5>
        <hr>
          <form class="row g-3 needs-validation" action="registrar_Factura.php" method="POST" novalidate>
          <div class="row g-3">
            <div class="col-md-4 position-absulute">
              <label for="idCliente" class="form-label">Cliente:</label>
              <select name="idCliente" class="form-select" id="idCliente"required>
                <option value="">OBLIGATORIO</option>
                <?php
                  require '../database.php';
                  $array = getClientes();
                  if(sizeof($array)>0){
                    foreach($array as $resultado){
                      echo '<option value="'.$resultado['identificacion'].'">'.$resultado['nombre'].'</option>';
                    }
                  }
                ?>
              </select>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
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
          </div> 
        <div class="row">
          <div class="col-sm">
            <button class="btn btn-warning" type="submit" name="addComprobante_btn">Registrar</button>
          </div>
          <div class="col-sm">
            <button class="btn btn-warning" type="reset">Borrar</button>
          </div>
        </div>
        </form>
        <br>
        <?php if(!empty($message)): ?>
          <div class="alert alert-warning" role="alert">
          <?= $message ?>
          </div>
          <?php endif; ?>
        <br>
        <h5 style="text-align: center;">Ingrese los datos para registrar Detalle de la Compra</h5>
        <hr>
        <form class="row g-3 needs-validation" action="registrar_Factura.php" method="POST" novalidate>
        <div class="row g-3">
            <div class="col-md-4 position-absulute">
              <label for="idComprobante" class="form-label">Comprobante:</label>
              <select name="idComprobante" class="form-select" id="idComprobante"required>
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
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
            <div class="col-md-4 position-absulute">
              <label for="idItem" class="form-label">Item:</label>
              <select name="idItem" class="form-select" id="idItem"required>
                <option value="">OBLIGATORIO</option>
                <?php
                  require '../database.php';
                  $array = getItems();
                  foreach($array as $res){
                    echo '<option value="'.$res['Id'].'">'.$res['denominacion'].'</option>';
                  }
                ?>
              </select>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
            <div class="col-md-4 position-absulute">
              <label for="cantidadItem" class="form-label">Cantidad:</label>
              <input type="number" name="cantidadItem" class="form-control" required>
              <div class="valid-feedback">
                Campos validos.
              </div>
              <div class="invalid-feedback">
                Campo Requerido.
              </div>
            </div>
          </div> 
          <div class="row">
          <div class="col-sm">
            <button class="btn btn-warning" type="submit" name="adddetalleComprobante_btn">Registrar</button>
          </div>
          <div class="col-sm">
            <button class="btn btn-warning" type="reset">Borrar</button>
          </div>
        </div>
        </form>
        <br>
        <?php if(!empty($msj)): ?>
          <div class="alert alert-warning" role="alert">
          <?= $msj ?>
          </div>
          <?php endif; ?>
        <br>
        
        <div class="form-group col-sm">
          <br>
          <p id="table">
            
          </p>
        </div>
        <br>
        <table class="table caption-top">
      <thead class="table-secondary">
        <tr>
          <th scope="col"> Id Comprobante </th>
          <th scope="col"> Item </th>
          <th scope="col"> Cantidad </th>
          <th scope="col"> Precio </th>
          <th scope="col"> Total</th>
          </tr>
      </thead>
      <tbody>
      <?php 
        require '../database.php';
        $comprobanteId = ( empty($_POST['idComprobante']) ) ? NULL : $_POST['idComprobante'];
        if(!empty($comprobanteId)){
          $consulta = $conn->query("SELECT detallecompra.comprobanteId, item.denominacion, detallecompra.cantidad, item.precio, detallecompra.cantidad*item.precio AS Total FROM detallecompra, item 
          WHERE detallecompra.comprobanteId = '$comprobanteId' AND detallecompra.itemId = item.Id");
          foreach($consulta as $result){
            echo "<tr>
            <td>".$result['comprobanteId']."</td>";
                echo "<td>". $result['denominacion']."</td>";
                echo "<td>". $result['cantidad']."</td>";
                echo "<td>". $result['precio']."</td>";
                echo "<td>". $result['Total']."</td>";
                
                echo "<tr>";
                $conn->query("UPDATE detallecompra, item, comprobante SET detallecompra.total = detallecompra.cantidad*item.precio WHERE detallecompra.itemId = item.Id AND detallecompra.comprobanteId =$comprobanteId");
            }
              $suma = $conn->query("SELECT SUM(detallecompra.cantidad*item.precio) AS Suma FROM detallecompra, item 
              WHERE detallecompra.comprobanteId = '$comprobanteId' AND detallecompra.itemId = item.Id");
              foreach($suma as $var){
                echo "<tr class='table-secondary'>
                <td colspan= '4' style='text-align:center'>"."Suma"."</td>";
                echo "<td>".$var['Suma']."</td>";
                echo "</tr>";
            }
            
          
          }
          ?>
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