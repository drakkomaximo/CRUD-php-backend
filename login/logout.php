<?php
include '../conexion.php';

$token = $con->real_escape_string(htmlentities($_GET['token']));

$sel = $con->query("SELECT id from usuarios WHERE token = '$token'");

if ($f = $sel->fetch_assoc()) {
    $id = $f['id'];
} 

$up = $con->prepare("UPDATE usuarios SET token = null WHERE id = ?");
$up->bind_param("i", $id);

if ($up->execute()) {
    echo 'success';
} else {
    echo 'fail';
}

$sel->close();
$up->close();
$con->close();

?>