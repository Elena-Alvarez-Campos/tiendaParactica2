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
    <link rel="icon" type="image/vnd.microsoft.icon" href="img/favi.ico">
    <link rel='stylesheet' href='style.css'>
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
    <form action="php/registro_usuario.php" method="POST">
      <h2>Crear cuenta</h2>
      <div class="mb-3">
        <label for="nombreInput" class="form-label">Nombre</label>
        <input type="name" class="form-control" id="nombreInput" name="nombreregistro">
      </div>
      <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Dirección E-mail</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailregistro">
        <div id="emailHelp" class="form-text">Registrate o inicia sesión</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="passwordregistro">
      </div>
      <button type="submit" class="btn btn-primary" >Crear cuenta</button>
    </form>
    <form>
      <h2>Iniciar sesión</h2>
      <div class="mb-3">
        <label for="nombreInput" class="form-label">Nombre</label>
        <input type="name" class="form-control" id="nombreInput" name="nombreinicio">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="passwordinicio">
      </div>
      <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
  </main>
  <script src="script.js</script>

</body>
</html>