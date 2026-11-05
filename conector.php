<?php
        
        $uri = getenv("MONGODB_URI");
        if (!$uri) {
            echo("no hay URI");
            throw new RuntimeException("Falta MONGODB_URI");
        }
        
        $manager = new MongoDB\Driver\Manager($uri);
        $command = new MongoDB\Driver\Command(['ping'=> 1]);
        $manager->executeCommand('admin', $command);

        $postBody = json_decode(file_get_contents("php://input"), true);

        $data = [
            "producto" => $postBody['producto'],
            "cantidad" => $postBody['cantidad'],
            "estado" => $postBody['estado']
        ];
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