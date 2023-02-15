<?php
require_once("./conexion.php");
$objRegistro;
if (isset($_GET['id'])) {
    if (ctype_digit($_GET['id']) ? true : false) {
        $id = intval($_GET['id']);
        $consultaDetalle = "SELECT * FROM productos WHERE id=$id";
        $objPDOResult = $conProyecto->query($consultaDetalle);
        if ($objPDOResult->rowCount() == 1) {
            $objRegistro = $objPDOResult->fetch(PDO::FETCH_OBJ);
        } else {
            // No se encontró el registro en la BD
            header('Location:listado.php');
        }
    } else {
        // Valor no válido
        header('Location:listado.php');
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
    <title>Detalle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</head>

<body class="container-xl bg-info">
    <header class="row mb-4">
        <h1 class="col-xl-12 text-center">Detalle Producto</h1>
    </header>
    <main>
        <section>
            <div class="row  justify-content-center">
                <div class="col-10">
                    <form name="detalleProducto" class="card text-white" style="background-color: #2596be;">
                        <div class="row">
                            <div class="col text-center "><?php echo "<p class='pt-2 pb-2'>$objRegistro->nombre</p>"; ?></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col text-center"><?php echo "<p>Código: $objRegistro->id</p>"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo "<p class='mx-2'>Nombre: $objRegistro->nombre</p>"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo "<p class='mx-2'>Nombre Corto: $objRegistro->nombre_corto</p>"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo "<p class='mx-2'>Código Familia: $objRegistro->familia</p>"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo "<p class='mx-2'>PVP (€): $objRegistro->pvp</p>"; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo "<pre class='mx-2'>Descripción: $objRegistro->descripcion</pre>"; ?></div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </section>
        <div class="row justify-content-center">
            <div class="mt-4 d-grid col-sm-1 col-10"><a href="./listado.php" class="btn text-white" style="background-color: #2596be;">Volver</a></div>
        </div>
    </main>
</body>
<?php
$conProyecto = null;
?>

</html>