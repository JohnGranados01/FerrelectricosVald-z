
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
    if(isset($_POST['addCliente_btn'])){
      require 'database.php';
      $message='';
      if(!empty($_POST['identificacion'])){
        $sql = "INSERT INTO cliente (identificacion, nombre, apellidos, direccion, correo, telefono) VALUES (:identificacion, :nombre, :apellidos, :direccion, :correo, :telefono)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':identificacion', $_POST['identificacion']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':apellidos', $_POST['apellidos']);
        $stmt->bindParam(':direccion', $_POST['direccion']);
        $stmt->bindParam(':correo', $_POST['correo']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        if ($stmt->execute()) {
            $message = 'Cliente Creado Satisfactoriamente!';
        } else {
            $message = 'Lamentablemente no se pudo crear el Cliente!';
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><!-- Clase de bootsrap CSS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  </head>
<body>
  
  <?php if(!empty($user)):?>
  <nav class="navbar navbar-light" style="background-color: #C2824F;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php" style="margin-left: 80px;">Ferrelectricos Valdéz</a>
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
              <a class="nav-link active" aria-current="page" href="cliente.php">Clientes</a>
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
                <a class="nav-link" href="item.php">Items</a>
              </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="container">
    <br>
    <h5 style="text-align: center;">Ingrese los datos para agregar Cliente</h5>
    <hr>
    <br>
    <form class="row needs-validation" action="cliente.php" method="POST" novalidate>
      <div class="row">
        <div class="col-sm">
          <label for="identificacion" class="form-label">Identificación:</label>
          <input type="number" class="form-control" id="identificacion" placeholder="C.C., NIT, RUT..." name="identificacion" aria-describedby="inputGroupPrepend2" required>
          <div class="valid-feedback">
            Bien!
          </div>
          <div class="invalid-feedback">
            Ingrese lo que se le pide, por favor!
          </div>
        </div>
        <div class="col-sm">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" required>
          <div class="valid-feedback">
            Bien!
          </div>
          <div class="invalid-feedback">
            Ingrese lo que se le pide, por favor!
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <label for="apellidos" class="form-label">Apellidos:</label>
          <input type="text" class="form-control" id="apellidos" placeholder="Ingrese Apellidos" name="apellidos" required>
          <div class="valid-feedback">
            Bien!
          </div>
          <div class="invalid-feedback">
            Ingrese lo que se le pide, por favor!
          </div>
        </div>
        <div class="col-sm">
          <label for="direccion" class="form-label">Direccion:</label>
          <input type="text" class="form-control" id="direccion" placeholder="Ingrese Dirección Residencia" name="direccion" required>
          <div class="valid-feedback">
            Bien!
          </div>
          <div class="invalid-feedback">
            Ingrese lo que se le pide, por favor!
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <label for="correo" class="form-label">Correo Electronico</label>
          <input type="email" class="form-control" id="correo" name="correo" placeholder="example@dominio.com" required>
          <div class="valid-feedback">
            Bien!
          </div>
          <div class="invalid-feedback">
            Ingrese lo que se le pide, por favor!
          </div>
        </div>
        <div class="col-sm">
          <label for="telefono" class="form-label">Telefono:</label>
          <input type="number" class="form-control" id="telefono" placeholder="Ingrese numero telefonico" name="telefono" required>
          <div class="valid-feedback">
            Bien!
          </div>
          <div class="invalid-feedback">
            Ingrese lo que se le pide, por favor!
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-6">
          <button class="btn btn-warning" type="submit" name="addCliente_btn">Guardar</button>
        </div>
        <div class="col-sm-6">
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
    <h5 style="text-align: center;">Ingrese los datos para consultar Cliente</h5>
    <hr>
    <br>
      <form class="row needs-validation" action="cliente.php" method="POST" novalidate>
        <div class="row">
          <div class="col-sm">
            <label for="identificacion" class="form-label">Diguite el número de busqueda:</label>
            <input type="number" class="form-control" id="identificacion" name="identificacion" placeholder="C.C., NIT, RUT...">
            <div class="valid-feedback">
              Datos Correctos!.
            </div>
          <div class="col-sm">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre">
            <div class="valid-feedback">
            Datos Correctos!.
            </div>
          </div>
          </div>
        <br>
      <div class="row">   
        <div class="col-sm-6">
            <button type="submit" class="btn btn-warning form-control" name="serchCliente_btn">Consultar</button>
        </div>
        <div class="col-sm-6">
            <button type="reset" class="btn btn-warning form-control">Borrar</button>
        </div>
      </div>
    </form>
    <br>
    <?php endif; ?>
    <table class="table caption-top">
      <thead class="table-secondary">
        <tr>
          <th scope="col"> Id Cliente </th>
          <th scope="col"> Nombre </th>
          <th scope="col"> Apellidos </th>
          <th scope="col"> Dirección </th>
          <th scope="col"> Correo</th>
          <th scope="col"> Telefono</th>
          </tr>
      </thead>
      <tbody>
    <br>
    <?php 
        require 'database.php';
        $id= ( empty($_POST['identificacion']) ) ? NULL : $_POST['identificacion'];
        $nombre= ( empty($_POST['nombre']) ) ? NULL : $_POST['nombre'];
        if(!empty($id)){
          $consulta = $conn->query("SELECT * FROM cliente WHERE identificacion = '$id'");
          foreach($consulta as $result){
            echo "<tr>
            <td>".$result['identificacion']."</td>";
                echo "<td>". $result['nombre']."</td>";
                echo "<td>". $result['apellidos']."</td>";
                echo "<td>". $result['direccion']."</td>";
                echo "<td>". $result['correo']."</td>";
                echo "<td>". $result['telefono']."</td>";
                echo "<tr>";
          }
        }else if(!empty($nombre)){
          $consulta = $conn->query("SELECT * FROM cliente WHERE nombre = '$nombre'");
          foreach($consulta as $result){
            echo "<tr>
            <td>".$result['identificacion']."</td>";
                echo "<td>". $result['nombre']."</td>";
                echo "<td>". $result['apellidos']."</td>";
                echo "<td>". $result['direccion']."</td>";
                echo "<td>". $result['correo']."</td>";
                echo "<td>". $result['telefono']."</td>";
                echo "<tr>";
          } 
        }else{
          $consulta = $conn->query('SELECT * FROM cliente');
          foreach($consulta as $result){
            echo "<tr>
            <td>".$result['identificacion']."</td>";
                echo "<td>". $result['nombre']."</td>";
                echo "<td>". $result['apellidos']."</td>";
                echo "<td>". $result['direccion']."</td>";
                echo "<td>". $result['correo']."</td>";
                echo "<td>". $result['telefono']."</td>";
                echo "<tr>";
        } 
      }
    ?> 
      </tbody>
    </table>
    <br>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="logica/cliente.js"></script> <!-- Clase de Logica para Cliente-->
    <script src="scripts/script.js"></script> <!-- Clase de script para cliente-->
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
