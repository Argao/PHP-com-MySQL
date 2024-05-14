<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título da Página</title>
    <link rel="stylesheet" href="estilos/estilo.css">
    <?php 
        function thumb($arq){
            $caminho = "fotos/$arq";
            if(is_null($arq) || !file_exists($caminho)){
                return "fotos/indisponivel.png";
            }else{
                return $caminho;
            }
        }
    ?>

</head>
<body>
    <?php 
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";

    ?>
    <main id="corpo">
        <h1>Escolha seu jogo</h1>
        <table class="listagem">
            <?php 
                $busca = $banco->query("select * from jogos order by nome");
                if(!$busca){
                    echo "<tr><td>Infelizmente não foi possível realizar a busca";
                }else{
                    if ($busca->num_rows == 0){
                        echo "<tr><td>Nenhum registro encontrado";
                    } else{
                        while ($reg=$busca->fetch_object()) {
                            $t = thumb($reg->capa);
                            echo "<tr><td><img src='$t' class='mini' />";
                            echo "<td><a href='detalhes.php'>$reg->nome</a>";
                            echo "<td>Adm";
                        }
                    }  
                }
            ?>
        </table>
    </main>
    <?php $banco->close();?>
</body>
</html>