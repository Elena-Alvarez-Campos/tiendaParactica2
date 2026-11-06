<?php
//function obtenerBaseDeDatos()
//{
    $uri = getenv("MONGODB_URI");
    # Crea algo como mongodb://parzibyte:hunter2@127.0.0.1:27017/agenda
    $cliente = new MongoDB\Client($uri);
    echo $cliente->selectDatabase("pikminDB");
    return $cliente->selectDatabase("pikminDB");
//}
//obtenerBaseDeDatos()