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
            $volta = 'game-new.php';

            if(!is_admin()){
                echo msg_erro('Você não tem permissão para acessar esta página!');
            }else{

                if(!isset($_POST['genero'])){
                    require "genero-new-form.php";
                }else{
                    $volta = 'genero-new.php';
                    $genero = $_POST['genero'] ?? null;


                    if(validaGenero($genero,$banco)){
                        $q = "INSERT INTO generos (genero) VALUES ('$genero')";
                        if($banco->query($q)){
                            echo msg_sucesso("Gênero $genero cadastrado com sucesso!");
                        }else{
                            echo msg_erro('Não foi possível cadastrar a produtora!');              
                        }    
                    }
                }
            }
            echo voltar($volta);
        ?>
    </main>
    <?php require_once"rodape.php"; ?>
</body>
</html>        