<!DOCTYPE html>
<html>
    <head>
        <?php include '../html/Head.html'?>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/ValidateFieldsQuestion.js"></script>
        <script src="../js/ShowImageInForm.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles/personal.css">
    </head>
    <body>
        <?php include '../php/Menus.php' ?>
        <section class="main" id="s1">
            <div>
                <?php
                    echo "<form action = 'AddQuestionWithImage.php?usuario=".$_REQUEST["usuario"]."' name = 'formulario' id = 'formulario' method = 'POST' enctype='multipart/form-data'>"; 
                ?>
                    Marque el tipo de usuario <br>
                    <input type="radio" name="user" id="user1" value="Alumno">Alumno<br>
                    <input type="radio" name="user" id="user2" value="Profesor">Profesor<br><br>
                <?php   
                    echo"Dirección de correo: <input type='text' id= 'email' name='email' readonly value = '".$_GET["usuario"]."'><br><br>";
                ?>  
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
                    Imagen para la pregunta: <input type="file" name="fileupload" id="fileupload"> <br><br>
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
