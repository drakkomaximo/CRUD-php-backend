<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');

$con = new mysqli("localhost", "root", "", "svelvephp", 3307);
if ($con->connect_errno) {
    die("Error al conectar a la base de datos");
}
?>