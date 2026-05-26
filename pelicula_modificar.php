<?php 
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

    $idCone = conexion();

    // Validar que se reciba el ID de la película
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Consultar los datos actuales de la película
        $sql_pelicula = "SELECT * FROM pelicula WHERE id = '$id'";
        $query_pelicula = mysqli_query($idCone, $sql_pelicula);
        $datos = mysqli_fetch_array($query_pelicula);

        if (!$datos) {
            echo "<script>alert('Película no encontrada'); window.location='pelicula_listar.php';</script>";
            exit;
        }
    } else {
        header('location:pelicula_listar.php');
        exit;
    }

    // Consultas para poblar los listados dinámicos
    $sql_generos = "SELECT * FROM genero ORDER BY genero";
    $query_generos = mysqli_query($idCone, $sql_generos);

    $sql_idiomas = "SELECT * FROM idioma ORDER BY idioma";
    $query_idiomas = mysqli_query($idCone, $sql_idiomas);

    $id_usuario = $_SESSION['id_usuario']; 
    $nombre_perfil = $_SESSION['nombre_perfil']; 	
    $nombre_acceso = $_SESSION['nombre_acceso']; 
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificar Película - ITS 2026</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

    <div class="container mb-5">        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-danger text-white text-center py-3">
                        <h4 class="mb-0">Modificar Película</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="pelicula_modificada.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">ID de la Película</label>
                                    <input type="text" class="form-control bg-light" value="<?php echo $datos['id']; ?>" disabled>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="nombre" class="form-label fw-bold">Nombre de la Película</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($datos['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="director" class="form-label fw-bold">Director</label>
                                    <input type="text" class="form-control" id="director" name="director" value="<?php echo htmlspecialchars($datos['director'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="anio" class="form-label fw-bold">Año</label>
                                    <input type="number" class="form-control" id="anio" name="anio" min="1800" max="<?php echo date('Y')+5; ?>" value="<?php echo htmlspecialchars($datos['anio'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="duracion" class="form-label fw-bold">Duración (min)</label>
                                    <input type="text" class="form-control" id="duracion" name="duracion" min="1" value="<?php echo htmlspecialchars($datos['duracion'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id_genero" class="form-label fw-bold">Género</label>
                                    <select class="form-select" id="id_genero" name="id_genero" required>
                                        <?php while($gen = mysqli_fetch_array($query_generos)): ?>
                                            <option value="<?php echo $gen['id']; ?>" <?php if($gen['id'] == $datos['id_genero']) echo 'selected'; ?>>
                                                <?php echo $gen['genero']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="id_idioma" class="form-label fw-bold">Idioma</label>
                                    <select class="form-select" id="id_idioma" name="id_idioma" required>
                                        <?php while($idi = mysqli_fetch_array($query_idiomas)): ?>
                                            <option value="<?php echo $idi['id']; ?>" <?php if($idi['id'] == $datos['id_idioma']) echo 'selected'; ?>>
                                                <?php echo $idi['idioma']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label fw-bold">URL de la Imagen (Portada)</label>
                                <input type="url" class="form-control" id="imagen" name="imagen" value="<?php echo htmlspecialchars($datos['imagen'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label for="descripcion" class="form-label fw-bold">Descripción / Sinopsis</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($datos['descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                                <a href="pelicula_listar.php" class="btn btn-outline-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php mysqli_close($idCone); ?>

    <footer class="page-footer font-small mt-5 bg-light border-top">
        <div class="footer-copyright text-center py-4 text-muted">
            © <?php echo date('Y')." Copyright - Especialidad Informática";?>
            <br>
            <a class="text-danger text-decoration-none" href="https://tecnologiasits.pindana.co/">Diseño y Desarrollo de Sitios Web</a> - 
            <a class="text-danger text-decoration-none" href="https://itspereira.edu.co/">Instituto Técnico Superior de Pereira</a>
            <br>Pereira - Colombia
        </div>	
    </footer>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script> 
  </body>
</html>