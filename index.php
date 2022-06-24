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
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <title>MeetApp</title>
    </head>

    <?php
        require_once("conexion/ddbb.php");
        $conn = new mysqli(HOST, USER, PASS, DBNAME);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

        $sql = "SELECT MESSAGES.ID, MESSAGE_DATE, FAVOURITE, IMAGE, TEXT, CATEGORY_ID, USER_ID, USERS.NAME FROM MESSAGES
                INNER JOIN USERS ON MESSAGES.USER_ID = USERS.ID ORDER BY ID DESC";
        $result = $conn->query($sql);
    ?>

    <body>
        <div class="indexPage">
        <div class="header">
            <section class="dropdown">
                     <button onclick="navFunction()" class="dropbtn"><h1><i class="fi fi-rr-align-justify"></i></h1></button>
                     <div id="myDropdown" class="dropdown-content">
                         <a href="events.php">Events</a>
                         <div class="line"></div>
                         <a href="#">Favourites</a>
                         <div class="line"></div>
                         <a href="#">Categories</a>
                     </div>
            </section>

            <section class="Tindex">     <!-- título de la cabecera-->
            <h1>MeetApp</h1>
            </section>

            <section class="logForm">
                <h1><i class="fi fi-rr-user"></i></h1>
            </section>
        </div>

            <div class="line"></div>         <!-- línea de separación de la cabecera -->
            <div>
                <div class="Container">
                    <br><br><br><br>
                    <!-- Insertar cuerpo de la pag con php -->

                    <?php if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_array()) { ?>

                    <div class="message"> <!--cuerpo de mensaje-->
                        <h3><?php echo $row["NAME"]?></h3>
                        <section class="line"></section><br>
                        <?php echo $row["TEXT"]?>
                        <section class="editMessage">
                            <button class="editBtn"><i class="fi fi-rr-pencil"></i></button>
                            <a href="crud/delete_msj.php?id=<?php echo $row[0]?>"><button class="editBtn"><i class="fi fi-rr-trash"></i></button></a>
                        </section>
                    </div>
                    <?php }
                    } else {
                        echo "<div class='message', align='center' '>There is no messages yet. Be the first one to write a meesage.</div>";
                    }
                    $conn->close();
                    ?>
                </div>
                <div class="background-index">
                </div>
            </div>
        </div>
        <a href="new_message.php" <div class="addBtn"><h3><i class="fi fi-rr-paper-plane"></i></h3></div></a> <!-- btn añadir mensaje-->
    </body>
</html>