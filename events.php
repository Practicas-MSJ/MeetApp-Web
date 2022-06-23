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


        <title>MeetApp - Eventos</title>
    </head>

    <?php
    require_once("conexion/ddbb.php");
    $conn = new mysqli(HOST, USER, PASS, DBNAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ID, DESCRIPTION, NAME FROM EVENTS";
    $result = $conn->query($sql);
    ?>

    <body>
        <div class="header">
            <section class="dropdown">
                <button onclick="navFunction()" class="dropbtn">Menu</button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="index.php">Messages</a>
                    <div class="line"></div>
                    <a href="#">Favourites</a>
                    <div class="line"></div>
                    <a href="#">Categories</a>
                </div>
            </section>

            <section class="Tindex">     <!-- título de la cabecera-->
                <h1>Events</h1>
            </section>

            <section class="logForm">
                <h1>X</h1>
            </section>
        </div>

        <div class="line"></div>         <!-- línea de separación de la cabecera -->

        <div>
            <div class="ContainerEvent">
            <br><br><br><br>
            <?php if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_array()) { ?>

                    <div class="message"> <!--cuerpo de mensaje-->
                        <h3><?php echo $row["NAME"]?></h3>
                        <section class="line"></section><br>
                        <?php echo $row["DESCRIPTION"]?>
                        <section class="editMessage">
                            <button class="editBtn">/</button><button class="editBtn">X</button>
                        </section>
                        <a href="event-details.php?id=<?php echo $row[0]?>" <h5 class="details">Details</h5></a>
                    </div>
                <?php }
            } else {
                echo "<div class='message', align='center'>There is no events. Create one!</div>";
            }
            $conn->close();
            ?>
            </div>
            <div class="background-event">
            </div>
        </div>
        <div class="addBtn"><h3>+</h3></div> <!-- btn añadir mensaje-->
    </body>
</html>
