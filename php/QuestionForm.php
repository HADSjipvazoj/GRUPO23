<!DOCTYPE html>
<html>
    <head>
        <?php include '../html/Head.html'?>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/ValidateFieldsQuestion.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles/personal.css">
    </head>
    <body>
        <?php include '../php/Menus.php' ?>
        <section class="main" id="s1">
            <div>
                <form action = "AddQuestion.php" name = "formulario" id = "formulario">
                    Marque el tipo de usuario <br>
                    <input type="radio" name="user" id="user1" value="alumno">Alumno<br>
                    <input type="radio" name="user" id="user2" value="profesor">Profesor<br><br>
                    Dirección de correo: <input type="text" id= "email" name="email"><br><br>
                    Enunciado de la pregunta: <input type="text" id= "enunciado" name="enunciado"><br><br>
                    Respuesta Correcta: <input type="text" id= "correcta" name="correcta"><br>
                    Respuesta Incorrecta 1: <input type="text" id= "incorrecta1" name="incorrecta1"><br>
                    Respuesta Incorrecta 2: <input type="text" id= "incorrecta2" name="incorrecta2"><br>
                    Respuesta Incorrecta 3: <input type="text" id= "incorrecta3" name="incorrecta3"><br><br>
                    Nivel de dificultad:
                    <select name="dificultad" id="dificultad">
                        <option value="1"> Baja </option>
                        <option value="2"> Media </option>
                        <option value="3"> Alta </option>
                    </select> <br><br>
                    Tema de la pregunta: <input type="text" id= "tema" name="tema"><br><br>
                    <input id="submit" type="submit" value="Enviar">
                    <input id="reset" type="button" value="Deshacer">
                    <br><br>
                    <div id="aviso"></div>
                </form>
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
