<?php 
    require ("funciones.php");	
    session_start(); 
    
    // Verificar si el usuario ha iniciado sesión y es administrador
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    // Verificar si llegaron los datos obligatorios por POST
    if (isset($_POST['id']) && isset($_POST['nombre'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $anio = $_POST['anio'];
        $duracion = $_POST['duracion'];
        $id_genero = $_POST['id_genero'];
        $id_idioma = $_POST['id_idioma'];
        $imagen = $_POST['imagen'];
        $descripcion = $_POST['descripcion'];
        
        $idCone = conexion();
        
        // Sentencia corregida y refactorizada para incluir los nuevos campos del catálogo
        $sql = "UPDATE pelicula SET 
                nombre = '$nombre', 
                director = '$director', 
                anio = '$anio', 
                duracion = '$duracion', 
                id_genero = '$id_genero', 
                id_idioma = '$id_idioma', 
                imagen = '$imagen',
                descripcion = '$descripcion' 
                WHERE id = '$id'";
                
        $resultado = mysqli_query($idCone, $sql);
    } else {
        header('location:pelicula_listar.php');
        exit;
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
    <title>Película Modificada - ITS 2026</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

    <div class="container mt-5 text-center">
        <div class="card shadow border-0 p-5 mx-auto" style="max-width: 500px;">
            <?php if($resultado): ?>
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                </div>
                <h2 class="text-success fw-bold">Registro Modificado</h2>
                <p class="text-muted">La película <strong><?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?></strong> se actualizó completamente con sus nuevos detalles técnico-informativos.</p>
            <?php else: ?>
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 4rem;"></i>
                </div>
                <h2 class="text-danger fw-bold">No se pudo modificar</h2>
                <p class="text-muted text-start small">
                    <strong>Error:</strong> Ocurrió un problema de sintaxis o de base de datos al guardar las modificaciones.
                </p>
                <div class="alert alert-secondary small text-start mt-2">
                    <code><?php echo mysqli_error($idCone); ?></code>
                </div>
            <?php endif; ?>
            
            <a href="pelicula_listar.php" class="btn btn-danger mt-4 w-100">
                <i class="bi bi-arrow-left"></i> Volver al Listado
            </a>
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