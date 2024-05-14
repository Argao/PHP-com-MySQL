<?php 
    function gerarHash($senha){
        return password_hash(cripto($senha),PASSWORD_DEFAULT);
    }
    function testarHash($senha, $hash){
        return password_verify(cripto($senha),$hash);
    }

    function cripto($senha){
        $c = '';
        for ($i=0; $i < strlen($senha); $i++) { 
            $letra = ord($senha[$i]) + 1;
            $c .= chr($letra);
        }
        return $c;
    }

    $original = 'estudonauta';
    echo "$original --- ";
    echo cripto($original)." --- ";
    echo gerarHash($original);
    echo testarHash($original,'$2y$10$1Jq3y4iGY1e21kl86Q/fdeHloQiAFzjVyuOPmTfTHDVL41drjRycS')?"SIM": "NAO";
?>
