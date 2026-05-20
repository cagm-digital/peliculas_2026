<?php //Código para realizar sesiones en PHP 
	require ("funciones.php");	// Funciones escritas en PHP
	session_start(); // Iniciando sesión para el manejo de perfiles de usuario
    
    // Verificar si el usuario ha iniciado sesión y tiene el perfil de editor
	if (!isset($_SESSION['perfil']))
	{
		header('location:login.php'); // Redirigir al formulario de inicio de sesión si no se ha iniciado sesión		
	}
	else
	{
		if ($_SESSION['perfil'] != 2) // Verificar si el perfil del usuario no es de editor
        {
            header('location:index.php'); // Redirigir a la página de inicio si el usuario no tiene el perfil de editor
        }					
	}	

	$id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario desde la sesión
	$nombre_perfil = $_SESSION['nombre_perfil']; // Obtener el nombre del perfil desde la sesión
	$nombre_acceso = $_SESSION['nombre_acceso']; // Obtener el nombre de acceso desde la sesión	
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Películas - Catálogo 11-01 2026</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Catálogo de Películas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                
            </ul>
            <a class="btn btn-info" href="cerrar_sesion.php" role="button">Cerrar Sesion</a>
            </div>
        </div>
        </nav>    
    </div>
    <div class="container">        
        <h1 class="text-center text-info">Panel de control del Editor</h1>
    </div>

    <footer class="page-footer font-small">
      <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© <?php echo date('Y')." Copyright - Especialidad Informática";?>
          <br>
          <a class="text-info" href="https://tecnologiasits.pindana.co/">Diseño y Desarrollo de Sitios Web - <a class="text-info" href="https://itspereira.edu.co/"> Instituto Técnico Superior de Pereira</a>
          <br>Pereira - Colombia
        </div>	
      <!-- Copyright -->
    </footer>        

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>