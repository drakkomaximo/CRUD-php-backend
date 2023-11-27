<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = ($_POST['title']);
    $post = ($_POST['post']);
    $id = ($_POST['id']);

    $up = $con->prepare("UPDATE posts SET titulo = ?, post = ? WHERE id = ?");
    $up->bind_param("ssi", $title, $post, $id);

    if ($up->execute()) {
        echo 'success';
    } else {
        echo 'fail';
    }

    $up->close();
    $con->close();
} else {
    header('location: ../index.php');
}
?>