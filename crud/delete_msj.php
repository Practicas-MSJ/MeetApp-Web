<?php

// conectar a la base de datos
require_once("../conexion/ddbb.php");
$conn = new mysqli(HOST, USER, PASS, DBNAME);
/*comprobamos si la variable "id" está configurada en la URL, y comprobamos que es válida */
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
// obtener el valor de ID mediante el método GET
    $id = $_GET['id'];
    $sql = "DELETE FROM MESSAGES WHERE ID='$id'"
    or die(mysqli_error());
// eliminamos la entrada
    $result = mysqli_query($conn, $sql);
// redirigimos de vuelta a la página de vista principal
    header("Location: ../index.php");
} else {
    /* Si el ID no está configurado, o no es válido, volvemos a la página principal*/
    header("Location: ../index.php");
}
$conn->close();
?>