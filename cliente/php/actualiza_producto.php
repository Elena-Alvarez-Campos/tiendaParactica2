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
        $postBody = json_decode(file_get_contents("php://input"), true);
        $bulk = new MongoDB\Driver\BulkWrite;
        
        $data = [
            "nombre" => $postBody['nombre'],
            "carrito" => $postBody['carrito']
        ];
        foreach ($data["carrito"] as $productos => $value){
            $_SESSION["carrito"][$productos]=$_SESSION["carrito"][$productos]+$value;
        }
        $query = new MongoDB\Driver\Query([],[]);

        //actualiza productos
            $rows = $manager->executeQuery('pikminDB.productos', $query);
        
            foreach($rows as $r){
                if (json_decode(json_encode($r),true)["nombre"]==$data["nombre"]) {
                    print_r(json_decode(json_encode($r),true)["nombre"]);

                    print_r(json_decode(json_encode($r),true)["stock"]);
                    
                    $bulk->update(['nombre' => $data["nombre"]], ['$set' => ['stock' => (json_decode(json_encode($r),true)["stock"])-1]]);
                }
            }
            
        $result = $manager->executeBulkWrite('pikminDB.productos', $bulk);
        
        //actualiza carrito
        $bulk2 = new MongoDB\Driver\BulkWrite;

        $rows2 = $manager->executeQuery('pikminDB.usuarios', $query);
        foreach($rows2 as $r){
            if (json_decode(json_encode($r),true)["email"]==$_SESSION["email"]) {
                
                $bulk2->update(['email' => $_SESSION["email"]], ['$set' => ['carrito' => $_SESSION["carrito"]]]);
            }
        }
        $result2 = $manager->executeBulkWrite('pikminDB.usuarios', $bulk2);


?>