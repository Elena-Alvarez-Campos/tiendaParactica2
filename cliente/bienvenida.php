<?php
  session_start();
  $_SESSION["nombre"] = $_GET["nombre"];
  
  if(!isset($_SESSION["nombre"])){
    echo("INTRUSOOOO FUERA DE AQUÍ");
  }
  $uri = getenv("MONGODB_URI");
  if (!$uri) {
    echo("no hay URI");
    throw new RuntimeException("Falta MONGODB_URI");
  }    
  $manager = new MongoDB\Driver\Manager($uri);
  $command = new MongoDB\Driver\Command(['ping'=> 1]);
  $manager->executeCommand('admin', $command);
  $query = new MongoDB\Driver\Query([],['project'=> ['nombre'=> "fuente"]]);
  $rows = $manager->executeQuery('pikminDB.usuarios', $query);
  foreach($rows as $r){
    if (json_decode(json_encode($r),true)["nombre"]==$_SESSION["nombre"]) {
      $_SESSION["carrito"]=json_decode(json_encode($r),true)["carrito"];
      $_SESSION["email"]=json_decode(json_encode($r),true)["email"];
      $_SESSION["historial"]=json_decode(json_encode($r),true)["historial"];
    }
  }
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Page Title</title>
    
     <!-- css de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- js de booostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel='stylesheet' href='../style.css'>
</head>
<body>
    <!-- <button id="b">Añade datos</button> -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PikminTienda</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="inicio.html">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="tienda.php">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contacto.html">Contacto</a>
          </li>
        </ul>
          <img src="" >
          <button class="btn btn-outline-success" type="submit">Carrito</button>
      </div>
    </div>
  </nav> 
  <!-- contenido -->
  <main id="hero_inicio">
    <h1>¡Te damos la bienvenida, <?= $_SESSION["nombre"]; ?>!<h1>
        <h4>Siempre es un placer ver a nustros queridos clientes</h4>
  </main>
  
</body>
</html>