<?php

    try{
        $uri = getenv("MONGODB_URI");
        if (!$uri) {
            echo("no hay URI");
            throw new RuntimeException("Falta MONGODB_URI");
        }

        $manager = new MongoDB\Driver\Manager($uri);
        $command = new MongoDB\Driver\Command(['ping'=> 1]);
        $manager->executeCommand('admin', $command);
        echo 'CONEXIÓN CORRECTA :) PIKMIN';
    }catch(Throwable $e){
        http_response_code(500);
        error_log('Error MongoDB: '. $e->getMessage());

        echo "ERROR DE CONEXIÓN";
    }

?>
<?php
        $uri = getenv("MONGODB_URI");
        if (!$uri) {
            echo("no hay URI");
            throw new RuntimeException("Falta MONGODB_URI");
        }
        
        $manager = new MongoDB\Driver\Manager($uri);
        $command = new MongoDB\Driver\Command(['ping'=> 1]);
        $manager->executeCommand('admin', $command);
        // try{


            $query = new MongoDB\Driver\Query([],['project'=> ['_id'=> 0]]);
            $rows = $manager->executeQuery('pikminDB.practicasClienteServidor', $query);

            foreach($rows as $r){
                print_r(json_decode(json_encode($r),true)["producto"]);
            }

# Recuerda que puedes ver a cuántos afectó con $resultado->getModifiedCount()

        // }catch(Throwable $e){
        //     http_response_code(500);
        //     error_log('Error MongoDB: '. $e->getMessage());

        //     echo "ERROR DE CONEXIÓN";
        // }
    ?>