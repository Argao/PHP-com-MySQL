<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título da Página</title>
    <link rel="stylesheet" href="estilos/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <?php
        require_once "includes/login.php";
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        $cod = $_GET['cod'] ?? 0;
        ?>
    <main id="corpo">
        
        <?php
        $volta = 'index.php';
        if (!is_admin()) {
            echo msg_erro('Você não tem permissão para acessar esta página!');
        } else {
            $capa = $banco->query("SELECT capa FROM jogos WHERE cod = $cod")->fetch_object()->capa;
            
            
            if(!isset($_POST['confirmacao'])){
                require "game-delete-form.php";
            }else{

                $confirmacao = $_POST['confirmacao'] ?? null;
                if($confirmacao == "Sim"){
                    $q = "DELETE FROM jogos WHERE cod = '$cod'";
                    if($banco->query($q)){
                        echo msg_sucesso("Jogo deletado com sucesso!");
                        if($capa != ""){
                            unlink("fotos/$capa");
                            echo msg_sucesso("Imagem de capa excluída com sucesso!");
                        }
                    }else{
                        echo msg_erro("Não foi possível deletar o jogo!");
                    }
                }
            }
            
        }
        echo voltar($volta);
        ?>
    </main>
    <?php require_once "rodape.php"; ?>
</body>

</html>