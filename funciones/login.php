<?php
session_start(); ///Se carga primero la sesión
require ("conecta.php");

$mail = $_POST["correo"];
$pass = $_POST["pass"];

$clave_md5 = md5($pass);

$sql = "SELECT * FROM administradores WHERE correo = '$mail' AND pass ='$clave_md5' AND eliminado = '0' ";
$res = mysqli_query($con,$sql);
$fila = mysqli_num_rows($res);


if($fila==0){
    echo 0; //Si no genera resultados
}

else{
    $row = mysqli_fetch_assoc($res);
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['id'] =  $row['id'];
    $_SESSION['rol'] =  $row['rol'];

    if($_SESSION['rol'] != 0)
    {
        echo 2;
    }
    else
    {
        echo 1;
    }

}
?>