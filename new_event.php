<?php
/* Permite a los usuarios crear una nueva entrada en la base de datos */
// Crea el nuevo formulario de nuevo registro
function renderForm($title, $description, $location, $date, $error) {
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
                            <legend><span class="number">1</span> What are you planning?</legend>

                            <label for="title">Name:</label>
                            <input type="text" id="title" name="title" value="<?php echo $title; ?>">

                            <label for="description">Say something new to your near people:</label>
                            <textarea type="text" id="description" name="description" value="<?php echo $description; ?>"></textarea>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">2</span>Where you will go?</legend>

                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" value="<?php echo $location; ?>">
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">3</span>When we go? :D</legend>

                            <label for="date">Date (YYYY-MM-DD):</label>
                            <input type="text" id="date" name="date" value="<?php echo $date; ?>">
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
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $location = htmlspecialchars($_POST['location']);
    $date = htmlspecialchars($_POST['date']);
    // Comprueba el texto ha sido introducido
    if ($title == '' || $description == '' || $location == '' || $date == '') {
        // Genera el mensaje de error
        $error = 'Make sure no one has any doubts so that your event is a complete success. Fill in the empty fields :3';
        // Si ningún campo esta en blanco, muestra el formulario otra vez
        renderForm($title, $description, $location, $date, $error);
    } else {
        // guardamos los datos en la base de datos
        $sql = "INSERT EVENTS SET NAME = '$title', EVENT_DATE = '$date', LOCATION = '$location', DESCRIPTION = '$description'"
        or die(mysqli_error());
        mysqli_query($conn, $sql);
        /* Una vez que han sido guardados, redirigimos a la página de vista principal*/
        header("Location: events.php");
    }
} else { // Si el formulario no han sido enviado, muestra el formulario
    renderForm('', '', '', '', '');
}
?>