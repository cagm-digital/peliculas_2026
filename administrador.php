<?php //Código para realizar sesiones en PHP 
	require ("funciones.php");	// Funciones escritas en PHP
	session_start(); // Iniciando sesión para el manejo de perfiles de usuario
	
    // Verificar si el usuario ha iniciado sesión y tiene el perfil de administrador
    if (!isset($_SESSION['perfil']))
	{
		header('location:login.php'); // Redirigir al formulario de inicio de sesión si no se ha iniciado sesión
	}
	else
	{
		if ($_SESSION['perfil'] != 1) // Verificar si el perfil del usuario no es de administrador
        {
            header('location:index.php'); // Redirigir a la página de inicio si el usuario no tiene el perfil de administrador
        }				
	}	

	$id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario desde la sesión
	$nombre_perfil = $_SESSION['nombre_perfil']; // Obtener el nombre del perfil desde la sesión	
	$nombre_acceso = $_SESSION['nombre_acceso']; // Obtener el nombre de acceso desde la sesión	


  // Conexión a la base de datos
  $idCone = conexion();

  // Consulta para traer las películas con el nombre del género e idioma
  $sql = "SELECT p.*, g.genero, i.idioma 
          FROM pelicula p 
          INNER JOIN genero g ON p.id_genero = g.id 
          INNER JOIN idioma i ON p.id_idioma = i.id
          ORDER BY p.nombre ASC";
  
  $query = mysqli_query($idCone, $sql);
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
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand text-danger">
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
                    <li><a class="dropdown-item text-primary" href="idioma_crear.php">Crear</a></li>
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
        <div class="container mt-5">
            <div class="text-center mb-5">
                <h1 class="display-4 text-danger">Net-Películas</h1>
                <p class="lead text-muted">Explora nuestra colección de películas</p>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4 card-group">
                <?php 
                    if(mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_array($query)) { 
                ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-danger">
                            <img src="<?php echo $row['imagen']; ?>" class="card-img-top" alt="<?php echo $row['nombre']; ?>" onerror="this.src='https://via.placeholder.com/400x600?text=Sin+Imagen'">
                            
                            <div class="card-body">
                                <h5 class="card-title text-danger"><?php echo strtoupper($row['nombre']); ?></h5>
                                <p class="card-text"><strong>Director:</strong> <?php echo $row['director']; ?></p>
                                <p class="card-text text-secondary small">
                                    <?php echo substr($row['descripcion'], 0, 120); ?>...
                                </p>
                            </div>
                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item small"><strong>Género:</strong> <?php echo $row['genero']; ?></li>
                                <li class="list-group-item small"><strong>Idioma:</strong> <?php echo $row['idioma']; ?></li>
                                <li class="list-group-item small"><strong>Duración:</strong> <?php echo $row['duracion']; ?> min.</li>
                            </ul>
                            
                            <div class="card-footer bg-white border-top-0 text-center">
                                <small class="text-muted">Lanzamiento: <?php echo $row['anio']; ?></small>
                            </div>
                        </div>
                    </div>
                <?php 
                        }
                    } else {
                        echo "<div class='col-12 text-center'><p class='alert alert-warning'>No hay películas registradas en el catálogo.</p></div>";
                    }
                ?>
            </div>
        </div>

        <?php 
            mysqli_close($idCone); 
        ?>



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