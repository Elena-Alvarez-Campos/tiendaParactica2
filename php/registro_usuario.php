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
            <a class="nav-link active" aria-current="page" href="index.html">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contacto.html">Contacto</a>
          </li>
        </ul>
          <button class="btn btn-outline-success" type="submit">Carrito</button>
      </div>
    </div>
  </nav> 
  <main id="hero_inicio">
    <h1>Ya puedes entrar<h1>
  </main>

</body>
</html>
<?php

    $nombre_reg =$_POST['nombreregistro'];
    $email_reg =$_POST['emailregistro'];
    $password_reg =$_POST['passwordregistro'];
    $uri = getenv("MONGODB_URI");
    if (!$uri) {
        echo("no hay URI");
        throw new RuntimeException("Falta MONGODB_URI");
    }
        
    $manager = new MongoDB\Driver\Manager($uri);

    $postBody = json_decode(file_get_contents("php://input"), true);

    $data = [
        "nombre" => $nombre_reg,
        "email" => $email_reg,
        "password" => $password_reg,
        "admin" => false
    ];

    try{
      $bulk = new MongoDB\Driver\BulkWrite();
        
		  $bulk->insert($data);

      $resultado = $manager->executeBulkWrite( 
		    "pikminDB.usuarios",
				$bulk
			);
      
		  if($resultado->getInsertedCount() !== 1){
			  throw new RuntimeException("Error al insertar datos");
		  }


    }catch(Throwable $e){
      http_response_code(500);
      error_log('Error MongoDB: '. $e->getMessage());

      echo "ERROR DE CONEXIÓN";
    }

?>