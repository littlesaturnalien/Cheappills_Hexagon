<?php

function Conectar(){
    $user = 'root';
    $password = '';
    $server ='localhost';
    $database = 'cheappills';

    $connection = mysqli_connect($server, $user, $password );
    mysqli_select_db($connection, $database);

    return $connection;
}
    
?>