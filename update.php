<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>UPDATE</title>
</head>
<body>
	<h1>ACTUALIZAR REGISTROS</h1>
    <a href="index.php">Nuevo Registro</a>
	<?php
		include "conexion.php"; //incluimos el archivo de conexion
		$link=conectarse();     //llamos la funcion de conexion
		//actualizar un registro seleccionado
		if($_POST) {
			$consultaUP = "update personas set Nombre='" . $_POST['nombre'] . "',Apellidos='" . $_POST['apellido'] . "' where ID=" . $_POST["id"];
			$resultado=mysqli_query($link,$consultaUP);
			if($resultado){
				echo "<br>Registro actualizado con éxito";
			}else{
				echo "Un error ha ocurrido en la actualización";
			}
		}
		if (isset($_GET["opcion"]) && $_GET["opcion"]=="delete"){
			$consultaDelete="delete from personas where ID=".$_GET["id"].";";
			echo "<br>". $consultaDelete;
			$resultadoDelete=mysqli_query($link,$consultaDelete);
			if ($resultadoDelete){
				echo "<br>Registro eliminado correctamente";
			}else{
				echo "<br>Existe un error al borrar el registro";
			}
		}
		//consulta de todos los registros
		$consulta="select * from personas";
		$resultadoUpd=mysqli_query($link,$consulta);
	?>
	<table>
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Accion</th>
		</tr>
		<?php
			while($row=mysqli_fetch_array($resultadoUpd)){
				echo "<tr>";
				echo "<td>";
				echo $row["Nombre"];
				echo "</td>";
				echo "<td>";
				echo $row["Apellidos"];
				echo "</td>";
				echo "<td>";
				//accion de actualizar por medio de la url
				echo "<a href=\"?id=".$row["ID"]."&opcion=update\">Actualizar</a> / ";
				echo "<a href=\"?id=".$row["ID"]."&opcion=delete\">Borrar</a>";
				echo "</td>";
				echo "</tr>";
			}
		?>
	</table>
	<?php
		if(isset($_GET['id']))
		{
                //Consulta del id que ha sido seleccionado
	            $consultaXid = "select * from personas where ID=" . $_GET['id'] . ";";
	            $rowRes = mysqli_query($link , $consultaXid);// tenemos guardado ese registro que seleccionado
	            $rowQ = mysqli_fetch_array($rowRes);        //obtienes un array asociativo con el registro selcc
        if ($_GET["opcion"]=="update"){
	?>
<!--		Formulario para poder Actualizar-->
	<form action="" method="post">
		<input type="hidden" name="id" value="<?=$rowQ["ID"]?>">
		<p><label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?=$rowQ["Nombre"]?>"  ></p>
		<p><label for="apellido">Apellido</label>
			<input type="text" name="apellido" id="apellido"value="<?=$rowQ["Apellidos"]?>" >
		</p>
		<input type="submit" value="Registrar">
	</form>
<?php
        }//cerramos el if de mostrar formulario si es actualizacion
		}//cerramos la comprobación
		mysqli_close($link);
 ?>

</body>
</html>

<?php
