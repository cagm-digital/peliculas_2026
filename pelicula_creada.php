<?php //Código para realizar sesiones en PHP 
	require ("funciones.php");	
	session_start(); 
	
    if (!isset($_SESSION['perfil']))
	{
		header('location:login.php'); 
	}
	else
	{
		if ($_SESSION['perfil'] != 1) 
        {
            header('location:index.php'); 
        }				
	}	
	$id_usuario = $_SESSION['id_usuario']; 
	$nombre_perfil = $_SESSION['nombre_perfil']; 	
	$nombre_acceso = $_SESSION['nombre_acceso']; 
?>

<!doctype html>
<html lang="es">
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
    .navbar-brand, .text-danger, .text-primary {
        font-weight: bold;
    }
    </style>   
 </head>
  <body>
    <div class="container-fluid mb-4">
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
                <a class="nav-link active text-muted" aria-current="page">Perfil <?php echo mb_convert_case(mb_strtolower($nombre_perfil, 'UTF-8'), MB_CASE_TITLE, "UTF-8"); ?></a>
                </li> 
                
                <li class="nav-item dropdown">
                  <a class="nav-link active dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Genero
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-primary" href="genero_crear.php">Crear</a></li>
                    <li><a class="dropdown-item text-primary" href="genero_listar.php">Ver</a></li>
                  </ul>
                </li>                
                <li class="nav-item dropdown">
                  <a class="nav-link active dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Idioma
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-primary" href="idioma_crear.php"">Crear</a></li>
                    <li><a class="dropdown-item text-primary" href="idioma_listar.php">Ver</a></li>
                  </ul>
                </li>     
                <li class="nav-item dropdown">
                  <a class="nav-link active dropdown-toggle text-danger" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Pelicula
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-danger" href="pelicula_crear.php">Crear</a></li>                                                            
                    <li><a class="dropdown-item text-danger" href="pelicula_listar.php">Listar</a></li>
                  </ul>
                </li>                 
            </ul>
            <a class="nav-link active text-danger" aria-current="page">Hola <?php echo mb_convert_case(mb_strtolower($nombre_acceso, 'UTF-8'), MB_CASE_TITLE, "UTF-8"); ?></a>
            <a class="btn btn-danger ms-2" href="cerrar_sesion.php" role="button">Cerrar Sesion</a>
            </div>
        </div>
        </nav>    
    </div>

    <div class="container">                
    <?php
        // Recolección de variables POST
        $id_pelicula = $_REQUEST['inputId'];
        $nombre = $_REQUEST['inputNombre'];
        $director = $_REQUEST['inputDirector'];
        $id_genero = $_REQUEST['inputIdGenero'];
        $id_idioma = $_REQUEST['inputIdIdioma'];
        $anio = $_REQUEST['inputAnio'];
        $duracion = $_REQUEST['inputDuracion'];
        $imagen = $_REQUEST['inputImagen'];
        $descripcion = $_REQUEST['inputDescripcion'];

        $idCone = conexion();	
        
        // Sentencia SQL para insertar
        $SQL = "INSERT INTO pelicula (id, nombre, director, id_genero, id_idioma, anio, duracion, imagen, descripcion) 
                VALUES ('$id_pelicula', '$nombre', '$director', '$id_genero', '$id_idioma', '$anio', '$duracion', '$imagen', '$descripcion')";
        
        // Ejecución de la consulta
        if (mysqli_query($idCone, $SQL))
        {			
        ?> 
            <div class="container-fluid">
                <div class="alert alert-success text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg> ¡Película guardada satisfactoriamente en la base de datos!
                </div>	
            </div>    
        <?php					
        }
        else
        {						
        ?> 
            <div class="container-fluid mb-4">    
                <div class="alert alert-danger text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg> ¡Error! No se pudo guardar la película. Verifica que el ID no esté duplicado.
                </div>	
            </div>              
        <?php
        }        
        mysqli_close($idCone);	
    ?>

        <h1 class="text-center text-danger">Creación de Película</h1>
        <form action="administrador.php" method="POST" class="w-75 mx-auto">				
            
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label text-end text-muted">ID:</label> 
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($id_pelicula); ?>" readonly>
                </div>        
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label text-end text-muted">Película:</label> 
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($nombre); ?>" readonly>
                </div>        
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label text-end text-muted">Director:</label> 
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($director); ?>" readonly>
                </div>        
            </div>

            <div class="form-group row justify-content-center mt-2">
              <div class="col-sm-9 d-grid">
                <a href="administrador.php" class="btn btn-danger w-100">Inicio</a>
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
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>