<?php
    //Si no hay ningún usuario "loggeado" se le redirecciona a la página inicial.
    if(isset($_GET["usuario"])){
        header('Location: Layout.php');
    }
?>
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
                    if(isset($_REQUEST["submit"])){
                        // Suprimir warnings. Los errores se gestionan más abajo
                        error_reporting(E_ERROR | E_PARSE);

                        // Necesitaremos el acceso a la base de datos
                        include "DbConfig.php";
                        
                        // Comprobar que todos los parámetros estén introducidos y correctos.
                        if(!isset($_REQUEST["email"]) || strlen($_REQUEST['email']) == 0){
                          $mensaje = "Introduce el correo del usuario.";
                          error_mensaje($mensaje);
                        }

                        if(!isset($_REQUEST["pass"]) || strlen($_REQUEST['pass']) == 0){
                          $mensaje = "Introduce la contrasenia del usuario.";
                          error_mensaje($mensaje);
                        }

                        // Establecer la conexión con la base de datos
                        if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                        {
                            $mensaje = "No ha sido posible establecer la conexión con el servidor.";
                            error_mensaje($mensaje);
                        }

                        // Comprobar si el usuario está en la base de datos
                        if(!$result = $data_base->query("SELECT correo, contrasenia from usuarios WHERE correo ='".$_REQUEST['email']."' ")){
                            $data_base->close();
                            $mensaje = "No ha sido posible establecer la conexión con el servidor.";
                            error_mensaje($mensaje);
                        };

                        // Cerrar la base de datos
                        $data_base->close();
                        
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
                    }else{
                        // Formulario
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
