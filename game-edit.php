<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Jogo</title>
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
            if(!is_logado()){
                echo msg_erro("Efetue o <a href='user-login.php'>login</a> para acessar o sistema.");
            }else{
                if(!isset($_POST['nome'])){
                    include "game-edit-form.php";
                }else{
                    $nome = $_POST['nome'] ?? null;
                    $descricao = $_POST['descricao'] ?? null;
                    $genero = $_POST['genero'] ?? null;
                    $produtora = $_POST['produtora'] ?? null;
                    $nota = $_POST['nota'] ?? null;
                    $capa = $_FILES['capa']['name'] ?? null;
                    $capaAntiga = $banco->query("SELECT capa FROM jogos WHERE cod = $cod")->fetch_object()->capa;


                    $q = "UPDATE jogos SET nome = '$nome', descricao = '$descricao', genero = $genero, produtora = $produtora, nota = $nota";
                    
                    if($capa != ""){   
                        $q .= ", capa = '$capa' ";
                    }
                 
                    $q .= " WHERE cod = $cod";

                    if($capa == ""){
                        if($banco->query($q)){
                            echo msg_sucesso("Jogo alterado com sucesso!");
                        }else{
                            echo msg_erro("Não foi possível alterar o jogo!");
                        }
                    }else{
                        if(validaImagem()){
                            if($banco->query($q)){
                                echo msg_sucesso("Jogo alterado com sucesso!");
                                echo 'entrou';
                                $target_dir = "fotos/";
                                $target_file = $target_dir . basename($_FILES["capa"]["name"]);
                                if (move_uploaded_file($_FILES["capa"]["tmp_name"], $target_file)) {
                                    echo msg_sucesso("Imagem de capa salva com sucesso!");
                                    if($capaAntiga != ""){
                                        unlink("fotos/$capaAntiga");
                                        echo msg_sucesso("Imagem de capa antiga excluída com sucesso!");
                                    }
                                } else {
                                    echo msg_erro("Erro ao salvar a imagem de capa!");
                                }
                                echo 'entro2';
                            }else{
                                echo msg_erro("Não foi possível alterar o jogo!");
                            }    
                        }
                    }



                }    
            }  
        ?>
        <?php echo voltar('index.php');?>
    </main>
    <?php require_once"rodape.php";?>
</body>
</html>   