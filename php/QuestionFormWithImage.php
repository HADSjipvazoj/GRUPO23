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
                    // Introducir el email del usuario registrado en la URL a la que mandar los resultados del formulario.
                    echo "<form action = 'AddQuestionWithImage.php?usuario=".$_GET["usuario"]."' name = 'formulario' id = 'formulario' method = 'POST' enctype='multipart/form-data'>";
                ?>
                    Marque el tipo de usuario <br>
                <?php
                    // No permitir que tampoco pueda modificar el tipo de usuario una vez se haya loggeado.
                    $pattern = '/^([a-z]|[A-Z])+[0-9]{3}@ikasle\.ehu\.(es|eus)$/';
                    if(preg_match($pattern, $_GET['usuario'])){
                        echo '<input type="radio" name="user" id="user1" value="Alumno" checked readonly>Alumno<br>';
                        echo '<input type="radio" name="user" id="user2" value="Profesor" disabled readonly>Profesor<br><br>';
                    }else{
                      echo '<input type="radio" name="user" id="user1" value="Alumno" disabled readonly>Alumno<br>';
                      echo '<input type="radio" name="user" id="user2" value="Profesor" checked readonly>Profesor<br><br>';
                    }

                    echo"Dirección de correo: <input type='text' id= 'email' name='email' value = '".$_GET["usuario"]."' readonly><br><br>";
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
