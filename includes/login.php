<?php 
    session_start();

    if(!isset($_SESSION['user'])){    
        $_SESSION['user'] = "";
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

    function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['nome']);
        unset($_SESSION['tipo']);
    }

    function is_logado(){
        return !empty($_SESSION['user']);
    }

    function is_admin(){
        $t = $_SESSION['tipo'] ?? "";
        if(is_null($t)){
            return false;
        }else if($t == "admin"){
            return true;
        }else{
            return false;
        }          
    }

    function is_editor(){
        $t = $_SESSION['tipo'] ?? "";
        if(is_null($t)){
            return false;
        }else if($t == "editor"){
            return true;
        }else{
            return false;
        }  
    }

    // $original = 'teste';
    // echo "$original --- ";
    // echo cripto($original)." --- ";
    // echo gerarHash($original);
  
