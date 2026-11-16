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
        "admin" => false,
        "carrito"=> [],
        "historial"=> []
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
      header("Location: ../cliente/bienvenida.php?nombre=" . $nombre_reg);

    }catch(Throwable $e){
      http_response_code(500);
      error_log('Error MongoDB: '. $e->getMessage());

      echo "ERROR DE CONEXIÓN";
    }

?>