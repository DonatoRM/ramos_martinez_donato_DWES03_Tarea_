# ramos*martinez_donato_DWES03_Tarea*

<h1>Tarea 3 de Desarrollo Web de Entorno Servidor</h1>
<p>Partiendo de la base de datos '<strong>proyecto</strong>' usada en los ejemplos y ejercicios de la unidad , se trata de programar un <strong>CRUD</strong> (<code>create, read, update, delete</code>) que permita gestionar los registros de la tabla '<strong>productos</strong>'. La aplicación se dividirá en 5 páginas:</p>
<ul>
<li><code><strong>listado.php</strong></code>. Mostrará en una tabla los datos <strong>código</strong> y <strong>nombre</strong> y los botones para crear un nuevo registro, actualizar uno existente, borrarlo o ver todos sus detalles. Ver imagen.</li>
<li><code><strong>crear.php</strong></code>. Será un formulario para rellenar todos los campos de productos (a excepción del <strong>id</strong>). Para la familia nos aparecerá un "<code><strong>select</strong></code>" con los nombre de las familias de los productos para elegir uno (lógicamente aunque mostremos los nombres pro formulario enviaremos el código). Ver imagen.</li>
<li><code><strong>detalle.php</strong></code>. Mostrará todo los detalles del producto seleccionado.</li>
<li><code><strong>update.php</strong></code>. Nos aparecerá un formulario con los campos rellenos con los valores del producto seleccionado desde "<strong>listado.php</strong>" incluido el select donde seleccionamos la familia.</li>
<li><code><strong>borrar.php</strong></code>. Será una página <strong>php</strong> con el código necesario para borrar el producto seleccionado desde "<strong>listado.php</strong>" un mensaje de información y un botón volver para volver a "<code><strong>listado.php</strong></code>".</li>
</ul>
<p>Para acceder a la base de datos se debe usar <em>PDO</em>. Controlaremos y mostraremos los posible errores. Para los estilos se recomienda usar <strong>Bootstrap</strong>.</p>
<p>Pasaremos el código de producto por "<code><strong>get</strong></code>" tanto para "<code><strong>detalle.php</strong></code>" como para "<code><strong>update.php</strong></code>". Utilizando en el enlace "<code><strong>detalle.php?id=cod</strong></code>" .En ambas páginas comprobaremos que esta variable existe, si no redireccionaremos a "<code><strong>listado.php</strong></code>" para esto podemos usar "<code><strong>header('Location:listado.php')</strong></code>".</p>
