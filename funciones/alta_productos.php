<?php
require "conecta.php";
///Recibe Variables

$file_name = $_FILES['archivo']['name'];	//Nombre real del archivo
$file_tmp  = $_FILES['archivo']['tmp_name'];//Nombre temporal del archivo
$cadena    = explode(".", $file_name);		//Separa el nombre para obtener la extension
$ext       = $cadena[1];					//Extension
$dir       = "../img/";					//carpeta donde se guardan los archivos
$file_enc  = md5_file($file_tmp);			//Nombre del archivo encriptado
$name      = $_POST['nombre'];
$codigo   = $_POST['codigo'];
$descripcion   = $_POST['descripcion'];
$costo   = $_POST['costo'];
$stock   = $_POST['stock'];

$fileName1  = "$file_enc.$ext";	
///------------------------ Declaracion de variables ---------------------------

/// Como es la declaracion de la variable
/// se pueden poner otras variables
function Repetido($codigo,$conexion){
    $sql="SELECT * FROM productos WHERE codigo ='$codigo' ";
    $resultado = mysqli_query($conexion,$sql);
    if(mysqli_num_rows($resultado) > 0){
        return 1;
		
    }else {
        return 0;
    }
}

if(Repetido($codigo,$con)==1){
    echo 2;
}else {
    ///---- Inserción a base de datos--------
    $sql = "INSERT INTO productos  VALUES (0,'$name','$codigo','$descripcion','$costo','$stock','$fileName1','$file_name','1','0')";
    ///--------- Resultado de la funcion de inserción
    $res = mysqli_query($con, $sql);

    /// --------- Si el nobre del archivo creado es diferente a nada 
    if ($file_name != '') {
        $fileName1  = "$file_enc.$ext";	// se copia el nombre con la extension
        @copy($file_tmp, $dir.$fileName1);	
        /// se copia la imagen dentro de la carpeta con el nombre creado
    }
    if ($res)
        echo 1;
    else 
        echo 0;

}
?>