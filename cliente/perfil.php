<?php
session_start();

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
            <a class="nav-link active" aria-current="page" href="tienda.php">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contacto.html">Contacto</a>
          </li>
        </ul>
        <a id="icono-user" href="perfil.php"><img src="../img/icon-gris.jpg" ></a>
        <button id="carrito" class="btn btn-outline-success" type="submit">Carrito</button>
      </div>
    </div>
  </nav> 
  <!-- contenido -->
   
  <main id="hero_perfil">
    <div id="imagen-user"><img src="../img/icon-gris.jpg" > </div>
    <aside>
        <h2>Nombre: <?= $_SESSION["nombre"]; ?></h2>
        <h2>e-mail: <?= $_SESSION["email"]; ?></h2>
        <button>Editar</button>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Historial de compra
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        De momento no has comprado nada en nuestra tienda
                    </div>
                </div>
            </div>
        </div>
        <button onclick="logout()" type="button" class="btn btn-danger">Log out</button>

    </aside>
  </main>
  <script>
    function logout(){  
      
      window.location.href='../../index.php'
    }
  </script>
  
</body>

</html>