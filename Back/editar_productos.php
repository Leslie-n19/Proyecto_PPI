<?php
	require "conecta.php";
	$nombre = $_POST['nombre'];
	$codigo = $_POST['codigo'];
	$descripcion = $_POST['descripcion'];
	$costo = $_POST['costo'];
    $stock = $_POST['stock'];
	$id = $_POST['id'];
	$file_name = $_FILES['archivo']['name'];	//Nombre real del archivo


		//-------------------- Verificar si se carga una imagen
		if ($file_name == "") //--------- Si no se carga nada
		{
			$sql = "UPDATE productos SET nombre = '$nombre', codigo = '$codigo', 
						descripcion = '$descripcion', costo = '$costo', stock = '$stock' WHERE id = '$id'";
			$res = mysqli_query($con, $sql);
		} else /// Si se encuentra que se subio una imagen
		{
			$file_tmp  = $_FILES['archivo']['tmp_name']; //Nombre temporal del archivo
			$cadena    = explode(".", $file_name);		//Separa el nombre para obtener la extension
			$ext       = $cadena[1];					//Extension
			$dir       = "../img/";					//carpeta donde se guardan los archivos
			$file_enc  = md5_file($file_tmp);			//Nombre del archivo encriptado
			$fileName1  = "$file_enc.$ext";
			$sql = "UPDATE productos SET nombre = '$nombre', codigo = '$codigo', 
            descripcion = '$descripcion', costo = '$costo', stock = '$stock', archivo_n = '$fileName1', archivo = '$file_name' WHERE id = '$id'";
			$res = mysqli_query($con, $sql);
			/// --------- Si el nobre del archivo creado es diferente a nada 
			if ($file_name != '') {
				$fileName1  = "$file_enc.$ext";	// se copia el nombre con la extension
				@copy($file_tmp, $dir . $fileName1);
				/// se copia la imagen dentro de la carpeta con el nombre creado
			}
		}
		if ($res)
			echo 1;
		else
			echo 0;
	

	//------------------------- Funcion para buscar Repetidos
	/*function buscaRepetido($correo, $con)
	{
		$sql = "SELECT * from administradores 
					where correo ='$correo'";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) {
			return 1;
		} else {
			return 0;
		}
	}*/
?>
