<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Page Title</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <h2>Buenos días</h2>
    <button id="b">Añade datos</button>
    <script src="script.js"></script>
    <?php
        $uri = getenv("MONGODB_URI");
        if (!$uri) {
            echo("no hay URI");
            throw new RuntimeException("Falta MONGODB_URI");
        }
        
        $manager = new MongoDB\Driver\Manager($uri);
        $command = new MongoDB\Driver\Command(['ping'=> 1]);
        $manager->executeCommand('admin', $command);
        try{

        $bulk = new MongoDB\Driver\BulkWrite();
        
		$bulk->insert($data);
        $resultado = $manager->executeBulkWrite( 
			"pikminDB.practicasClienteServidor",
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
</body>
</html>