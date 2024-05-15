<?php 
    $q = "SELECT nome, genero, produtora, descricao, nota, capa FROM jogos WHERE cod = '$cod'";
    $busca = $banco->query($q);
    $reg = $busca->fetch_object();

?>
<h1>Editar Jogo</h1>
<form action="game-edit.php?cod=<?php echo $cod?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><label for="nome">Nome </label></td>
            <td><input type="text" name="nome" id="nome" size="40" maxlength="40" value="<?= $reg->nome?>" required></td>
        </tr>
        <tr>
            <td><label for="genero">Gênero </label></td>
            <td>
                <select name="genero" id="genero" value="<?= $reg->genero?>">
                    <?php 
                        $q = "SELECT cod, genero FROM generos ORDER BY genero";
                        $busca = $banco->query($q);
                        if(!$busca){
                            echo msg_erro('Falha ao acessar o banco!');
                        }else{
                            if($busca->num_rows == 0){
                                echo msg_erro('Nenhum registro encontrado!');
                            }else{
                                while($regGen = $busca->fetch_object()){
                                    echo "<option value='{$regGen->cod}'>{$regGen->genero}</option>";
                                }
                            }
                        }    
                    ?>
                </select>
            </td>

        </tr>
        <tr>
            <td><label for="produtora">Produtora </label></td>
            <td>
                <select name="produtora" id="produtora" value="<?= $reg->produtora?>">
                    <?php 
                        $q = "SELECT cod, produtora FROM produtoras ORDER BY produtora";
                        $busca = $banco->query($q);
                        if(!$busca){
                            echo msg_erro('Falha ao acessar o banco!');
                        }else{
                            if($busca->num_rows == 0){
                                echo msg_erro('Nenhum registro encontrado!');
                            }else{
                                while($regProd = $busca->fetch_object()){
                                    echo "<option value='{$regProd->cod}'>{$regProd->produtora}</option>";
                                }
                            }
                        }    
                    ?>
                </select>
            </td> 
        </tr>

        <tr>
            <td><label for="descricao">Descrição </label></td>
            <td><textarea name="descricao" id="descricao"  cols="50" rows="10" required><?= $reg->descricao?></textarea></td>
        </tr>
        <tr>
            <td><label for="nota">Nota </label></td>
            <td><input type="number" name="nota" id="nota" min="0" max="10" maxlength="10" step="0.5"  value="<?= $reg->nota?>" required></td>
        </tr>
        <tr>
            <td><label for="capa">Capa </label></td>
            <td><input type="file" name="capa" id="capa"> <strong>Para manter a capa atual deixe vazio</strong></td>       
        <tr>
            <td><input type="submit" value="Salvar"></td>
        </tr>       
    </table>
</form>