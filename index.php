<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título da Página</title>
    <link rel="stylesheet" href="estilos/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>


</head>
<body>
    <?php 
        require_once "includes/login.php";
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        $ordem = $_GET['o'] ?? "n";
        $chave = $_GET['c'] ?? "";
    ?>
    <main id="corpo">
        <?php include_once "topo.php"?>
        <h1>Escolha seu jogo</h1>
        <form action="index.php" method="get" id="busca" autocomplete="on">
            Ordenar:
            <a href="index.php?o=n&c=<?php echo $chave;?>">Nome |</a>
            <a href="index.php?o=p&c=<?php echo $chave;?>">Produtora |</a>
            <a href="index.php?o=n1&c=<?php echo $chave;?>">Nota Alta |</a>
            <a href="index.php?o=n2&c=<?php echo $chave;?>">Nota Baixa | </a>
            <a href="index.php">Mostrar Todos |</a>
            <label for="c">Buscar:</label>
            <input type="text" name="c" id="c" seize="10" maxlength="40" value="<?php echo $chave;?>" autocomplete="on"> 
            <input type="submit" value="Ok">
        </form>
        <table class="listagem">
            <?php 
            $q = "select j.cod, j.nome, g.genero, p.produtora, j.capa from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";

            if (!empty($chave)){
                $q .= "where j.nome like '%$chave%' or p.produtora like '%$chave%' or g.genero like '%$chave%' ";
            }

            switch ($ordem) {
                case "p":
                    $q .= "order by p.produtora";
                    break;
                case "n1":
                    $q .= "order by j.nota desc";
                    break;
                case "n2":
                    $q .= "order by j.nota";
                    break;
                default:
                    $q .= "order by j.nome";
                    break;
            }

                $busca = $banco->query($q);
                if(!$busca){
                    echo "<tr><td>Infelizmente não foi possível realizar a busca";
                }else{
                    if ($busca->num_rows == 0){
                        echo "<tr><td>Nenhum registro encontrado";
                    } else{
                        while ($reg=$busca->fetch_object()) {
                            $t = thumb($reg->capa);
                            echo "<tr><td><img src='$t' class='mini' />";
                            echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                            echo "[$reg->genero]";
                            echo "<br/>$reg->produtora";
                            if(is_admin()){
                                echo "<td>
                                <a href='index.php'><span class='material-symbols-outlined'>add_circle</span></a>  
                                <a href='index.php'><span class='material-symbols-outlined'>edit</span></a> 
                                <a href='index.php'><span class='material-symbols-outlined'>delete</span></a>";    
                            }elseif(is_editor()){
                                echo "<td><a href='index.php'><span class='material-symbols-outlined'>edit</span></a> ";
                            }
                        }
                    }  
                }
            ?>
        </table>
    </main>
    <?php include_once "rodape.php"?>
</body>
</html>