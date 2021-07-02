<?php
    require "../funciones/conecta.php";

    $sql = "SELECT id FROM venta ORDER BY id DESC LIMIT 1";
    $res = mysqli_query($con,$sql);
    $fila = mysqli_num_rows($res);


    if($fila){
        $registro = $res->fetch_object();
        $id_venta = $registro->folio;
    }

    $sql = "UPDATE venta SET status = 1 ;";
    $res = mysqli_query($con, $sql);
    
    if ($res)
        echo 1;
    else 
        echo 0;
    
     header("location:index.php")    ///Y se regresa a la pagina principal
        
?>