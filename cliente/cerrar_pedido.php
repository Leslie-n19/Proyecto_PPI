<?php
    require "../funciones/conecta.php";

    $sql = "SELECT id FROM pedidos ORDER BY id DESC LIMIT 1";
    $res = mysqli_query($con,$sql);
    $fila = mysqli_num_rows($res);


    if($fila){
        $registro = $res->fetch_object();
        $id_venta = $registro->id;
    }

    $sql = "UPDATE pedidos SET estatus = 1  ;";
    $res = mysqli_query($con, $sql);

    $crear = "INSERT INTO pedidos VALUES (0,'$time','$cliente','0')";
    $res = mysqli_query($con,$sql);
    
    if ($res)
        echo 1;
    else 
        echo 0;
    
     header("location:index.php")    ///Y se regresa a la pagina principal
        
?>