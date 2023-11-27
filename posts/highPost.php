<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = ($_POST['title']);
    $post = ($_POST['post']);
    $user = ($_POST['usuario']);
    $foto = ($_POST['foto']);

    $id = null;

    $ins = $con->prepare("INSERT INTO posts VALUES(?,?,?,?,?)");
    $ins->bind_param("issss", $id, $title, $post, $user, $foto);

    if ($ins->execute()) {
        echo 'success';
    } else {
        echo 'fail';
    }

    $ins->close();
    $con->close();
} else {
    header('location: ../index.php');
}
?>