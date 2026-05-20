<?php 
    require ("funciones.php");	
    session_start(); 

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
    <title>Net-Películas</title>
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
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand text-danger">
                    <img src="icono.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                    Catálogo de Películas
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0">

                    </ul>
                    <?php if(isset($_SESSION['perfil'])): ?>
                        <a class="btn btn-outline-danger me-2" href="administrador.php">Panel Control</a>
                        <a class="btn btn-danger" href="cerrar_sesion.php">Cerrar Sesión</a>
                    <?php else: ?>
                        <a class="btn btn-danger" href="login.php" role="button">Iniciar Sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>    
    </div>

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