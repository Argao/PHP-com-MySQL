<?php 
        $q = "SELECT * FROM jogos WHERE cod = '$cod'";
        $busca = $banco->query($q);
        $reg = $busca->fetch_object();
?>
<form action="game-delete.php?cod=<?php echo $cod?>" method="post">
    <table>
        <tr>
            <td>Tem certeza que deseja deletar o jogo <strong><?php echo $reg->nome?></strong>?</td>
            <td><input type="submit" name="confirmacao" value="Sim"></td>
            <td><input type="submit" name="confirmacao"  value="Não"></td>
        </tr>  
    </table>
</form>