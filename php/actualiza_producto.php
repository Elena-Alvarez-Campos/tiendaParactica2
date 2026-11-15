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
        $bulk = new MongoDB\Driver\BulkWrite;
        
        $data = [
            "nombre" => $postBody['nombre'],
            "carrito" => $postBody['carrito']
        ];
        $_SESSION["carrito"]= $data["carrito"];
        $query = new MongoDB\Driver\Query([],['project'=> ['nombre'=> "fuente"]]);
            $rows = $manager->executeQuery('pikminDB.productos', $query);
        
            foreach($rows as $r){
                if (json_decode(json_encode($r),true)["nombre"]==$data["nombre"]) {
                    print_r(json_decode(json_encode($r),true)["nombre"]);

                    print_r(json_decode(json_encode($r),true)["stock"]);
                    
                    $bulk->update(['nombre' => $data["nombre"]], ['$set' => ['stock' => (json_decode(json_encode($r),true)["stock"])-1]]);
                }
            }
        $result = $manager->executeBulkWrite('pikminDB.productos', $bulk);

?>