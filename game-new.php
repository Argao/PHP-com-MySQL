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
    ?>
    <main id="corpo">

        <?php
        $volta = 'index.php';
        if (!is_admin()) {
            echo msg_erro('Você não tem permissão para acessar esta página!');
        } else {
            if (!isset($_POST['nome'])) {
                require "game-new-form.php";
            } else {
                $volta = 'game-new.php';
                $nome = $_POST['nome'] ?? null;
                $descricao = $_POST['descricao'] ?? null;
                $genero = $_POST['genero'] ?? null;
                $produtora = $_POST['produtora'] ?? null;
                $nota = $_POST['nota'] ?? null;
                $capa = $_FILES['capa']['name'] ?? null;

                $q = "INSERT INTO jogos (nome, descricao, genero, produtora, nota, capa) VALUES ('$nome','$descricao','$genero','$produtora','$nota','$capa')";

                if ($capa == "" || validaImagem()) {
                    if ($banco->query($q)) {
                        echo msg_sucesso("Jogo cadastrado com sucesso!");
                        if (!$capa == "") {
                            $target_dir = "fotos/";
                            $target_file = $target_dir . basename($_FILES["capa"]["name"]);
                            if (move_uploaded_file($_FILES["capa"]["tmp_name"], $target_file)) {
                                echo msg_sucesso("Imagem de capa salva com sucesso!");
                            } else {
                                echo msg_erro("Erro ao salvar a imagem de capa!");
                            }
                        }
                    } else {
                        echo msg_erro('Não foi possível cadastrar o jogo!');
                    }
                }else{
                    echo msg_erro('Imagem inválida!');
                }

            }
        }
        echo voltar($volta);
        ?>
    </main>
    <?php require_once "rodape.php"; ?>
</body>

</html>