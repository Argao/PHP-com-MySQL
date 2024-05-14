<h1>Novo usuário</h1>
<form action="user-new.php" method="post">
    <table>
        <tr>
            <td><label for="usuario">Usuário </label></td>
            <td><input type="text" name="usuario" id="usuario" size="10" maxlength="10" required></td>
        </tr>
        <tr>
            <td><label for="nome">Nome </label></td>
            <td><input type="text" name="nome" id="nome" size="30" maxlength="30" required></td>
        </tr>
        <tr>
            <td><label for="tipo">Tipo </label></td>
            <td>
                <select name="tipo" id="tipo">
                    <option value="admin">Administrador do Sistema</option>
                    <option value="editor" selected>Editor Autorizado</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="senha">Senha </label></td>
            <td><input type="password" name="senha1" id="senha1" size="10" maxlength="10" required></td>
        </tr>
        <td><label for="senha">Senha </label></td>
            <td><input type="password" name="senha2" id="senha2" size="10" maxlength="10" required></td>
        </tr> 
        <tr>
            <td><input type="submit" value="Salvar"></td>
        </tr>       
    </table>
</form>