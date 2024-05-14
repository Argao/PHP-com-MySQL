
<h1>Login</h1>
<form action="user-login.php" method="post">
    <table >
        <tr>
            <td><label for="usuario">Usuário: </label></td>
            <td><input auto type="text" name="usuario" id="usuario" autocomplete="username" size = '10' maxlength="10" required></td>
        </tr>
        <tr>
            <td><label for="senha">Senha: </label></td>
            <td><input type="password" name="senha" id="senha" autocomplete="current-password" size="10" maxlength="10"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Entrar"></td>
        </tr>    
    </table>
</form>