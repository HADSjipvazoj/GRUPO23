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
                        //error_reporting(E_ERROR | E_PARSE);
                        include "DbConfig.php";
                        if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                        {
                            die("No ha sido posible establecer la conexión con el servidor. <br> <a href = 'QuestionFormWithImage.php'> Intentelo de nuevo. </a>");
                        }
                        $result = $data_base->query("SELECT correo, contrasenia from usuarios WHERE correo ='".$_REQUEST['email']."' ");
                        if(mysqli_num_rows($result) == 0)
                        {
                            // El usuario no está registrado
                            $mensaje = "Usuario no registrado.";
                            error_mensaje($mensaje);       
                        } else {
                            $user = $result->fetch_assoc();
                            if($_REQUEST["pass"] != $user["contrasenia"]){
                                $mensaje = "Contraseña incorrecta.";
                                error_mensaje($mensaje);
                            }else{
                                echo"Credenciales correctas <br>";
                                echo"Acceso a la aplicación <a href = 'Layout.php?usuario=".$_REQUEST["email"]."'>enlace</a>.";
                            }
                            
                        }
                        $data_base->close();
                    }else{
                        echo'<form name = "formulario" id = "formulario" method = "POST">
                                <!--Marque el tipo de usuario <br>
                                <input type="radio" name="user" id="user1" value="Alumno">Alumno<br>
                                <input type="radio" name="user" id="user2" value="Profesor">Profesor<br><br>-->
                                Dirección de correo: <input type="text" id= "email" name="email"><br>
                                Contraseña: <input type="text" id= "pass" name="pass"><br>
                                <input id="submit" name="submit" type="submit" value="Enviar"> <br>
                             </form>';
                    }
                    
                ?>
                
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
