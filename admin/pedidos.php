<?php
        session_start();
        $uri = getenv("MONGODB_URI");
        if (!$uri) {
            echo("no hay URI");
            throw new RuntimeException("Falta MONGODB_URI");
        }
        
        $manager = new MongoDB\Driver\Manager($uri);
        $command = new MongoDB\Driver\Command(['ping'=> 1]);
        $manager->executeCommand('admin', $command);
        $postBody = json_decode(file_get_contents("php://input"), true);
        $bulk = new MongoDB\Driver\BulkWrite;
        $query = new MongoDB\Driver\Query([],[]);
        $rows = $manager->executeQuery('pikminDB.pedidos', $query);
        
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Page Title</title>
    <link rel='stylesheet' href='../style.css'>
    <!-- css de boostrap -->
    <link rel="icon" type="image/vnd.microsoft.icon" href="img/favi.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
  
  
    <!-- <button id="b">Añade datos</button>-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PikminTienda</a>
      <button id="bot1" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pedidos.php">Pedidos</a>
          </li>
        </ul>
        <a id="icono-user" href="perfil.php"><img src="../img/icon-gris.jpg" ></a>
      </div>
    </div>
  </nav> 
  <main id="hero_perfil">
    <aside>
        Pedidos pendientes
    </aside>
    <aside>
        <?php
            foreach($rows as $r){
                print (
                '<div > <p>'
                    . json_decode(json_encode($r),true)["_id"] . '</p>
                <button name="aceptar" type="button" class="btn btn-success">Aceptar</button>
                <button name="rechazar" type="button" class="btn btn-danger">Rechazar</button>
                </div>');
            }
        ?>
    </aside>
    
  </main>

  <!-- js de booostrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  <script src="js/script.js"></script>
</body>
</html>