<?php
//1. definir los parametros de la conexión
$servidor="localhost"; //nombre del servidor
$usuario="root";        //usuario con permiso en esa base de datos
$clave="";              //clave del usuario con permisos
$bbdd="phpmysql";       //nombre de la base de datos
$puerto="3306";         //puerto de conexión

//nombre de la tabla que trabajaremos- no obligatorio.
$tabla="personas";

//creamos la conexión
function conectarse(){
	global $servidor,$usuario,$clave,$bbdd,$tabla,$puerto;
	$link=mysqli_connect($servidor.":".$puerto,$usuario,$clave);
	if(mysqli_error($link)){
		echo "Exite un error en la conexión con el Servidor";
	}else{
		echo "Conexión establecida correctamente con el Servidor <br>";
	}
	if (!mysqli_select_db($link,$bbdd)){
		echo "Existe un error con la Base de Datos";
		exit(); // se termina la ejecución
	}else{
		echo "Conexión con la BBDD correcta..";
	}

	//retornamos link cuando esta función sea llamada
	return $link;
}
//	$link=conectarse();




