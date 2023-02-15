<?php
require_once("./conexion.php");
$resultado = "";
if (isset($_GET['modificarProducto'])) {
    // Veamos si existe o no el nombre corto del producto introducido
    $nombreCorto = strtoupper(trim($_GET['nombreCorto']));
    $consultaNombreCortoProducto = "SELECT id from productos where upper(nombre_corto)=upper('$nombreCorto')";
    $objPDOStatement = $conProyecto->query($consultaNombreCortoProducto);
    if ($objPDOStatement->rowCount() != 0) {
        // No existe el producto. Luego vamos a insertarlo mediante una inserción preparada
        $nombre = ucwords(trim($_GET['nombre']));
        $descripcion = trim($_GET['descripcion']);
        $precio = floatval(($_GET['precio']));
        if (is_float($precio) && $nombre != '' && $nombreCorto != '') {
            $familia = $_GET['familia'];
            if (isset($_GET['id'])) {
                if (ctype_digit($_GET['id']) ? true : false) {
                    $id = intval($_GET['id']);
                    $actualizacionProducto = "UPDATE productos SET nombre=?,nombre_corto=?,descripcion=?,pvp=?,familia=? WHERE id=?";
                    $stmt = $conProyecto->prepare($actualizacionProducto);
                    $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
                    $stmt->bindParam(2, $nombreCorto, PDO::PARAM_STR);
                    $stmt->bindParam(3, $descripcion, PDO::PARAM_STR);
                    $stmt->bindParam(4, $precio, PDO::PARAM_STR);
                    $stmt->bindParam(5, $familia, PDO::PARAM_STR);
                    $stmt->bindParam(6, $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $resultado = "REGISTRO MODIFICADO";
                } else {
                    $resultado = "Identificador no válido";
                }
            } else {
                $resultado = "No existe un identificador";
            }
        } else {
            $resultado = "Los datos no son válidos";
        }
    } else {
        $resultado = "REGISTRO REPETIDO O ERRÓNEO";
    }
}
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
    <title>Crear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</head>

<body class="container-xl bg-info">
    <header class="row">
        <h1 class="col-xl-12 text-center">Modificar Producto</h1>
    </header>
    <main>
        <section>
            <form name="eleccionCrearProducto" method="get" action="./update.php" target="_self">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="row justify-content-evenly">
                    <div class="col-sm-5">
                        <div class="row"><label class="form-label" for="idNombre">Nombre</label></div>
                        <div class="row"><input type="text" name="nombre" id="idNombre" class="form-control" placeholder="Nombre" value="<?php echo "$objRegistro->nombre"; ?>" required></div>
                    </div>
                    <div class="col-sm-5">
                        <div class="row"><label class="form-label" for="idNombreCorto">Nombre Corto</label></div>
                        <div class="row"><input type="text" name="nombreCorto" id="idNombreCorto" class="form-control" placeholder="Nombre Corto" value="<?php echo "$objRegistro->nombre_corto"; ?>" required></div>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-sm-5">
                        <div class="row"><label class="form-label" for="idPrecio">Precio (€)</label></div>
                        <div class="row"><input type="number" name="precio" id="idPrecio" class="form-control" placeholder="Precio (€)" min="0" step="0.01" value="<?php echo "$objRegistro->pvp"; ?>" required></div>
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
                                        if (strcmp($registro->cod, $objRegistro->familia) == 0) {
                                            echo "<option value='$registro->cod' selected>$registro->nombre</option>";
                                        } else {
                                            echo "<option value='$registro->cod'>$registro->nombre</option>";
                                        }
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
                        <div class="row"><textarea name="descripcion" class="form-control" id="idDescripcion" rows="15"><?php echo "$objRegistro->descripcion"; ?></textarea></div>
                    </div>
                    <div class="col-sm-3 mt-3 align-self-center">
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
                                <button type="submit" class="btn btn-primary " name="modificarProducto" value="ok">Modificar</button>
                            </div>
                            <div class="col-sm-3 mt-3 d-grid gap-2 col-12">
                                <a href="./listado.php" class="btn col-sm-12 text-white" style="background-color: #2596be;" target="_self">Volver</a>
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