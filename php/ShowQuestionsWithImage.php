<!DOCTYPE html>
<html>
    <head>
        <?php include '../html/Head.html'?>
        <link rel="stylesheet" type="text/css" href="../styles/show_images.css">
    </head>
<body>
    <?php include '../php/Menus.php' ?>
        <section class="main" id="s1">
            <div>
            <?php
                // Suprimir los warnings en caso de errores.
                error_reporting(E_ERROR | E_PARSE);
                $user = "root";
                $password = "";
                $db = "Quiz";

                $data_base = mysqli_connect("localhost",$user, $password, $db);
                
                if (!$data_base)
                {
                    die("No ha sido posible conectarse a la base de datos.<br> Por favor, inténtelo más adelante.");
                    //die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
                }

                $query = "SELECT correo, enunciado, r_correcta, imagen FROM Preguntas ORDER BY id";
                if(!$results = $data_base->query($query)){
                    die("No ha sido posible acceder a las preguntas. <br> Por favor, inténtelo más adelante.");
                    //die ("Fallo al hacer la query a MySQL: " . mysqli_error($data_base));
                }
                
                echo("<h1>Preguntas almacenadas en la Base de Datos</h1><br><br>");
                echo("<table  class='center' id = 'tabla_bd'>");
                echo("<tr> <th>Dirección de correo</th> <th>Enunciado</th> <th>Respuesta Correcta</th> <th>Imagen</th> </tr>");
                while($row = $results->fetch_assoc())
                {
                    echo('<tr><td>'.$row["correo"].'</td>
                              <td>'.$row["enunciado"].'</td>
                              <td>'.$row["r_correcta"].'</td>
                              <td height = "90"><img height="90" align = "middle" src="data:image/jpeg;base64,'.base64_encode($row['imagen']).'"</td></tr>');
                }
                echo("</table>");
                $data_base->close();
            ?>
            </div>
        </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
