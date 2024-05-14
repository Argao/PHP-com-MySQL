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
            include_once "topo.php";
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
                        $t = thumb($reg->capa);
                        echo "<tr><td rowspan='3'><img src='$t' class='full'>";
                        echo "<td> <h2>$reg->nome</h2>";
                        echo"Nota: " . number_format($reg->nota,1) ." / 10.0 ";
                        if(is_admin()){
                            echo "
                            <a href='index.php'><span class='material-symbols-outlined'>add_circle</span></a>  
                            <a href='index.php'><span class='material-symbols-outlined'>edit</span></a> 
                            <a href='index.php'><span class='material-symbols-outlined'>delete</span></a>";    
                        }elseif(is_editor()){
                            echo "<a href='index.php'><span class='material-symbols-outlined'>edit</span></a> ";
                        }
                        echo "<tr><td> $reg->descricao";
                        echo "<tr><td>Adm";        
                    }else{
                        echo "<tr><td colspan='2'> $busca->num_rows registros encontrados!";
                    }

                }
            ?>
        </table>
        <?php echo voltar();?>
    </main>
    <?php include_once "rodape.php"?>
</body>
</html>