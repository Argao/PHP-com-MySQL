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
                    echo msg_sucesso("Dados foram recebidos.");
                }
            }    
        ?>
    </main>
    <?php require_once"rodape.php";?>
</body>
</html>   