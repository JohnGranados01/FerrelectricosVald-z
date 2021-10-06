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
    //Codigo que permite insertar un item en la BD
    if(isset($_POST['addItem_btn'])){
      require 'database.php';
      $message='';
      if(!empty($_POST['nombre']) && !empty($_POST['precio'])){
        $sql = "INSERT INTO item (id, denominacion, descripcion, precio) 
        VALUES (:id, :nombre, :descripcion, :precio)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':descripcion', $_POST['descripcion']);
        $stmt->bindParam(':precio', $_POST['precio']);
        if ($stmt->execute()) {
          $message = 'Item Creado Satisfactoriamente!';
          } else {
            $message = 'Lamentablemente no se pudo crear el Item!';
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
    <title>Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><!-- Clase de bootsrap CSS-->
</head>
<body>
  <?php if(!empty($user)):?>
    <nav class="navbar navbar-light" style="background-color: #C2824F;">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"style="margin-left: 80px;">Ferrelectricos Valdéz</a>
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
                  <a class="nav-link" href="cliente.php">Clientes</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Factura
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                    <li><a class="dropdown-item" href="Factura/registrar_Factura.php" target="_blank">Registrar Factura</a></li>
                    <li><a class="dropdown-item" href="Factura/consultar_Factura.php" target="_blank">Consular Factura</a></li>
                    <li><a class="dropdown-item" href="Factura/eliminar_Factura.php" target="_blank">Eliminar Factura</a></li>
                    <li><a class="dropdown-item" href="Factura/ver_Factura.php" target="_blank">Ver Factura</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="item.php">Items</a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <br>
      <div class="container">
        <h5 style="text-align: center;">Ingrese los datos para agregar Items</h5>
        <hr>
        <br>
        <form class="row g-3 needs-validation" action="item.php" method="POST" novalidate>
          <div class="row">
            <div class="col-sm-4">
              <label for="id" class="form-label">Identificacion:</label>
              <input type="text" class="form-control" id="id" placeholder="Ingrese el Id del producto" name="id" aria-describedby="inputGroupPrepend2" required>
              <div class="valid-feedback">
                Bien!
              </div>
              <div class="invalid-feedback">
                Ingrese lo que se le pide, por favor!
              </div>
            </div>
            <div class="col-sm-4">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del producto" name="nombre" aria-describedby="inputGroupPrepend2" required>
              <div class="valid-feedback">
                Bien!
              </div>
              <div class="invalid-feedback">
                Ingrese lo que se le pide, por favor!
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder=".....">
            </div>
            <div class="col-sm-4">
              <label for="precio" class="form-label">Precio:</label>
              <input type="number" class="form-control" id="precio" name="precio" placeholder="$" required>
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
            <div class="col-sm">
              <button class="btn btn-warning" type="submit" name="addItem_btn">Guardar</button>
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
        <h5 style="text-align: center;">Ingrese los datos para Consultar Item</h5>
        <hr>
        <br>
        <form class="row g-3 needs-validation" action="item.php" method="POST" novalidate>
          <div class="row">
            <div class="col-sm-6">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del producto" name="nombre" aria-describedby="inputGroupPrepend2">
              <div class="valid-feedback">
                Datos Correctos!
              </div>
              <div class="invalid-feedback">
                Ingrese lo que se le pide, por favor!
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm">
              <button class="btn btn-warning" type="submit" name="serchItem_btn">Buscar</button>
            </div>
            <div class="col-sm">
              <button class="btn btn-warning" type="reset">Borrar</button>
            </div>
          </div>
        </form>
        <table class="table caption-top">
      <thead class="table-secondary">
        <tr>
          <th scope="col"> Id Item </th>
          <th scope="col"> Item </th>
          <th scope="col"> Descripcion </th>
          <th scope="col"> Precio</th>
          </tr>
      </thead>
      <tbody>
        <?php
        //Consulta que devuelve el Item por nombre y por algun caracter de coincidencia en el nombre
          require 'database.php';
          $nombre= ( empty($_POST['nombre']) ) ? NULL : $_POST['nombre'];
          if(!empty($nombre)){
            $consulta = $conn->query("SELECT * FROM item WHERE denominacion LIKE '%$nombre%'");
            foreach($consulta as $result){
              echo "<tr>
              <td>".$result['Id']."</td>";
                  echo "<td>". $result['denominacion']."</td>";
                  echo "<td>". $result['descripcion']."</td>";
                  echo "<td>". $result['precio']."</td>";
                  echo "<tr>";
            }
          }else{
            //Consulta que devuelve el Item
            $consulta = $conn->query("SELECT * FROM item");
            foreach($consulta as $result){
              echo "<tr>
              <td>".$result['Id']."</td>";
                  echo "<td>". $result['denominacion']."</td>";
                  echo "<td>". $result['descripcion']."</td>";
                  echo "<td>". $result['precio']."</td>";
                  echo "<tr>"; 
            }
          }
          
        ?>
      </tbody>
      </table>
      <br>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script><!-- Clase de bootsrap Bundle-->
    <script src="logica/item.js"></script>
    <script src="scripts/script.js"></script>
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
<?php endif; ?>
</html>