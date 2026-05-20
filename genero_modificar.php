<?php 
    require ("funciones.php");	
    session_start(); 
    
    // Verificación de seguridad
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    $idCone = conexion();

    // Validar que el ID llegue por la URL
    if (isset($_GET['id'])) {
        $id_genero = $_GET['id'];
        
        // Consultar el registro actual
        $sql = "SELECT * FROM genero WHERE id = '$id_genero'";
        $query = mysqli_query($idCone, $sql);
        $datos = mysqli_fetch_array($query);

        if (!$datos) {
            echo "<script>alert('Género no encontrado'); window.location='genero_listar.php';</script>";
            exit;
        }
    } else {
        header('location:genero_listar.php');
        exit;
    }
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Género - ITS 2026</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand text-danger fw-bold" href="administrador.php">Catálogo Admin</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="genero_listar.php">Volver al Listado</a></li>
                    </ul>
                </div>
            </div>
        </nav>    
    </div>

    <div class="container mt-5">        
        <h1 class="text-center text-danger mb-4">Modificar Género</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-5 shadow p-4 rounded bg-white border-top border-danger border-4">
                <form action="genero_modificado.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label text-muted small">ID del Registro</label>
                        <input type="text" class="form-control bg-light" value="# <?php echo $datos['id']; ?>" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="inputGenero" class="form-label fw-bold">Nombre del Género:</label>
                        <input type="text" class="form-control border-danger" id="inputGenero" name="inputGenero" 
                               value="<?php echo $datos['genero']; ?>" required autofocus>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                        <a href="genero_listar.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="page-footer font-small mt-5 bg-light border-top text-center py-4 text-muted small">
        © <?php echo date('Y');?> Especialidad Informática - ITS Pereira
    </footer>        
  </body>
</html>