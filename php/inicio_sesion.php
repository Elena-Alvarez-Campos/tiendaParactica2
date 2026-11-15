<?php
    session_start();

    $nombre_inicio =$_POST['nombreinicio'];
    $password_inicio =$_POST['passwordinicio'];
    $uri = getenv("MONGODB_URI");
    if (!$uri) {
        echo("no hay URI");
        throw new RuntimeException("Falta MONGODB_URI");
    }
        $manager = new MongoDB\Driver\Manager($uri);
        $command = new MongoDB\Driver\Command(['ping'=> 1]);

        $manager->executeCommand('admin', $command);
        $query = new MongoDB\Driver\Query([],['project'=> ['nombre'=> "fuente"]]);
        

    $postBody = json_decode(file_get_contents("php://input"), true);

    $data = [
        "nombre" => $nombre_inicio,
        "password" => $password_inicio
    ];
    $encontrado = false;
    $rows = $manager->executeQuery('pikminDB.usuarios', $query);
            foreach($rows as $r){
                if (json_decode(json_encode($r),true)["nombre"]==$data['nombre'] &&  json_decode(json_encode($r),true)["password"]==$data['password']) {
                    $encontrado=true;
                        $_SESSION["nombre"]= $data['nombre'];
                        $_SESSION["carrito"]=new class{};
                        $_SESSION["historial"]=[];
                    if (json_decode(json_encode($r),true)["admin"]==true) {
                        echo "<script>window.location.href='../admin/bienvenida.html';</script>";

                        }else{
                        header("Location: ../cliente/bienvenida.php");
                        
                    }
                }
            }
    if($encontrado==false){echo 'Se han introducido datos incorrectos';
        echo "<script>alert('has introducido mal los datos');window.location.href='../login.php';</script>";
    }
    exit();
?>