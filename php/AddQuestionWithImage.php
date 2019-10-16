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

                    //Establecer la conexion con la base de datos.
                    if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                    {
                        die("No ha sido posible establecer la conexión con el servidor. <br> <a href = 'QuestionFormWithImage.php'> Intentelo de nuevo. </a>");
                    }else{
                        echo("Conexión con el servidor establecida. <br>");
                    }

                    // Acceder a la imagen enviada desde el cliente
                    $image = addslashes(file_get_contents($_FILES["fileupload"]["tmp_name"]));
                    $insert =  "INSERT INTO preguntas (tipo_usuario,
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
                        echo("Nueva pregunta almacenada con éxito. <br> Puede consultar las preguntas en el siguiente <a href = 'ShowQuestionsWithImage.php'>enlace</a>.");
                    } else {
                        echo("No ha sido posible insertar su pregunta en la base de datos. <br> <a href = 'QuestionFormWithImage.php'> Intentelo de nuevo. </a>");
                    }
                    // Cerrar la conexión con la base de datos
                    $data_base->close();
                ?>

            </div>
        </section>
        <?php include '../html/Footer.html'?>
    </body>
</html>
