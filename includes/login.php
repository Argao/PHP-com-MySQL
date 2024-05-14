<?php 
    session_start();

    if(!isset($_SESSION['user'])){    
        $_SESSION['user'] = "gustavo";
        $_SESSION['nome'] = "";
        $_SESSION['tipo'] = "";
    }

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

    // $original = 'teste';
    // echo "$original --- ";
    // echo cripto($original)." --- ";
    // echo gerarHash($original);
  
