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
    $data = (file_get_contents("php://input"));

    $query = new MongoDB\Driver\Query([],[]);
//actualiza pedido
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id'=>$data]);
    $result = $manager->executeBulkWrite('pikminDB.pedidos', $bulk);
//actualiza usuario
?>