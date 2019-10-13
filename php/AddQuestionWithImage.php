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
                    $user = "root";
                    $password = "";
                    $db = "Quiz";

                    $data_base = mysqli_connect("localhost",$user, $password, $db);

                    if (!$data_base)
                    {
                        die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
                    }else{
                        echo("Conexión establecida <br>");
                    }

                    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
                    $insert =  "INSERT INTO Preguntas (tipo_usuario, 
                                                      correo, enunciado, 
                                                      r_correcta, 
                                                      r_incorrecta_1, 
                                                      r_incorrecta_2, 
                                                      r_incorrecta_3, 
                                                      r_incorrecta_4, 
                                                      dificultad, 
                                                      imagen)  
                                VALUES ('".$_REQUEST["user"]."',
                                        '".$_REQUEST["email"]."',
                                        '".$_REQUEST["enunciado"]."',
                                        '".$_REQUEST['correcta']."',
                                        '".$_REQUEST['incorrecta1']."',
                                        '".$_REQUEST['incorrecta2']."',
                                        '".$_REQUEST['incorrecta3']."', 
                                        'prueba', 
                                        'baja',
                                        '$image')";
                    
                    if ($data_base->query($insert) == TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: <br>" . $data_base->error;
                    }

                    $data_base->close();
                ?>

            </div>
        </section>
        <?php include '../html/Footer.html'?>
    </body>
</html>
