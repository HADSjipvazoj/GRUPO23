<?php
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
