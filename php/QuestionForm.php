<!DOCTYPE html>
<html>
    <head>
        <?php include '../html/Head.html'?>
    </head>
    <body>
        <?php include '../php/Menus.php' ?>
        <section class="main" id="s1">
            <div>
                <form action = "" name = "formulario" id = "formulario" onsubmit = "return validate();">
                    Marque el tipo de usuario <br>
                    <input type="radio" name="user" id="user" value="alumno" checked>Alumno<br>
                    <input type="radio" name="user" id="user" value="profesor">Profesor<br>
                    Dirección de correo: <input type="text" id= "email" name="email"><br>
                    Enunciado de la pregunta: <input type="text" id= "enunciado" name="enunciado"><br>
                    Respuesta Correcta: <input type="text" id= "correcta" name="correcta"><br>
                    Respuesta Incorrecta 1: <input type="text" id= "incorrecta1" name="incorrecta1"><br>
                    Respuesta Incorrecta 2: <input type="text" id= "incorrecta2" name="incorrecta2"><br>
                    Respuesta Incorrecta 3: <input type="text" id= "incorrecta3" name="incorrecta3"><br>
                    <input type="radio" name="user" id="user" value="alumno" checked> Facil 
                    <input type="radio" name="user" id="user" value="profesor"> Medio 
                    <input type="radio" name="user" id="user" value="alumno"> Dificil <br>
                    Tema de la pregunta: <input type="text" id= "tema" name="tema"><br>
                    <button type="submit">Enviar</button>
                    <button type="reset">Reiniciar</button>
                </form>
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
