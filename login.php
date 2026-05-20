<?php // login.php 17-02-2026 by Cesar Adolfo Gonzalez Marin
	require ("funciones.php");	// Funciones escritas en PHP	
	session_start(); // Iniciando sesión para el manejo de perfiles de usuario
		
	if (isset($_REQUEST['cerrar_sesion.php'])) // Si se ha solicitado cerrar sesión
	{
		session_unset();
		session_destroy();
	}

	if (isset($_SESSION['perfil'])) // Si ya se ha iniciado sesión, redirigir al panel correspondiente
	{
		switch($_SESSION['perfil'])
		{
			case 1:
				header('location:administrador.php'); // Redirigir al panel de administrador
			break; 
			
			case 2:
				header('location:editor.php'); // Redirigir al panel de editor
			break;								
		}
	}

	if (isset($_REQUEST['inputUsuario']) && isset($_REQUEST['inputPassword'])) // Si se han enviado las credenciales de inicio de sesión
	{
		$username = $_REQUEST['inputUsuario']; // Obtener el nombre de usuario del formulario  
		$password = $_REQUEST['inputPassword']; // Obtener la contraseña del formulario
		//$password = sha1($password); // Encriptar la contraseña utilizando SHA-1 (opcional, dependiendo de cómo se almacenen las contraseñas en la base de datos)
		
		// Consultando información del Administrador		
		$idCone = conexion(); // Establecer conexión con la base de datos utilizando la función definida en funciones.php		
				
		// Consulta SQL para verificar las credenciales del usuario y obtener su perfil
        $SQL = "SELECT usuario.id, usuario.nombre, usuario.id_perfil, perfil.perfil FROM usuario INNER JOIN perfil
				WHERE usuario.id = '$username' AND usuario.clave = '$password' AND usuario.id_perfil = perfil.id";
		
		$registro = mysqli_query($idCone,$SQL);	// Ejecutar la consulta SQL y obtener el resultado																	
		
        // Procesar el resultado de la consulta para obtener la información del usuario y su perfil
        while($tupla = mysqli_fetch_row($registro))
		{													
			$id_usuario = $tupla[0]; // Obtener el ID del usuario	
			$nombre_acceso = $tupla[1];	// Obtener el nombre de acceso del usuario
			$id_perfil = $tupla[2]; // Obtener el ID del perfil del usuario 				
			$nombre_perfil = $tupla[3]; // Obtener el nombre del perfil del usuario	
		}
		$registros = mysqli_num_rows($registro); // Obtener el número de registros devueltos por la consulta (debería ser 1 si las credenciales son correctas, 0 si son incorrectas)
		mysqli_free_result ($registro); // Liberar el resultado de la consulta
		mysqli_close($idCone); // Cerrar la conexión con la base de datos
		
        // Consultando información del Administrador
		
		// Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($registros > 0) 
		{
			$_SESSION['id_usuario'] = $id_usuario;
			$_SESSION['perfil'] = $id_perfil;
			$_SESSION['nombre_perfil'] = $nombre_perfil;
			$_SESSION['nombre_acceso'] = $nombre_acceso;

			// Redirigir al panel correspondiente según el perfil del usuario
            switch($_SESSION['perfil'])
			{				
				case 1:					
					header("location:administrador.php"); // Redirigir al panel de administrador
				break;
				
				case 2:
					header("location:editor.php"); // Redirigir al panel de editor
				break;		
			}
		}
		else // Si no se encontró un usuario con las credenciales proporcionadas, mostrar un mensaje de error
		{		
			?>
			<div class="alert alert-danger text-center" role="alert">
				Datos incorrectos!							
			</div>				
			<?php			
		}
	}	
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Películas - Catálogo 11-01 2026</title>
	<link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .card-img-top {
            height: 400px;
            object-fit: cover;
        }
        .navbar-brand, .text-danger {
            font-weight: bold;
        }
    </style>
   </head>
  <body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand text-danger" href="index.php">
                <img src="icono.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Catálogo de Películas
            </a>   			            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                
                </li>
                
            </ul>            
			<a class="btn btn-danger" href="index.php" role="button">Inicio</a>
            </div>
        </div>
        </nav>    
    </div>

	<div class="container">		
		<form action="" method="POST" class="text-center">				
			<img class="mb-4" src="icono.png" alt="" width="72" height="72">	
			<h3 class="text-dark">Net-Películas</h3>			
			<p class="lead text-muted">Explora nuestra colección de películas</p>
			
			<div class="form-group row justify-content-center">
				<label for="inputUsuario" class="col-sm-1 col-form-label text-sm-right">Usuario:</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="inputUsuario" name="inputUsuario" placeholder="Nombre de usuario">
				</div>
			</div>

			<div class="form-group row justify-content-center mt-2">
				<label for="inputPassword" class="col-sm-1 col-form-label text-sm-right">Clave:</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Clave de ingreso">
				</div>
			</div>		

			
			<div class="form-group row justify-content-center mt-2">
				<div class="col-sm-4 d-grid">
					<button type="submit" class="btn btn-dark">Ingresar</button>
				</div>
			</div>			  		
		</form>
	</div>
	



    <footer class="page-footer font-small mt-5 bg-light border-top">
        <div class="footer-copyright text-center py-4 text-muted">
            © <?php echo date('Y')." Copyright - Especialidad Informática";?>
            <br>
            <a class="text-danger text-decoration-none" href="https://tecnologiasits.pindana.co/">Diseño y Desarrollo de Sitios Web</a> - 
            <a class="text-danger text-decoration-none" href="https://itspereira.edu.co/">Instituto Técnico Superior de Pereira</a>
            <br>Pereira - Colombia
        </div>	
    </footer>       


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>