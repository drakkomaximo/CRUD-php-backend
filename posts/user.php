<?php
include '../conexion.php';

$token = $con->real_escape_string(htmlentities($_GET['token']));

$set = $con->query("SELECT usuario, foto from usuarios WHERE token = '$token'");

if ($f = $set->fetch_assoc()) {
    $user = $f['usuario'];
    $photo = $f['foto'];
}

$res = array('user' => $user, 'foto' => $photo);

echo json_encode($res);

$set->close();
$con->close();
?>