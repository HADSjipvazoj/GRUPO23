<!DOCTYPE html>
<html>
    <head>
        <?php include '../html/Head.html'?>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/ShowImageInForm.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles/personal.css">
    </head>
    <body>
        <?php include '../php/Menus.php' ?>
        <section class="main" id="s1">
            <div>
                <?php
                    function error_mensaje($mensaje) {
                        echo  $mensaje.'<br>';
                        echo 'Enlace al <a href="javascript:window.history.back()">formulario</a>.';
                        exit;
                    } 
                    if(isset($_REQUEST["submit"])){
                        // Suprimir warnings. Los errores se gestionan más abajo
                        error_reporting(E_ERROR | E_PARSE);
                        include "DbConfig.php";

                        // Establecer la conexión con la base de datos
                        if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                        {
                            die("No ha sido posible establecer la conexión con el servidor. <br> <a href = 'QuestionFormWithImage.php'> Intentelo de nuevo. </a>");
                        }
                        // Mirar si el usuario está en la base de datos
                        $result = $data_base->query("SELECT correo, contrasenia from usuarios WHERE correo ='".$_REQUEST['email']."' ");
                        
                        if(mysqli_num_rows($result) == 0) // El usuario no está registrado
                        {         
                            $mensaje = "Usuario no registrado.";
                            error_mensaje($mensaje);       
                        } else {
                            // Caso de que el usuario esté registrado
                            $user = $result->fetch_assoc();
                            // Compruebo si ha introducido bien la contraseña
                            if($_REQUEST["pass"] != $user["contrasenia"]){
                                $mensaje = "Contraseña incorrecta.";
                                error_mensaje($mensaje);
                            }else{
                                echo"Credenciales correctas <br>";
                                echo"Acceso a la aplicación <a href = 'Layout.php?usuario=".$_REQUEST["email"]."'>enlace</a>.";
                            }
                            
                        }
                        // Cerrar la base de datos
                        $data_base->close();
                    }else{
                        echo'<form name = "formulario" id = "formulario" method = "POST">
                                <!--Marque el tipo de usuario <br>
                                <input type="radio" name="user" id="user1" value="Alumno">Alumno<br>
                                <input type="radio" name="user" id="user2" value="Profesor">Profesor<br><br>-->
                                Dirección de correo: <input type="text" id= "email" name="email"><br>
                                Contraseña: <input type="password" id= "pass" name="pass"><br>
                                <input id="submit" name="submit" type="submit" value="Enviar"> <br>
                             </form>';
                    }
                    
                ?>
                
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
