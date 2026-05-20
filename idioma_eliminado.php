<?php 
    require ("funciones.php");	
    session_start(); 
    
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $idCone = conexion();
        
        // Ejecución de la eliminación
        $sql = "DELETE FROM idioma WHERE id = '$id'";
        $resultado = mysqli_query($idCone, $sql);
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
    <title>Idioma Eliminado - ITS</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body class="bg-light">
    <div class="container mt-5 text-center">
        <div class="card shadow border-0 p-5 mx-auto" style="max-width: 500px;">
            <?php if($resultado): ?>
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                </div>
                <h2 class="text-success fw-bold">Registro Eliminado</h2>
                <p class="text-muted">El idioma ha sido removido de la base de datos exitosamente.</p>
            <?php else: ?>
                <div class="mb-4">
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
                </div>
                <h2 class="text-danger fw-bold">Error al Eliminar</h2>
                <p class="text-muted">No se pudo eliminar el idioma. Es posible que existan películas vinculadas a este registro.</p>
                <div class="alert alert-light border small text-start">
                    <strong>Detalle técnico:</strong> <?php echo mysqli_error($idCone); ?>
                </div>
            <?php endif; ?>
            
            <a href="idioma_listar.php" class="btn btn-danger mt-4 w-100">
                <i class="bi bi-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </div>
    
    <?php mysqli_close($idCone); ?>
  </body>
</html>