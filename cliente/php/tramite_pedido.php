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
//actualiza pedido
    $bulk = new MongoDB\Driver\BulkWrite;

    $data = $_SESSION["carrito"];
    $data["_id"]=uniqid();
    $bulk->insert($data);

    $resultado = $manager->executeBulkWrite( 
		    "pikminDB.pedidos",
				$bulk
			);

//actualiza usuario
    $_SESSION["carrito"]=new stdClass();
    $pedido_historial = [
        "_id_pedido"=> $data["_id"],
        "confirmado"=> false
    ];
    array_push($_SESSION["historial"],$pedido_historial);
    
    $bulk2 = new MongoDB\Driver\BulkWrite;

        $rows2 = $manager->executeQuery('pikminDB.usuarios', $query);
        foreach($rows2 as $r){
            if (json_decode(json_encode($r),true)["email"]==$_SESSION["email"]) {
                $bulk2->update(['email' => $_SESSION["email"]], ['$set' => ['carrito' => $_SESSION["carrito"]]]);
                $bulk2->update(['email' => $_SESSION["email"]], ['$set' => ['historial' => $_SESSION["historial"]]]);

                }
        }
        $result2 = $manager->executeBulkWrite('pikminDB.usuarios', $bulk2);
?>