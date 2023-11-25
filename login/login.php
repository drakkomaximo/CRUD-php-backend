<?php
include '../conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $email = $con->real_escape_string(htmlentities($_POST['email']));
   $pass = $con->real_escape_string(htmlentities($_POST['password']));

   $sel = $con->query("SELECT id, email, password FROM usuarios WHERE email = '$email'");

   if($f = $sel->fetch_assoc()){
       $correo = $f['email'];
       $password = $f['password'];
       $id = $f['id'];
    }

    $passEncrypted = password_verify($pass, $password);

    if($email == $correo && $passEncrypted == true){
        $token = sha1(rand(0000,9999));

        $up = $con->prepare("UPDATE usuarios SET token = ? WHERE id = ?");
        $up->bind_param("si", $token, $id);
    }

    if($up->execute()){
       $res = array('token' => $token, 'res' => 'success');
       echo json_encode($res);
    }else{
        $res = array('token' => '', 'res' => 'fail');
        echo json_encode($res);
    }

    $sel->close();
    $up->close();
    $con->close();
}else{
    header('location: ../index.php');
}
