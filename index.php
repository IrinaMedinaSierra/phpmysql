<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
    <h1>LISTADO DE PERSONAS DE LA BASE DE DATOS</h1>
    <?php
        include "conexion.php"; //incluimos el archivo para usar cualquier método
        $link=conectarse();
        //insertamos la consulta de nuevo registro
	    if($_POST){
		    $nombre=$_POST["nombre"];
		    $apellido=$_POST["apellido"];
		    $insertar="INSERT INTO personas (Nombre,Apellidos) values ('".$nombre."','".$apellido."');";
		    echo $insertar;
		    $resultadoInsert=mysqli_query($link,$insertar);//ademas de ejecutarse nos envia un true/false
		    if($resultadoInsert){
			    echo "Registro insertado correctamente";
		    }else{
			    echo "Error en alta de la Persona";
		    }
	    }
        $consulta="select * from personas";
        //Para que se ejecute la consulta utilizamos mysqli_query
        $resultado=mysqli_query($link,$consulta); //$resultado es un array con datos extraidos
        while ($row=mysqli_fetch_array($resultado))
        {
            echo "<li>".$row['Nombre']."-".$row['Apellidos']. " </li>";
        }
    ?>
    <hr>
    <h2>Nuevo Registro de Persona</h2>
    <form action="" method="post">
        <p><label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"></p>
        <p><label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido">
        </p>
        <input type="submit" value="Registrar">
    </form>

    <?php
	    //liberar memoria usada en la consulta
	    mysqli_free_result($resultado);
	   //cerramos la conexión de la bbdd
	    mysqli_close($link);
    ?>
<a href="update.php">Modificar o Eliminar registros</a>
</body>
</html>