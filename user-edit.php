<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de dados do Usuário</title>
    <link rel="stylesheet" href="estilos/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
    <?php 
        require_once "includes/login.php";
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
    ?>
    <main id="corpo">
        <?php 
            if(!is_logado()){
                echo msg_erro("Efetue o <a href='user-login.php'>login</a> para acessar o sistema.");
            }else{
                if(!isset($_POST['usuario'])){
                    include "user-edit-form.php";
                }else{
                    $usuario = $_POST['usuario'] ?? null;
                    $nome = $_POST['nome'] ?? null;
                    $senha1 = $_POST['senha1'] ?? null;
                    $senha2 = $_POST['senha2'] ?? null;
                    $tipo = $_POST['tipo'] ?? null;

                    $q = "UPDATE usuarios SET  usuario = '$usuario', nome = '$nome', tipo = '$tipo' ";

                    if(empty($senha1) && empty($senha2)){
                        echo msg_aviso("Senha foi mantida");
                    }else{
                        if(validaSenha($senha1,$senha2)){
                            $senha = gerarHash($senha1);
                            $q .= ", senha = '$senha' ";
                        }else{
                            echo msg_aviso("A senha anterior sera mantida");
                        }

                    }       
                    $q .= " WHERE usuario = '" . $_SESSION['user'] . "'";
                    if($banco->query($q)){
                        echo msg_sucesso("Dados alterados com sucesso!");
                        logout();
                        echo msg_aviso("Por segurança faça o <a href='user-login.php'>login</a> novamente.");
                    }else{
                        echo msg_erro("Não foi possível alterar os dados!");
                    }   
                }    
            }  
        ?>
        <?php echo voltar('index.php');?>
    </main>
    <?php require_once"rodape.php";?>
</body>
</html>   