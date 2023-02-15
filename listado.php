<?php
require_once("./conexion.php");
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

<body class="container-xl bg-info">
    <header>
        <h1 class="text-center">Gestión de Productos</h1>
    </header>
    <main>
        <section>
            <form name="eleccionCrearProducto" method="post" action="./crear.php" target="_self">
                <button type="submit" class="btn btn-success mb-2" name="opcionCrear" value="ok">Crear</button>
            </form>
        </section>
        <section>
            <table class="table table-dark table-striped">
                <thead>
                    <tr class="text-center">
                        <th>Detalle</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th class='row justify-content-center'>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consultaProductos = "SELECT id,nombre FROM productos";
                    $objPDOResult = $conProyecto->query($consultaProductos);
                    if ($objPDOResult->rowCount() != 0) {
                        $arrayRegistrosProductos = $objPDOResult->fetchAll(PDO::FETCH_OBJ);
                        foreach ($arrayRegistrosProductos as $registro) {
                            echo "<tr class='text-center'>";
                            echo "<td><form name='detalleRegistroProductos' method='get' action='./detalle.php' target='_self'>";
                            echo "<button type='submit' class='btn btn-primary' name='id' value='$registro->id'>Detalle</button>";
                            echo "</form></td>";
                            echo "<td>$registro->id</td>";
                            echo "<td>$registro->nombre</td>";
                            echo "<td class='row'>";
                            echo "<form class='col' name='actualizarRegistroProductos' method='get' action='./actualizar.php' target='_self'>";
                            echo "<button type='submit' class='btn btn-warning' name='idProducto' value='$registro->id'>Actualizar</button>";
                            echo "</form>";
                            echo "<form class='col' name='BorrarRegistroProductos' method='post' action='./borrar.php' target='_self'>";
                            echo "<button type='submit' class='btn btn-danger' name='idProducto' value='$registro->id'>Borrar</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
<?php
$conProyecto = null;
?>

</html>