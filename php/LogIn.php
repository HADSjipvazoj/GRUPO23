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
                <form action = "AddQuestionWithImage.php" name = "formulario" id = "formulario" method = "POST" enctype="multipart/form-data">
                    Pantalla de login.
                </form>
            </div>
        </section>
        <?php include '../html/Footer.html' ?>
    </body>
</html>
