<div id='page-wrap'>
<header class='main' id='h1'>
    <?php
        // Fichero para el tratamiento de los errores. Al incluirlo aquí se incluye en todas las
        // páginas para las que es necesario.
        include '../php/Error.php';
        if(isset($_GET["usuario"])){
            echo "<span><a href='LogOut.php'>Log Out</a></span>";
        }else{
            // Solo estas dos opciones se muestran a los usuarios no registrados
            echo "<span><a href='LogIn.php'>Log In</a></span> &nbsp &nbsp ";
            echo "<span><a href='SignUp.php'>Sign Up</a></span>";
        }
    ?>
    <span>
        <?php
            // Eliminar warnings cuando se producen errores
            // Estos errores se gestionarán más adelante
            error_reporting(E_ERROR | E_PARSE);
            
            // Añadir el nombre de usuario y su imagen en la zona superior
            if(isset($_GET["usuario"]))
            {
                // Acceso a la base de datos.
                include "DbConfig.php";
                $error = false;

                // Comprobación de errores en la conexión.
                if ($data_base = mysqli_connect($server, $user, $pass, $basededatos))
                {
                    // Si se ha podido comectar a la base de datos iniciamos la query.
                    $query = "SELECT * FROM usuarios WHERE correo = '".$_GET["usuario"]."'";

                    if(!$results = $data_base->query($query)){
                        $error = true;
                    }else if($results->num_rows == 0){
                        $error = true;
                    }

                    // Cerrar la base de datos.
                    $data_base->close();

                } else {
                    // Se han producido errores.
                    $error = true;
                }

                // Mostrar la imagen en el menú superior en caso de que no hayan errores.
                if(!$error){
                    $info = mysqli_fetch_assoc($results);
                    echo "&nbsp &nbsp Usuario: ".$info["correo"]."&nbsp &nbsp &nbsp";
                    if(!is_null($info['imagen']))
                        echo('<img height="60" align = "middle" src="data:image/jpeg;base64,'.base64_encode( $info["imagen"] ).'"/>');
                }else{
                    echo "&nbsp &nbsp Usuario desconocido";
                }

            }
        ?>
    </span>
</header>

<nav class='main' id='n1' role='navigation'>
    <?php
        // Si hay un usuario registrado añado el parámetro a la URL
        if(isset($_GET["usuario"])){
            echo "<span><a href='Layout.php?usuario=".$_REQUEST["usuario"]."'>Inicio</a></span>";
            if(!$error){
                echo "<span><a href='QuestionFormWithImage.php?usuario=".$_REQUEST["usuario"]."'>Insertar Pregunta</a></span>";
                echo "<span><a href='ShowQuestionsWithImage.php?usuario=".$_REQUEST["usuario"]."'>Mostrar Preguntas</a></span>";
            }
            echo "<span><a href='Credits.php?usuario=".$_REQUEST["usuario"]."' >Creditos</a></span>";
        }else{
        // solo estas dos opciones se muestran a los usuarios no registrados
            echo"<span><a href='Layout.php'>Inicio</a></span>
                 <span><a href='Credits.php'>Creditos</a></span>";
        }
    ?>
</nav>