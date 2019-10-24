<?php
  if(!isset($_GET["usuario"])){
      header('Location: Layout.php');
  }
?>
<!DOCTYPE html>
<html>
    <head>
    <?php include '../html/Head.html'?>
    </head>
    <body>
        <?php include '../php/Menus.php'?>
        <section class="main" id="s1">
            <div>
                <?php
                    // Eliminar wernings cuando se producen errores
                    // Estos errores se gestionarán más adelante
                    error_reporting(E_ERROR | E_PARSE);

                    include "DbConfig.php";
                    function error_mensaje($mensaje) {
                        echo  $mensaje.'<br>';
                        echo 'Enlace al <a href="javascript:window.history.back()">formulario</a>.';
                        echo "</div>
                            </section>";
                        include '../html/Footer.html';
                        echo"</body>
                            </html>";
                        exit;
                    }

                    if(!isset($_REQUEST['user']) || strlen($_REQUEST['user']) == 0){
                        $mensaje = "Selecciona un tipo de usuario.";
                        error_mensaje($mensaje);
                    }

                    if(!isset($_REQUEST['email']) || strlen($_REQUEST['email']) == 0){
                        $mensaje = "Indica tu email.";
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

                    if(!isset($_REQUEST['enunciado']) || strlen($_REQUEST['enunciado']) == 0){
                        $mensaje = "Indica un enunciado.";
                        error_mensaje($mensaje);
                    }

                    if(!isset($_REQUEST['correcta']) || strlen($_REQUEST['correcta']) == 0){
                        $mensaje = "Indica la respuesta correcta.";
                        error_mensaje($mensaje);
                    }

                    if(!isset($_REQUEST['incorrecta1']) || strlen($_REQUEST['incorrecta1']) == 0){
                        $mensaje = "Primera respuesta incorrecta no especificada.";
                        error_mensaje($mensaje);
                    }
                    if(!isset($_REQUEST['incorrecta2']) || strlen($_REQUEST['incorrecta2']) == 0){
                        $mensaje = "Segunda respuesta incorrecta no especificada.";
                        error_mensaje($mensaje);
                    }
                    if(!isset($_REQUEST['incorrecta3']) || strlen($_REQUEST['incorrecta3']) == 0){
                        $mensaje = "Tercera respuesta incorrecta no especificada.";
                        error_mensaje($mensaje);
                    }

                    if(!isset($_REQUEST['dificultad']) || strlen($_REQUEST['dificultad']) == 0){
                        $mensaje = "Selecciona un nivel de dificultad.";
                        error_mensaje($mensaje);
                    }

                    if(!isset($_REQUEST['tema']) || strlen($_REQUEST['tema']) == 0){
                        $mensaje = "Indica un tema para la pregunta.";
                        error_mensaje($mensaje);
                    }

                    // Acceder a la imagen enviada desde el cliente
                    if(!$image = addslashes(file_get_contents($_FILES["fileupload"]["tmp_name"]))){
                        $mensaje = "Indica una imagen valida para la pregunta.";
                        error_mensaje($mensaje);
                    }

                    $pattern = '/(\.png|\.jpg|\.jpeg)$/i';
                    if(!preg_match($pattern, $_FILES["fileupload"]["name"])){
                        $mensaje = "Indica una imagen valida para la pregunta.";
                        error_mensaje($mensaje);
                    };

                    //Establecer la conexion con la base de datos.
                    if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                    {
                        die("No ha sido posible establecer la conexión con el servidor. <br> <a href = 'QuestionFormWithImage.php'> Intentelo de nuevo. </a>");
                    }else{
                        echo("Conexión con el servidor establecida. <br>");
                    }

                    $insert =  "INSERT INTO Preguntas (tipo_usuario,
                                                      correo,
                                                      enunciado,
                                                      r_correcta,
                                                      r_incorrecta1,
                                                      r_incorrecta2,
                                                      r_incorrecta3,
                                                      dificultad,
                                                      tema,
                                                      imagen)
                                VALUES ('".$_REQUEST['user']."',
                                        '".$_REQUEST['email']."',
                                        '".$_REQUEST['enunciado']."',
                                        '".$_REQUEST['correcta']."',
                                        '".$_REQUEST['incorrecta1']."',
                                        '".$_REQUEST['incorrecta2']."',
                                        '".$_REQUEST['incorrecta3']."',
                                        '".$_REQUEST['dificultad']."',
                                        '".$_REQUEST['tema']."',
                                        '$image')";

                    // Control de errores sobre la introducción de nuevas entradas en la base de datos
                    if ($data_base->query($insert) == TRUE) {
                        echo("Nueva pregunta almacenada con éxito. <br> Puede consultar las preguntas en el siguiente <a href = 'ShowQuestionsWithImage.php?usuario=".$_REQUEST["usuario"]."'>enlace</a>.");
                    } else {
                        echo("No ha sido posible insertar su pregunta en la base de datos. <br> <a href = 'QuestionFormWithImage.php?usuario=".$_REQUEST["usuario"]."'> Intentelo de nuevo. </a>");
                    }
                    // Cerrar la conexión con la base de datos
                    $data_base->close();
                ?>

            </div>
        </section>
        <?php include '../html/Footer.html'?>
    </body>
</html>
