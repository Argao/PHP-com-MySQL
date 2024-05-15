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
        if (!is_admin()) {
            echo msg_erro('Você não tem permissão para acessar esta página!');
        } else {
            if (!isset($_POST['nome'])) {
                require "game-new-form.php";
            } else {

                $target_dir = "fotos/";
                $target_file = $target_dir . basename($_FILES["capa"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image

                $check = getimagesize($_FILES["capa"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo msg_erro("O arquivo não é uma imagem válida.");
                    $uploadOk = 0;
                }
                

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo msg_erro("O arquivo já existe.");
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["capa"]["size"] > 500000) {
                    echo msg_erro("O arquivo é muito grande.");
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {

                    echo msg_erro("Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.");
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo msg_erro("O arquivo não foi enviado.");
                    // if everything is ok, try to upload file
                } else {
                    
                    if (move_uploaded_file($_FILES["capa"]["tmp_name"], $target_file)) {
                        $nome = $_POST['nome'];
                        $descricao = $_POST['descricao'];
                        $genero = $_POST['genero'];
                        $produtora = $_POST['produtora'];
                        $nota = $_POST['nota'];
                        $capa = basename($_FILES["capa"]["name"]);
                        $sql = "INSERT INTO jogos (nome, descricao, genero, capa, produtora, nota ) VALUES ('$nome','$descricao','$genero','$capa','$produtora','$nota')";
                        $banco->query($sql);
                        echo msg_sucesso("Jogo cadastrado com sucesso!");

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                    
                }
            }
        }
        echo voltar();
        ?>
    </main>
    <?php require_once "rodape.php"; ?>
</body>

</html>