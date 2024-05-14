<?php 
    echo "<footer>";
    echo "<p> Acessado por ".$_SERVER['REMOTE_ADDR']." em ".date('d/m/Y')."</p>";
    echo "<p>Desenvolvido por João Gabriel Aragão &copy; 2024<p>";
    echo "</footer>";
    $banco->close();
?>