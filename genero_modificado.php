<?php 
    require ("funciones.php");	
    session_start(); 
    
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    // Capturar datos del POST
    $id = $_POST['id'];
    $nuevo_genero = strtoupper($_POST['inputGenero']); // Convertimos a mayúsculas por orden

    $idCone = conexion();
    $sql = "UPDATE genero SET genero = '$nuevo_genero' WHERE id = '$id'";
    $resultado = mysqli_query($idCone, $sql);
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado Modificación - ITS</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-body text-center p-5">
                        <?php if($resultado): ?>
                            <div class="display-1 text-success mb-3">✓</div>
                            <h2 class="text-success">¡Actualización Exitosa!</h2>
                            <p class="text-muted">El género ha sido modificado correctamente en la base de datos.</p>
                        <?php else: ?>
                            <div class="display-1 text-danger mb-3">✕</div>
                            <h2 class="text-danger">Error</h2>
                            <p class="text-muted small"><?php echo mysqli_error($idCone); ?></p>
                        <?php endif; ?>
                        
                        <hr class="my-4">
                        <a href="genero_listar.php" class="btn btn-danger px-4">Volver al Listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php mysqli_close($idCone); ?>
  </body>
</html>