<?php
include '../conexion.php';

$email = $con->real_escape_string(htmlentities($_POST['email']));

$sel = $con->query("SELECT email FROM usuarios WHERE email = '$email'");
$num = mysqli_num_rows($sel);

if ($num == 0) {
    echo 'success';
} else {
    echo 'fail';
}

$sel->close();
$con->close();

?>