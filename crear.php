<?php
require_once("./conexion.php");
$resultado = "";
if (isset($_POST['crearProducto'])) {
    // Veamos si existe o no el nombre corto del producto introducido
    $nombreCorto = strtoupper(trim($_POST['nombreCorto']));
    $consultaNombreCortoProducto = "SELECT id from productos where upper(nombre_corto)=upper('$nombreCorto')";
    $objPDOStatement = $conProyecto->query($consultaNombreCortoProducto);
    if ($objPDOStatement->rowCount() == 0) {
        // No existe el producto. Luego vamos a insertarlo mediante una inserción preparada
        $nombre = ucwords(trim($_POST['nombre']));
        $descripcion = trim($_POST['descripcion']);
        $precio = floatval(($_POST['precio']));
        if (is_float($precio) && $nombre != '' && $nombreCorto != '') {
            $familia = $_POST['familia'];
            $insercionProductoNuevo = "INSERT INTO productos(nombre,nombre_corto,descripcion,pvp,familia) VALUES(?,?,?,?,?)";
            $stmt = $conProyecto->prepare($insercionProductoNuevo);
            $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
            $stmt->bindParam(2, $nombreCorto, PDO::PARAM_STR);
            $stmt->bindParam(3, $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(4, $precio, PDO::PARAM_STR);
            $stmt->bindParam(5, $familia, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = "REGISTRO INSERTADO";
        } else {
            $resultado = "Los datos no son válidos";
        }
    } else {
        $resultado = "REGISTRO REPETIDO O ERRÓNEO";
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
    <title>Crear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</head>

<body class="container-xl bg-info">
    <header class="row">
        <h1 class="col-xl-12 text-center">Crear Producto</h1>
    </header>
    <main>
        <section>
            <form name="eleccionCrearProducto" method="post" action="./crear.php" target="_self">
                <div class="row justify-content-evenly">
                    <div class="col-sm-5">
                        <div class="row"><label class="form-label" for="idNombre">Nombre</label></div>
                        <div class="row"><input type="text" name="nombre" id="idNombre" class="form-control" placeholder="Nombre" required></div>
                    </div>
                    <div class="col-sm-5">
                        <div class="row"><label class="form-label" for="idNombreCorto">Nombre Corto</label></div>
                        <div class="row"><input type="text" name="nombreCorto" id="idNombreCorto" class="form-control" placeholder="Nombre Corto" required></div>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-sm-5">
                        <div class="row"><label class="form-label" for="idPrecio">Precio (€)</label></div>
                        <div class="row"><input type="number" name="precio" id="idPrecio" class="form-control" placeholder="Precio (€)" min="0" step="0.01" required></div>
                    </div>
                    <div class="col-sm-5">
                        <div class="row"><label class="form-label" for="idFamilia">Familia</label></div>
                        <div class="row">
                            <select name="familia" id="idFamilia" class="form-select" required>
                                <?php
                                $consultaFamilia = "SELECT cod,nombre from familias";
                                $objPDOResult = $conProyecto->query($consultaFamilia);
                                if ($objPDOResult->rowCount() > 0) {
                                    $arrayRegistrosFamilia = $objPDOResult->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($arrayRegistrosFamilia as $registro) {
                                        echo "<option value='$registro->cod'>$registro->nombre</option>";
                                    }
                                } else {
                                    $resultado = "No existen Familias";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-sm-7">
                        <div class="row"><label class="form-label" for="idDescripcion">Descripción</label></div>
                        <div class="row"><textarea name="descripcion" class="form-control" id="idDescripcion" rows="15"></textarea></div>
                    </div>
                    <div class="col-sm-3 mt-3">
                        <div class="row">
                            <p class="text-center">
                                <?php
                                echo $resultado;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-sm-7">
                        <div class="row justify-content-evenly">
                            <div class="col-sm-3 mt-3 d-grid gap-2 col-12">
                                <button type="submit" class="btn btn-primary " name="crearProducto" value="ok">Crear</button>
                            </div>
                            <div class="col-sm-3 mt-3 d-grid gap-2 col-12">
                                <button type="reset" class="btn btn-success col-sm-12">Limpiar</button>
                            </div>
                            <div class="col-sm-3 mt-3 d-grid gap-2 col-12">
                                <a href="./listado.php" class="btn btn-outline-primary col-sm-12" target="_self">Volver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </section>
    </main>
</body>
<?php
$conProyecto = null;
?>

</html>