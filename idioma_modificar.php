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
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Idioma - ITS</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container mt-5">        
        <h1 class="text-center text-danger mb-4">Modificar Idioma</h1>
        <div class="row justify-content-center">
            <div class="col-md-5 shadow p-4 rounded bg-white border-top border-danger border-4">
                <form action="idioma_modificado.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label text-muted small">ID Registro</label>
                        <input type="text" class="form-control bg-light" value="<?php echo $datos['id']; ?>" disabled>
                    </div>
                    <div class="mb-4">
                        <label for="inputIdioma" class="form-label fw-bold">Nombre del Idioma:</label>
                        <input type="text" class="form-control border-danger" id="inputIdioma" name="inputIdioma" 
                               value="<?php echo $datos['idioma']; ?>" required autofocus>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger">Actualizar</button>
                        <a href="idioma_listar.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>