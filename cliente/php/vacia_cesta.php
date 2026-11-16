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
    $query = new MongoDB\Driver\Query([],[]);
    //actualiza productos
        $bulk = new MongoDB\Driver\BulkWrite;

        
            foreach ($_SESSION['carrito'] as $producto => $value){
            $rows = $manager->executeQuery('pikminDB.productos', $query);

                foreach($rows as $row){ 
                    $bulk->update(['nombre' => $producto], ['$set' => ['stock' => (json_decode(json_encode($row),true)["stock"] + $value)]]);

                }
            }
            
        $result = $manager->executeBulkWrite('pikminDB.productos', $bulk);
    $_SESSION["carrito"]=new stdClass();
    //actualiza usuario
    $bulk2 = new MongoDB\Driver\BulkWrite;

        $rows2 = $manager->executeQuery('pikminDB.usuarios', $query);
        foreach($rows2 as $r){
            if (json_decode(json_encode($r),true)["email"]==$_SESSION["email"]) {
                $bulk2->update(['email' => $_SESSION["email"]], ['$set' => ['carrito' => $_SESSION["carrito"]]]);
            }
        }
        $result2 = $manager->executeBulkWrite('pikminDB.usuarios', $bulk2);



?>