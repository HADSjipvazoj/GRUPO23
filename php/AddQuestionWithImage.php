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
                    // Suprimir los warnings en caso de errores.
                    error_reporting(E_ERROR | E_PARSE);
                    $user = "root";
                    $password = "";
                    $db = "Quiz";

                    if (!$data_base = mysqli_connect("localhost", $user, $password, $db))
                    {
                        die("No ha sido posible establecer la conexión con el servidor. <br> Inténtelo de nuevo más adelante.");
                        //die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
                    }else{
                        echo("Conexión con el servidor establecida establecida. <br>");
                    }

                    $image = addslashes(file_get_contents($_FILES["fileupload"]["tmp_name"]));
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
                                VALUES ('".$_REQUEST["user"]."',
                                        '".$_REQUEST["email"]."',
                                        '".$_REQUEST["enunciado"]."',
                                        '".$_REQUEST['correcta']."',
                                        '".$_REQUEST['incorrecta1']."',
                                        '".$_REQUEST['incorrecta2']."',
                                        '".$_REQUEST['incorrecta3']."', 
                                        '".$_REQUEST['dificultad']."',
                                        '".$_REQUEST['tema']."',
                                        '$image')";
                    
                    if ($data_base->query($insert) == TRUE) {
                        echo "Nueva pregunta almacenada con éxito. <br>";
                        echo("Puede consultar las preguntas en el siguiente <a href = 'ShowQuestionsWithImage.php'>enlace</a>.");
                    } else {
                        echo("No ha sido posible insertar su pregunta en la base de datos.");
                        //echo "Error: <br>" . $data_base->error;
                    }

                    $data_base->close();
                ?>

            </div>
        </section>
        <?php include '../html/Footer.html'?>
    </body>
</html>
