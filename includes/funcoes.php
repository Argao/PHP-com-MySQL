<?php 
        function thumb($arq){
            $caminho = "fotos/$arq";
            if(is_null($arq) || !file_exists($caminho)){
                return "fotos/indisponivel.png";
            }else{
                return $caminho;
            }
        }

        function voltar(){
            return "<a href='index.php'><span class='material-symbols-outlined'>arrow_back</span></a>";
        }

        function msg_sucesso($m){
            $resp = "<div class='sucesso msg'><span class='material-symbols-outlined'>check_circle</span>$m</div>";
            return $resp;
        }
        function msg_erro($m){
            $resp = "<div class='erro msg'><span class='material-symbols-outlined'>error</span>$m</div>";
            return $resp;
        }
        function msg_aviso($m){
            $resp = "<div class='aviso msg'><span class='material-symbols-outlined'>info</span>$m</div>";
            return $resp;
        }

        function validaNovoUsuario($user,$nome,$senha1,$senha2,$tipo,$banco){
            if(validaNome($nome) && validaTipo($tipo) && validaUser($user,$banco) && validaSenha($senha1,$senha2)){
                return true;
            }else{
                return false;
            }    
        }
    

        function validaNome($nome){
            if(strlen($nome) > 30){
                echo msg_erro('O nome deve ter no máximo 30 caracteres!');
                return false;
            }elseif(strlen($nome) < 1){
                echo msg_erro('O nome não pode ser vazio!');
                return false;
            }
            return true;
        }
        function validaTipo($tipo){
            if($tipo != "admin" && $tipo != "editor"){
                echo msg_erro('Tipo de usuário inválido!');
                return false;
            }
            return true;
        }

        function validaUser($user,$banco){
            if(strlen($user) > 10){
                echo msg_erro('O usuário deve ter no máximo 10 caracteres!');
                return false;
            }elseif(strlen($user) < 1){
                echo msg_erro('O usuário não pode ser vazio!');
                return false;
            }
            
            if(!procuraUserNoBanco($user,$banco)){
                echo msg_erro('Usuário já cadastrado!');
                return false;
            }
            return true;
        }
    
        function procuraUserNoBanco($user, $banco){
            $q = "SELECT * FROM usuarios WHERE usuario = '$user'";
            $busca = $banco->query($q);
            if(!$busca){
                return false;
            }
            if($busca->num_rows > 0){
                return false;
            }
            return true;
        }
    
        function validaSenha($senha1,$senha2){
            $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,10}$/';
            
            if(!($senha1 === $senha2)){
                echo msg_erro('As senhas não conferem!');
                return false;
            }elseif(!preg_match($regex,$senha1)){
                echo msg_erro('A senha deve ter entre 6 e 10 caracteres, com pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial!');
                return false;
            }else{
                return true;
            }
        }


        function validaImagem(){
            echo "entrou";
            $target_dir = "fotos/";
            $target_file = $target_dir . basename($_FILES["capa"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if (verificaSeImagemEhValida() && verificaOFormatoDoArquivo($imageFileType) && verificaOTamanhoDoArquivo() && verificaSeArquivoJaExiste($target_file)) {
                return true;
            } else {
                return false;
            }
        }
        
        
        function verificaSeImagemEhValida(){
            $check = getimagesize($_FILES["capa"]["tmp_name"]);
            if ($check !== false) {
                return true;
            } else {
                echo msg_erro("O arquivo não é uma imagem válida.");
                return false;
            }
        }

        function verificaSeArquivoJaExiste($target_file){
            if (file_exists($target_file)) {
                echo msg_erro("O arquivo já existe.");
                return false;
            }
            return true;
        }

        function verificaOTamanhoDoArquivo(){
            if ($_FILES["capa"]["size"] > 512000) {//500kb
                echo msg_erro("O arquivo é muito grande deve ter no máximo 500kb.");
                return false;
            } 
            return true;
        }

        function verificaOFormatoDoArquivo($imageFileType){
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif") {
                echo msg_erro("Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.");
                return false;
            }
            return true;
        }








        
