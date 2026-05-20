<?php 
    require ("funciones.php");	
    session_start(); 
    
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    $idCone = conexion();

    if (isset($_GET['id'])) {
        $id_idioma = $_GET['id'];
        $sql = "SELECT * FROM idioma WHERE id = '$id_idioma'";
        $query = mysqli_query($idCone, $sql);
        $datos = mysqli_fetch_array($query);

        if (!$datos) {
            echo "<script>alert('Idioma no encontrado'); window.location='idioma_listar.php';</script>";
            exit;
        }
    } else {
        header('location:idioma_listar.php');
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
    <title>Editar Idioma - ITS</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <li><a class="dropdown-item text-primary text-muted">Ver</a></li>
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
        <h1 class="text-center text-danger mb-4">Eliminar Idioma</h1>
        <div class="row justify-content-center">
            <div class="col-md-5 shadow p-4 rounded bg-white border-top border-danger border-4">
                <form action="idioma_eliminado.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label text-muted small">ID Registro</label>
                        <input type="text" class="form-control border-danger bg-light" value="<?php echo $datos['id']; ?>" disabled>
                    </div>
                    <div class="mb-4">
                        <label for="inputIdioma" class="form-label fw-bold">Nombre del Idioma:</label>
                        <input type="text" class="form-control border-danger" id="inputIdioma" name="inputIdioma" 
                               value="<?php echo $datos['idioma']; ?>" disabled>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <a href="idioma_listar.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
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