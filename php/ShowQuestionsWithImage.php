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
                $user = "root";
                $password = "";
                $db = "Quiz";

                $data_base = mysqli_connect("localhost",$user, $password, $db);
                
                if (!$data_base)
                {
                    die ("Fallo al conectar a MySQL: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM Preguntas ORDER BY primary_key DESC";
                if(!$results = $data_base->query($query)){
                    die ("Fallo al hacer la query a MySQL: " . mysqli_error($db));
                }
                
                echo("<h1> Preguntas almacenadas en la Base de Datos </h1>");
                echo("<table  class='center' id = 'tabla_bd'>");
                echo("<tr><th>correo</th><th>Enunciado</th>><th>Respuesta Correcta</th><th>Imagen</th></tr>");
                while($row = $results->fetch_assoc())
                {
                    echo('<tr><td>'.$row["correo"].'</td>
                              <td>'.$row["enunciado"].'</td>
                              <td>'.$row["r_correcta"].'</td>
                              <td height = "90"><img height="90" align = "middle" src="data:image/jpeg;base64,'.base64_encode($row['imagen']).'"</td></tr>');
                }
                echo("</table>");
            ?>
            </div>
        </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
