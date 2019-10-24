<?php
    // Si no hay ningún usuario "loggeado" se le redirecciona a la página inicial.
    if(!isset($_GET["usuario"])){
        header('Location: Layout.php');
    }
?>
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
                // Eliminar wernings cuando se producen errores.
                // Estos errores se gestionarán más adelante.
                error_reporting(E_ERROR | E_PARSE);

                // Datos para acceder a la base de datos.
                include "DbConfig.php";

                // Caso en que la conexión no se haya podido establecer
                if (!$data_base = mysqli_connect($server, $user, $pass, $basededatos))
                {
                    $mensaje = "No ha sido posible conectarse a la base de datos.";
                    error_mensaje($mensaje);
                }

                // Solo cojo de la base de datos las columnas que necesito.
                $query = "SELECT correo, enunciado, r_correcta, imagen FROM Preguntas ORDER BY id";

                // Puede haber algún error en la consulta.
                if(!$results = $data_base->query($query)){
                    $data_base->close();
                    $mensaje = "No ha sido posible acceder a las preguntas.";
                    error_mensaje($mensaje);
                }

                // Cerrar la conexión con la base de datos
                $data_base->close();

                // Cada entrada en la base de datos es representada como una fila en la tabla
                echo("<h1>Preguntas almacenadas en la Base de Datos</h1><br><br>");
                echo("<table  class='center' id = 'tabla_bd'>");
                echo("<tr> <th>Dirección de correo</th> <th>Enunciado</th> <th>Respuesta Correcta</th> <th>Imagen</th> </tr>");
                while($row = $results->fetch_assoc())
                {
                    echo('<tr><td>'.htmlentities($row["correo"]).'</td>
                              <td>'.htmlentities($row["enunciado"]).'</td>
                              <td>'.htmlentities($row["r_correcta"]).'</td>
                              <td height = "90"><img height="90" align = "middle" src="data:image/jpeg;base64,'.base64_encode($row['imagen']).'"</td></tr>');
                }
                echo("</table>");
            ?>
            </div>
        </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
