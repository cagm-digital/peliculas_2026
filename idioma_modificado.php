<?php 
    require ("funciones.php");	
    session_start(); 
    
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    $id = $_POST['id'];
    $nuevo_idioma = strtoupper($_POST['inputIdioma']);

    $idCone = conexion();
    $sql = "UPDATE idioma SET idioma = '$nuevo_idioma' WHERE id = '$id'";
    $resultado = mysqli_query($idCone, $sql);
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado Idioma - ITS</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container mt-5 text-center">
        <div class="card shadow border-0 p-5 mx-auto" style="max-width: 500px;">
            <?php if($resultado): ?>
                <h2 class="text-success">¡Éxito!</h2>
                <p>El idioma ha sido actualizado correctamente.</p>
            <?php else: ?>
                <h2 class="text-danger">Error</h2>
                <p><?php echo mysqli_error($idCone); ?></p>
            <?php endif; ?>
            <a href="idioma_listar.php" class="btn btn-danger mt-3">Volver al Listado</a>
        </div>
    </div>
    <?php mysqli_close($idCone); ?>
  </body>
</html>