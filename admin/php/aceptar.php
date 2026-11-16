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
    // $bulk = new MongoDB\Driver\BulkWrite;
    // $bulk->delete(['_id'=>$data])

//actualiza usuario

    $bulk2 = new MongoDB\Driver\BulkWrite;
        $rows = $manager->executeQuery('pikminDB.usuarios', $query);
        foreach($rows as $r){
            print_r(json_decode(json_encode($r),true)["historial"]);
            // if (json_decode(json_encode($r),true)["email"]==$_SESSION["email"]) {
            //     $bulk2->update(['email' => $_SESSION["email"]], ['$set' => ['carrito' => $_SESSION["carrito"]]]);
            //     $bulk2->update(['email' => $_SESSION["email"]], ['$set' => ['historial' => $_SESSION["historial"]]]);
            //     }
        }
        $result2 = $manager->executeBulkWrite('pikminDB.usuarios', $bulk2);
?>