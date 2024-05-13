<?php 
    $banco = new mysqli("localhot", "root", "", "db_games");
    if($banco->connect_errno){
        echo "<p> Encontrei um erro $banco->errno --> $banco->connect_error</p>";
        die();
    }
?>