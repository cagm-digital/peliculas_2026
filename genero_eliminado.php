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
        
        // Intento de eliminación
        $sql = "DELETE FROM genero WHERE id = '$id'";
        $resultado = mysqli_query($idCone, $sql);
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
    <title>Género Eliminado - ITS</title>
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
                <p class="text-muted">El género ha sido removido exitosamente.</p>
            <?php else: ?>
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 4rem;"></i>
                </div>
                <h2 class="text-danger fw-bold">No se pudo eliminar</h2>
                <p class="text-muted text-start small">
                    <strong>Error:</strong> Este género no puede ser borrado porque tiene películas asociadas en el catálogo. Primero debe eliminar o reasignar dichas películas.
                </p>
                <div class="alert alert-secondary small text-start mt-2">
                    <code><?php echo mysqli_error($idCone); ?></code>
                </div>
            <?php endif; ?>
            
            <a href="genero_listar.php" class="btn btn-danger mt-4 w-100">
                <i class="bi bi-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </div>
    
    <?php mysqli_close($idCone); ?>
  </body>
</html>