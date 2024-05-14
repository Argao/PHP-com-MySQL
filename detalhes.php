<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título da Página</title>
    <link rel="stylesheet" href="estilos/estilo.css">
    <?php 
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
    ?>
</head>
<body>
    <main id="corpo">
        <?php 
            $cod = $_GET['cod'] ?? 0;
            $busca = $banco->query("select * from jogos where cod = '$cod'");
        ?>
        <h1>Detalhes do jogo</h1>

        <table class='detalhes'>
            <?php 
                if(!$busca){
                    echo "<tr><td>Infelizmente não foi possível realizar a busca! $banco->error";
                }else{
                    if($busca->num_rows == 1 ){
                        $reg = $busca->fetch_object();
    
                        echo "<tr><td rowspan='3'><img src='fotos/$reg->capa' >";
                        echo "<td> <h2>$reg->nome</h2>";
                        echo "<tr><td> $reg->descricao";
                        echo "<tr><td>Adm";        
                    }else{
                        echo "<tr><td colspan='2'> $busca->num_rows registros encontrados!";
                    }

                }
            ?>
        </table>
    </main>
</body>
</html>