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
                <form action = "AddQuestionWithImage.php" name = "formulario" id = "formulario" method = "POST" enctype="multipart/form-data">
                    Marque el tipo de usuario <br>
                    <input type="radio" name="user" id="user1" value="Alumno">Alumno<br>
                    <input type="radio" name="user" id="user2" value="Profesor">Profesor<br><br>
                    Dirección de correo: <input type="text" id= "email" name="email"><br>
                    Nombre y apellidos: <input type="text" id= "enunciado" name="enunciado"><br>
                    Contraseña: <input type="password" id= "correcta" name="correcta"><br>
                    Repetir Contraseña: <input type="password" id= "correcta" name="correcta"><br>
                    Imagen para el usuario: <input type="file" name="fileupload" id="fileupload"> <br>
                    <input id="submit" type="submit" value="Enviar">
                    <input id="reset" type="reset" value="Deshacer">
                </form>
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
