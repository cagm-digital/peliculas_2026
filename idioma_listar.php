<?php 
    require ("funciones.php");	
    session_start(); 
    
    if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] != 1) {
        header('location:index.php'); 
        exit;
    }

    $idCone = conexion();
    $sql = "SELECT * FROM idioma ORDER BY idioma";
    $query = mysqli_query($idCone, $sql);
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Idiomas - ITS 2026</title>
    <link rel="icon" type="image/png" href="icono.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand text-danger fw-bold" href="administrador.php">Catálogo Admin</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="administrador.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" href="idioma_listar.php">Listar Idiomas</a></li>
                    </ul>
                    <a class="btn btn-danger" href="cerrar_sesion.php">Cerrar Sesión</a>
                </div>
            </div>
        </nav>    
    </div>

    <div class="container mt-5">        
        <h1 class="text-center text-danger mb-4">Idiomas Disponibles</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="table-responsive shadow-sm">
                    <table class="table table-hover align-middle">
                        <thead class="table-danger">
                            <tr>
                                <th scope="col" class="py-3">ID</th>
                                <th scope="col" class="py-3">Nombre del Idioma</th>
                                <th scope="col" class="py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td class="fw-bold"># <?php echo $row['id']; ?></td>
                                <td class="text-uppercase"><?php echo $row['idioma']; ?></td>
                                <td class="text-center">
                                    <a href="idioma_modificar.php?id=<?php echo $row['id']; ?>" 
                                    class="btn btn-warning btn-sm shadow-sm me-2">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                    
                                    <a href="idioma_eliminar.php?id=<?php echo $row['id']; ?>" 
                                    class="btn btn-outline-danger btn-sm shadow-sm">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <a href="idioma_crear.php" class="btn btn-outline-danger">Agregar Nuevo Idioma</a>
                </div>
            </div>
        </div>
    </div>

    <?php mysqli_close($idCone); ?>

    <footer class="page-footer font-small mt-5 bg-light border-top">
        <div class="footer-copyright text-center py-4 text-muted">
            © <?php echo date('Y')." Copyright - Especialidad Informática";?>
            <br>
            Pereira - Instituto Técnico Superior
        </div>	
    </footer>        
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>