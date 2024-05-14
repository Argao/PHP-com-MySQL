<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar novo usuário</title>
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

            if(!is_admin()){

                echo msg_erro('Você não tem permissão para acessar esta página!');
            }else{

                if(!isset($_POST['usuario'])){

                    require "user-new-form.php";
                }else{
                    $usuario = $_POST['usuario'] ?? null;
                    $nome = $_POST['nome'] ?? null;
                    $senha1 = $_POST['senha1'] ?? null;
                    $senha2 = $_POST['senha2'] ?? null;
                    $tipo = $_POST['tipo'] ?? null;
                    
                    if(validaNovoUsuario($usuario,$nome,$senha1,$senha2,$tipo,$banco)){
                        echo "Tudo certo";
                    }else{
                        echo "Algo deu errado";
                    }
                }                
            }
            echo voltar();
            $banco->close();
        ?>
    </main>
    <
</body>
</html>        