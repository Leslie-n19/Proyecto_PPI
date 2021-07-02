<?php
    session_start();

    $estado = false;

    if(isset($_SESSION['nombre']))
    {
        $estado = true;
    }

?>