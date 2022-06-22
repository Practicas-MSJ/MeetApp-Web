<?php
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- enlace estilo texto -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- enlace js -->
    <script src="js/functions.js"></script>
    <!-- enlace googlefonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Chakra+Petch:wght@300&family=Permanent+Marker&family=Press+Start+2P&display=swap" rel="stylesheet">
    <!--enlace para iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>MeetApp</title>
</head>

<?php
require_once("conexion/ddbb.php");
$conn = new mysqli(HOST, USER, PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID, EVENT_DATE, DESCRIPTION, LOCATION, NAME FROM EVENTS";
$result = $conn->query($sql);
?>

<body>


    <div class="iframe_pag">
        <br><br><br><br>
        <!-- Insertar cuerpo de la pag con php -->

        <?php if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_array()) { ?>

                <div class="message"> <!--cuerpo de mensaje-->
                    <h3><?php echo $row["NAME"]?></h3>
                    <section class="line"></section>
                    <?php echo $row["DESCRIPTION"]?>
                    <section class="editMessage">
                        <button class="editBtn">/</button><button class="editBtn">X</button>
                    </section>
                </div>
            <?php }
        } else {
            echo "<br>Todavía no hay ningún evento. Créalo primero.";
        }
        $conn->close();
        ?>
    </div>

</div>

</body>
</html>
