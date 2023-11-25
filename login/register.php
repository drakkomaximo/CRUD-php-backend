<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $con->real_escape_string(htmlentities($_POST['user']));
    $password = $con->real_escape_string(htmlentities($_POST['password']));
    $email = $con->real_escape_string(htmlentities($_POST['email']));

    $extension = '';
    $ruta = 'http://localhost/sveltephp/login/profile_photo';
    $archivo = $_FILES['photo']['tmp_name'];
    $fileName = $_FILES['photo']['name'];
    $info = pathinfo($fileName);

    if ($archivo != '') {
        $extension = $info['extension'];
        if ($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'JPG') {
            $fileNameFormatted = $user . rand(0000, 9999) . '.' . $extension;
            move_uploaded_file($archivo, 'profile_photo/' . $fileNameFormatted);
            $ruta = $ruta . '/' . $fileNameFormatted;
        } else {
            echo 'fail';
            exit;
        }
    } else {
        $ruta = 'http://localhost/sveltephp/login/profile_photo/default.jpg';
    }

    $id = null;
    $token = null;
    $passEncrypted = password_hash($password, PASSWORD_BCRYPT);
    $ins = $con->prepare("INSERT INTO usuarios VALUES(?,?,?,?,?,?)");
    $ins->bind_param("isssss", $id, $user, $email, $passEncrypted, $ruta, $token);

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