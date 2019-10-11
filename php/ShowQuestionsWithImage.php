<!DOCTYPE html>
<html>
    <head>
        <?php include '../html/Head.html'?>
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
                }else{
                    echo("Conexión establecida");
                }

                $query = "SELECT * FROM Preguntas";
                if(!$results = $data_base->query($query)){
                    die ("Fallo al hacer la query a MySQL: " . mysqli_error($db));
                }
                
                echo("<h1> Preguntas almacenadas en la Base de Datos</h1>");
                echo("<table>");
                echo("<tr><th>correo</th></tr>");
                while($row = $results->fetch_assoc())
                {
                    echo("<tr><td>".$row["correo"]."</td></tr>");
                }
                echo("</table>");
            ?>
            </div>
        </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
