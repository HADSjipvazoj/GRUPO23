<div id='page-wrap'>
<header class='main' id='h1'>
    <span class="right"><a href="SignUp.php">Registro</a></span>
    <span class="right"><a href="LogIn.php">Login</a></span>
    <span class="right"><a href="LogOut.php">Logout</a></span>
    <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
    <span>
        <?php
            // Añadir el nombre de usuario y su imagen en la zona superior
            if(isset($_GET["usuario"])){
                echo "&nbsp &nbsp Usuario -> ".$_GET["usuario"]."&nbsp &nbsp &nbsp";
                include "DbConfig.php";

                // Establecer la conexión con la base de datos para pedir la imagen
                $data_base = mysqli_connect($server, $user, $pass, $basededatos);

                // Caso en que la conexión no se haya podido establecer
                if (!$data_base)
                {
                    die("No ha sido posible conectarse a la base de datos.<br> Por favor, inténtelo más adelante.");
                }

                $query = "SELECT imagen FROM usuarios WHERE correo = '".$_GET["usuario"]."'";
                // Puede haber algún error en la consulta.
                if(!$results = $data_base->query($query)){
                    $data_base->close();
                    die("No ha sido posible acceder a las preguntas. <br> Por favor, inténtelo más adelante.");
                }
                // Mostrar la imagen en el menú superior
                $picture = $results->fetch_assoc();
                echo('<img height="60" align = "middle" src="data:image/jpeg;base64,'.base64_encode( $picture['imagen'] ).'"/>');
            }
        ?>
    </span>
</header>

<nav class='main' id='n1' role='navigation'>
    <?php
        // Si hay un usuario registrado añado el parámetro a la URL
        if(isset($_GET["usuario"])){
            echo "<span><a href='Layout.php?usuario=".$_REQUEST["usuario"]."'>Inicio</a></span>";
            echo "<span><a href='QuestionFormWithImage.php?usuario=".$_REQUEST["usuario"]."'>Insertar Pregunta</a></span>";
            echo "<span><a href='ShowQuestionsWithImage.php?usuario=".$_REQUEST["usuario"]."'>Mostrar Preguntas</a></span>";
            echo "<span><a href='Credits.php?usuario=".$_REQUEST["usuario"]."' >Creditos</a></span>";
        }else{
        // solo estas dos opciones se muestran a los usuarios no registrados
            echo"<span><a href='Layout.php'>Inicio</a></span>
                 <span><a href='Credits.php'>Creditos</a></span>";
        }
    ?>

</nav>
