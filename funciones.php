<?php	
	// funciones.php 17-02-2026 by Cesar Adolfo Gonzalez Marin	
	// Diseño y desarrollo de sitios web - Instituto Técnico Superior de Pereira - Colombia
	// 2026 - Especialidad Informática
	
	function conexion() // Función para establecer conexión con la base de datos
	{
		$host = "localhost"; // Dirección del servidor de base de datos (puede ser localhost si la base de datos está en el mismo servidor que el código PHP)
		$usuario = "root"; // Nombre de usuario para acceder a la base de datos (por defecto suele ser "root" en servidores locales)
		$clave = ""; // Contraseña para acceder a la base de datos (por defecto suele ser una cadena vacía en servidores locales)
		$BaseDeDatos = "peliculas_1101"; // Nombre de la base de datos a la que se desea conectar
		$idCone = mysqli_connect ($host, $usuario, $clave, $BaseDeDatos) or die ("Error conectando al servidor $host con el nombre de usuario $usuario");		
		
		if (!$idCone) // Verificar si la conexión fue exitosa, si no, mostrar un mensaje de error y finalizar la ejecución del script
		{
			die("Error conectando al servidor: " . mysqli_connect_error());
		}
		return $idCone; // Devolver el identificador de la conexión establecida para su uso en otras partes del código
	}	
?>


