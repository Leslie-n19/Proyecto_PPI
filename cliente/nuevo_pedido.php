<?php
    require("../funciones/sesion.php");
    require "../funciones/conecta.php";


    $cliente = $_SESSION['nombre'];
    $id_producto = $_POST["id"];
    $nombre_producto = $_POST["name"];
    $value_producto = $_POST["valor"];

    ini_set('date.timezone','America/Mexico_City'); ///Esta es una funcion que toma la direccion geografica
    $time = date('Y-m-d', time());                  ///y en una variable, ingresa la fecha
    

    /// checa si en 'venta' hay algun registro con el status abierto == 0
    $sql = "SELECT estatus FROM pedidos ORDER BY id DESC LIMIT 1";
    $res = mysqli_query($con,$sql);
    $fila = mysqli_num_rows($res);

    if($fila){
        $registro = $res->fetch_object();
        $status = $registro->estatus;
    }  /// Toma en que 'status' esta el ultimo pedido

    if($status == 0) /// Si el pedido esta abierto
    {

        $sql = "SELECT id FROM pedidos ORDER BY id DESC LIMIT 1";
        $res = mysqli_query($con,$sql);
        $fila = mysqli_num_rows($res);

        if($fila){
            $registro = $res->fetch_object();
            $id_venta = $registro->id;
        }

        $sql = "INSERT INTO pedidos_productos VALUES (0,'$id_venta','$id_producto','1','$value_producto')" ; 
    }else{
        $sql = "INSERT INTO pedidos VALUES (0,'$time','$cliente','0')";
        $res = mysqli_query($con,$sql);
        $fila = mysqli_num_rows($res);

        if($fila){
            $registro = $res->fetch_object();
            $id_venta = $registro->id;
        }
        $crear = "INSERT INTO pedidos_productos VALUES (0,'$id_venta','$id_producto','1','$value_producto')" ;
        $res = mysqli_query($con, $crear);
    }

    $res = mysqli_query($con, $sql);

    if ($res)
        echo 1;
    else 
        echo 0;
        
    
?>