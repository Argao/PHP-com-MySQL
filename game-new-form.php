<h1>Novo Jogo</h1>
<form action="game-new.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><label for="nome">Nome </label></td>
            <td><input type="text" name="nome" id="nome" size="40" maxlength="40" required></td>
        </tr>
        <tr>
            <td><label for="genero">Gênero </label></td>
            <td>
                <select name="genero" id="genero">
                    <?php 
                        $q = "SELECT cod, genero FROM generos ORDER BY genero";
                        $busca = $banco->query($q);
                        if(!$busca){
                            echo msg_erro('Falha ao acessar o banco!');
                        }else{
                            if($busca->num_rows == 0){
                                echo msg_erro('Nenhum registro encontrado!');
                            }else{
                                while($reg = $busca->fetch_object()){
                                    echo "<option value='{$reg->cod}'>{$reg->genero}</option>";
                                }
                            }
                        }    
                    ?>
                </select>
                <a href="genero-new.php">Novo Gênero</a>
            </td>

        </tr>
        <tr>
            <td><label for="produtora">Produtora </label></td>
            <td>
                <select name="produtora" id="produtora">
                    <?php 
                        $q = "SELECT cod, produtora FROM produtoras ORDER BY produtora";
                        $busca = $banco->query($q);
                        if(!$busca){
                            echo msg_erro('Falha ao acessar o banco!');
                        }else{
                            if($busca->num_rows == 0){
                                echo msg_erro('Nenhum registro encontrado!');
                            }else{
                                while($reg = $busca->fetch_object()){
                                    echo "<option value='{$reg->cod}'>{$reg->produtora}</option>";
                                }
                            }
                        }    
                    ?>
                </select>
                <a href="produtora-new.php">Nova Produtora</a>
            </td> 

            
        </tr>

        <tr>
            <td><label for="descricao">Descrição </label></td>
            <td><textarea name="descricao" id="descricao" cols="30" rows="10" required></textarea></td>
        </tr>
        <tr>
            <td><label for="nota">Nota </label></td>
            <td><input type="number" name="nota" id="nota" min="0" max="10" maxlength="10" step="0.5"  required></td>
        </tr>
        <tr>
            <td><label for="capa">Capa </label></td>
            <td><input type="file" name="capa" id="capa"></td>       
        <tr>
            <td><input type="submit" value="Salvar"></td>
        </tr>       
    </table>
</form>