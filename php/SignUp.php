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
                    //error_reporting(E_ERROR | E_PARSE);
                    function error_mensaje($mensaje) {
                        echo  $mensaje.'<br>';
                        echo 'Enlace al <a href="javascript:window.history.back()">formulario</a>.';
                        exit;
                    }
                    if(isset($_REQUEST["submit"])){
                        if(!isset($_REQUEST["user"])){
                            $mensaje ='Introduzca el tipo de usuario';
                            error_mensaje($mensaje);
                        }

                        if ($_REQUEST['user'] == "Alumno") {
                            $pattern = '/^([a-z]|[A-Z])+[0-9]{3}@ikasle\.ehu\.(es|eus)$/';
                        } else {
                            $pattern = '/^([a-z]|[A-Z])+(\.([a-z]|[A-Z])+)?@ehu\.(es|eus)$/';
                        }
                        if (!preg_match($pattern, $_REQUEST['email'])) {
                            $mensaje = "Email incorrecto para el tipo de usuario indicado.";
                            error_mensaje($mensaje);
                        }

                        if(strlen($_REQUEST["pass1"]) < 6){
                            $mensaje = "Contraseña demasiado corta";
                            error_mensaje($mensaje);
                        }
                        if($_REQUEST["pass1"] != $_REQUEST["pass2"]){
                            $mensaje = "Las contraseñas no coinciden";
                            error_mensaje($mensaje);
                        }
                        include "DbConfig.php";
                        if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                        {
                            die("No ha sido posible establecer la conexión con el servidor. <br> <a href = 'QuestionFormWithImage.php'> Intentelo de nuevo. </a>");
                        }
                        $result = $data_base->query("SELECT correo from usuarios WHERE correo ='".$_REQUEST['email']."' ");
                            
                        if(mysqli_num_rows($result) == 0)
                        {
                            $insert =  "INSERT INTO usuarios (correo,
                                                      contrasenia)
                                        VALUES ('".$_REQUEST['email']."',
                                                '".$_REQUEST['pass1']."')";

                            if ($data_base->query($insert) == TRUE) {
                                echo("Usuario creado con éxito. <br> Acceso a la aplicación <a href = 'Layout.php'>enlace</a>.");
                            } else {
                                echo mysqli_errno($data_base) . ": " . mysqli_error($data_base) . "\n";
                                $mensaje = "No ha sido posible almacenar el usuario. Inténtelo de nuevo más adelante.";
                                error_mensaje($mensaje);    
                            }
                        } else {
                            $mensaje = "Usuario ya registrado. Cambie la dirección de email.";
                            error_mensaje($mensaje); 
                        }
                       
                        $data_base->close();

                    }else{
                        echo'<form  name = "formulario" id = "formulario" method = "POST" enctype="multipart/form-data">
                            Marque el tipo de usuario <br>
                            <input type="radio" name="user" id="user1" value="Alumno">Alumno<br>
                            <input type="radio" name="user" id="user2" value="Profesor">Profesor<br><br>
                            Dirección de correo: <input type="text" id= "email" name="email"><br>
                            Nombre y apellidos: <input type="text" id= "nombre" name="nombre"><br>
                            Contraseña: <input type="password" id= "pass1" name="pass1"><br>
                            Repetir Contraseña: <input type="password" id= "pass2" name="pass2"><br>
                            Imagen para el usuario: <input type="file" name="fileupload" id="fileupload"> <br>
                            <input id="submit" name="submit" type="submit" value="Enviar">
                            <input id="reset" type="reset" value="Deshacer">
                        </form>';
                    }
                ?>
                
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>