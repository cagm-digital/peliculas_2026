<?php //Código para cerrar sesión en PHP by Cesar Adolfo Gonzalez Marin
	session_start(); // Iniciando sesión para el manejo de perfiles de usuario
	session_unset(); // Eliminar todas las variables de sesión
	session_destroy(); // Destruir la sesión
	header("location:index.php"); // Redirigir a la página de inicio después de cerrar sesión	
?>