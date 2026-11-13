<?php
        
        $uri = getenv("MONGODB_URI");
        if (!$uri) {
            echo("no hay URI");
            throw new RuntimeException("Falta MONGODB_URI");
        }
        
        $manager = new MongoDB\Driver\Manager($uri);
        $command = new MongoDB\Driver\Command(['ping'=> 1]);
        $manager->executeCommand('admin', $command);

        $query = new MongoDB\Driver\Query(['project'=> ['nombre'=> 'cuenco']],[]);
            $rows = $manager->executeQuery('pikminDB.productos', $query);

            foreach($rows as $r){
                print_r(json_decode(json_encode($r),true)["nombre"]);
            }
    try{
        $query = new MongoDB\Driver\Query('nombre',[]);
        $rows = $mongo->executeQuery('pikminDB.usuarios', $query); // $mongo contains the connection object to MongoDB
        foreach($rows as $r){
            print_($r);
        }
        $bulk = new MongoDB\Driver\BulkWrite();
        
		$bulk->insert($data);
        $resultado = $manager->executeBulkWrite( 
			"pikminDB.productos",
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