<?php
    // Si no hay ningún usuario "loggeado" se le redirecciona a la página inicial.
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
                    // Suprimir warnings. Los errores se gestionan más abajo
                    error_reporting(E_ERROR | E_PARSE);

                    // Cuando se han enviado los datos del registro
                    if(isset($_REQUEST['submit'])){
                        // Si el usuario no ha introducido el tipo de usuario a registrar
                        if(!isset($_REQUEST['user']) || strlen($_REQUEST['user']) == 0){
                            $mensaje ='Introduzca el tipo de usuario';
                            error_mensaje($mensaje);
                        }

                        // Seleccionar la expresión regular para cada uno de los tipos de usuario
                        if ($_REQUEST['user'] == "Alumno") {
                            $pattern = '/^([a-z]|[A-Z])+[0-9]{3}@ikasle\.ehu\.(es|eus)$/';
                        } else {
                            $pattern = '/^([a-z]|[A-Z])+(\.([a-z]|[A-Z])+)?@ehu\.(es|eus)$/';
                        }

                        // Comprobamos el email
                        if (!isset($_REQUEST['email']) || !preg_match($pattern, $_REQUEST['email'])) {
                            $mensaje = "Email incorrecto para el tipo de usuario indicado.";
                            error_mensaje($mensaje);
                        }

                        // El nombre y apellidos debe constar de minimo dos palabras
                        $pattern = '/\S+ +\S+/';

                        // Comprobamos nombre y apellidos
                        if(!isset($_REQUEST['nombre']) || !preg_match($pattern, $_REQUEST['nombre'])){
                            $mensaje = "Indica nombre y apellidos (Minimo dos palabras).";
                            error_mensaje($mensaje);
                        }

                        // La contraseña debe tener al menos 6 caracteres
                        if(!isset($_REQUEST['pass1']) || strlen($_REQUEST["pass1"]) < 6){
                            $mensaje = "Contraseña demasiado corta";
                            error_mensaje($mensaje);
                        }

                        // Comprobar si son iguales
                        if(!isset($_REQUEST['pass2']) || $_REQUEST["pass1"] != $_REQUEST["pass2"]){
                            $mensaje = "Las contraseñas no coinciden";
                            error_mensaje($mensaje);
                        }

                        // Tras comprobar todo ya accedo a la base de datos
                        include "DbConfig.php";

                        // Conexión a la base de datos
                        if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                        {
                            $mensaje = "No ha sido posible establecer la conexión con el servidor.";
                            error_mensaje($mensaje);
                        }

                        // Compruebo si está ya registrado.
                        if(!$result = $data_base->query("SELECT correo from usuarios WHERE correo ='".$_REQUEST['email']."' ")){
                            $data_base->close();
                            $mensaje = "No ha sido posible establecer la conexión con el servidor.";
                            error_mensaje($mensaje);
                        };

                        // Solo lo añado si el usuario no está registrado
                        if(mysqli_num_rows($result) == 0)
                        {
                            // Comprobar algún posible error en la imagen.
                            $pattern = '/(\.png|\.jpg|\.jpeg)$/i';
                            if($_FILES["fileupload"]["tmp_name"] && preg_match($pattern, $_FILES["fileupload"]["name"])){
                              $image = addslashes(file_get_contents($_FILES["fileupload"]["tmp_name"]));
                            }else {
                              $image = addslashes(file_get_contents("../images/anonymous.jpeg"));
                            }

                            $insert =  "INSERT INTO usuarios (correo,
                                                      tipo,
                                                      nombre,
                                                      contrasenia,
                                                      imagen)
                                        VALUES ('".$_REQUEST['email']."',
                                                '".$_REQUEST['user']."',
                                                '".$_REQUEST['nombre']."',
                                                '".$_REQUEST['pass1']."',
                                                '$image')";

                            // Hay que asegurarse de que ha sido posible insertar al usuario en la base de datos.
                            if ($data_base->query($insert) == TRUE) {
                                echo("Usuario creado con éxito. <br> Proceda a conectarse en el siguiente <a href = 'LogIn.php'>enlace</a>.");
                            } else {
                                $data_base->close();
                                $mensaje = "No ha sido posible almacenar el usuario. Inténtelo de nuevo más adelante.";
                                error_mensaje($mensaje);
                            }
                        } else {
                            // Cerrar la base de datos
                            $data_base->close();
                            // Si el usuario ya está registrado se devuelve un error
                            $mensaje = "Usuario ya registrado. Cambie la dirección de email.";
                            error_mensaje($mensaje);
                        }
                        // Cerrar la base de datos si no han habido errores.
                        $data_base->close();

                    }else{
                        // Cuando se muestra la pantalla de registro
                        echo'<h1>Registrarse</h1><br><br>
                            <form  name = "formulario" id = "formulario" method = "POST" enctype="multipart/form-data">
                            Tipo de usuario* <br>
                            <input type="radio" name="user" id="user1" value="Alumno">Alumno<br>
                            <input type="radio" name="user" id="user2" value="Profesor">Profesor<br><br>
                            Dirección de correo* <input type="text" id= "email" name="email"><br>
                            Nombre y apellidos* <input type="text" id= "nombre" name="nombre"><br>
                            Contraseña* <input type="password" id= "pass1" name="pass1"><br>
                            Repetir Contraseña* <input type="password" id= "pass2" name="pass2"><br>
                            Imagen para el usuario <input type="file" name="fileupload" id="fileupload"> <br> <br>
                            <input id="submit" name="submit" type="submit" value="Enviar">
                        </form>';
                    }
                ?>
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
