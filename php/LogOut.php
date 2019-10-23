<?php
  if(isset($_GET["usuario"])){
    header('Location: Layout.php');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../html/Head.html'?>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../styles/personal.css">
    </head>
    <body>
        <?php include '../php/Menus.php' ?>
        <section class="main" id="s1">
            <div>
                <h1>Ha salido de la aplicacion con exito.</h1>
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
