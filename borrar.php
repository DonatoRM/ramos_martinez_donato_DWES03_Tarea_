<?php
require_once("./conexion.php");
$respuesta;
if (isset($_POST['id'])) {
    if (ctype_digit($_POST['id']) ? true : false) {
        $id = intval($_POST['id']);
        // Primero veremos si el registro existe o no en la tabla productos
        $consultaId = "SELECT id FROM productos WHERE id=$id";
        $objPDOStatement = $conProyecto->query($consultaId);
        if ($objPDOStatement->rowCount() != 0) {
            // El producto está dentro de la tabla productos
            // Vamos a eliminar el registro de la tabla productos y de sus tablas foráneas
            $deleteId = "DELETE FROM productos WHERE id=$id";
            if ($conProyecto->exec($deleteId)) {
                // Elemento Eliminado
                $respuesta = "Producto de código: $id Borrado correctamente";
            } else {
                // Elemento no eliminado
                $respuesta = "Error. El producto con Código: $id no ha sido borrado";
            }
        } else {
            // El registro no está en la tabla productos
            $respuesta = "El producto con Código: $id no existe en la tabla de Productos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <meta name="application-name" content="Tarea 3 de DWCS">
    <meta name="description" content="Trabajar con Bases de Datos PHP">
    <meta name="keywords" content="html,css,bootstrap,mariadb,mysql,php,dwcs">
    <title>Tema 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="container-fluid">
    <main>
        <section>
            <div class="row justify-content-start">
                <div class="col-4">
                    <?php echo "<p class='fw-bold'>$respuesta</p>"; ?>
                </div>
                <div class="col-1">
                    <a href="./listado.php" class="btn btn-outline-secondary ms-3">Volver</a>
                </div>
            </div>
        </section>
    </main>
</body>