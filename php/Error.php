<?php
    /*  Esta función la empleamos en diversos ficheros de la aplicación.
        Se encarga de poner el mensaje de error, darte un enlace para volver a la página anterior
        cerrar todas las etiquetas restantes.        
       */
    function error_mensaje($mensaje) {
        echo  $mensaje.'<br>';
        echo 'Volver <a href="javascript:window.history.back()">atrás</a>.';
        echo "</div>
            </section>";
        include '../html/Footer.html';
        echo"</body>
            </html>";
        exit;
    }
?>
