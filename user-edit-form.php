<?php 
    $q = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '" . $_SESSION['user'] . "'";
    $busca = $banco->query($q);
    $reg = $busca->fetch_object();
?>

<h1>Alteração de Dados</h1>
<form action="user-edit.php" method="post">
    <table>
        <tr>
            <td><label for="usuario">Usuário </label></td>
            <td><input type="text" name="usuario" id="usuario" maxlength="10" size="10" readonly value="<?php echo $reg->usuario; ?>"></td>
        </tr>
        <tr>
            <td><label for="nome">Nome </label></td>
            <td><input type="text" name="nome" id="nome" maxlength="30" size="30" value="<?php echo $reg->nome; ?>"></td>
        </tr>
        <tr>
            <td><label for="tipo">Tipo </label></td>
            <td><input type="text" name="tipo" id="tipo" readonly value="<?php echo $reg->tipo; ?>"></td>
        </tr>
        <tr>
            <td><label for="senha1">Senha </label></td>
            <td><input type="password" name="senha1" id="senha1" maxlength="10" size="10"></td>
        </tr>
        <tr>
            <td><label for="senha2">Confirme a senha </label></td>
            <td><input type="password" name="senha2" id="senha2" maxlength="10" size="10"></td>
        </tr>
        <tr>
            <td><input type="submit" value="salvar"></td>
        </tr>
    </table>
</form>