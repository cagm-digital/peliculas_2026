<?php 
    require ("funciones.php");	
    session_start(); 
    
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    $idCone = conexion();

    if (isset($_GET['id'])) {
        $id_genero = $_GET['id'];
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
    <title>Eliminar Género - ITS</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container mt-5">        
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0">
                    <div class="card-header bg-danger text-white text-center py-3">
                        <h4 class="mb-0">Confirmar Eliminación</h4>
                    </div>
                    <div class="card-body p-4 text-center">
                        <p class="mb-4">¿Está seguro de que desea eliminar el siguiente género?</p>
                        <h2 class="text-danger fw-bold mb-4">"<?php echo $datos['genero']; ?>"</h2>
                        
                        <form action="genero_eliminado.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger">Sí, Eliminar Registro</button>
                                <a href="genero_listar.php" class="btn btn-outline-secondary">Cancelar y Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>