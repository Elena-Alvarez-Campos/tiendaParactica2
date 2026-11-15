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
        echo($postBody);
        echo ("hoola");
        echo ($_SESSION["nombre"]);
        
    
?>