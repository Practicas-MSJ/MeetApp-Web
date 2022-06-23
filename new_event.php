<?php
/* Permite a los usuarios crear una nueva entrada en la base de datos */
// Crea el nuevo formulario de nuevo registro
function renderForm($text, $error) {
    ?>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/form.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- enlace googlefonts -->
        <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Chakra+Petch:wght@300&family=Permanent+Marker&family=Press+Start+2P&display=swap" rel="stylesheet">
        <script src="js/functions.js"></script>
        <title>MeetApp - New event</title>
    </head>
    <body class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="text" align="center">
                        <h1>New event</h1>
                        <fieldset>
                            <legend><span class="number">1</span> Your Basic Info</legend>

                            <label for="name">Name:</label>
                            <input type="text" id="name" name="user_name">
                        </fieldset>
                        <?php
                        // Si hay errores, los muestra en pantalla
                        if ($error != '') {
                            echo '<div style="padding:4px; color:#ff0000;">' . $error . '</div><br>';
                        }
                        ?>
                        <button type="submit" name="submit" value="Submit" class="buttonform">Meet up!</button>
                        <a href="index.php" <button class="cancelbutton">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="background" id="new-event">
    </div>

    </body>
    </html>
    <?php
}
// conectamos a la base de datos
require_once("conexion/ddbb.php");
$conn = new mysqli(HOST, USER, PASS, DBNAME);
// Comprueba si el formulario ha sido enviado.
// Si se ha enviado, comienza el proceso el formulario y guarda los datos en la DB
if (isset($_POST['submit'])) {
    // Obtenemos los datos del formulario
    $text = htmlspecialchars($_POST['message']);
    $date = date("Y-m-d");
    $favourite = false;
    // Comprueba el texto ha sido introducido
    if ($text == '') {
        // Genera el mensaje de error
        $error = 'Someone is hoping to read about you, write something :)';
        // Si ningún campo esta en blanco, muestra el formulario otra vez
        renderForm($text, $error);
    } else {
        // guardamos los datos en la base de datos
        $sql = "INSERT MESSAGES SET TEXT = '$text', MESSAGE_DATE = '$date', FAVOURITE = '$favourite', USER_ID = 1" or die(mysqli_error());
        mysqli_query($conn, $sql);
        /* Una vez que han sido guardados, redirigimos a la página de vista principal*/
        header("Location: index.php");
    }
} else { // Si el formulario no han sido enviado, muestra el formulario
    renderForm('', '');
}
?>