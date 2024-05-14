<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título da Página</title>
    <link rel="stylesheet" href="estilos/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>

        #corpo{
            width: 300px;
            font-size: 13pt;
        }
        td{
            padding: 6px;
        }
    </style>
</head>
<body>
    <?php 
        require_once "includes/login.php";
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
    ?>
    <main id="corpo">
        <?php 
            $u = $_POST['usuario'] ?? null;
            $s = $_POST['senha'] ?? null;

            if(is_null($u) || is_null($s)){
                require "user-login-form.php";
            }else{
                $q = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$u' LIMIT 1";
                $busca = $banco->query($q);
                if(!$busca){
                    echo msg_erro('Falha ao acessar o banco!');
                }else{
                    if($busca->num_rows == 0){
                        echo msg_erro("Usuário não encontrado!");
                    }else{    
                        $reg = $busca->fetch_object();
                        if(testarHash($s, $reg->senha)){
                            echo msg_sucesso("Logado com sucesso!");
                            $_SESSION['user'] = $reg->usuario;
                            $_SESSION['nome'] = $reg->nome;
                            $_SESSION['tipo'] = $reg->tipo;
                        }else{
                            echo msg_erro("Senha inválida!");
                        }
                    }
                }
            }
            echo voltar();
            $banco->close();
        ?>
        
    </main>
</body>
</html>        