<div id='page-wrap'>
<header class='main' id='h1'>
    <span class="right"><a href="SignUp.php">Registro</a></span>
    <span class="right"><a href="LogIn.php">Login</a></span>
    <span class="right"><a href="LogOut.php">Logout</a></span>
    <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
    <span>
        <?php
            if(isset($_GET["usuario"])){
                echo $_GET["usuario"];
            }
        ?>
    </span>
</header>

<nav class='main' id='n1' role='navigation'>
    <?php
        if(isset($_GET["usuario"])){
            echo "<span><a href='Layout.php?usuario=".$_REQUEST["usuario"]."'>Inicio</a></span>";
            echo "<span><a href='QuestionFormWithImage.php?usuario=".$_REQUEST["usuario"]."'>Insertar Pregunta</a></span>";
            echo "<span><a href='ShowQuestionsWithImage.php?usuario=".$_REQUEST["usuario"]."'>Mostrar Preguntas</a></span>";
            echo "<span><a href='Credits.php?usuario=".$_REQUEST["usuario"]."' >Creditos</a></span>";
        }else{
            echo"    <span><a href='Layout.php'>Inicio</a></span>
            <span><a href='QuestionFormWithImage.php'>Insertar Pregunta</a></span>
            <span><a href='ShowQuestionsWithImage.php'>Mostrar Preguntas</a></span>
            <span><a href='Credits.php'>Creditos</a></span>";
        }
    ?>

</nav>
