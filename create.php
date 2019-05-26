<?php
    require 'banco.php';

    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $nomeError = null;
        $enderecoErro = null;
        $telefoneErro = null;
        $emailErro = null;      
        $sexoErro = null;

        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sexo = $_POST['sexo'];

        //Validaçao dos campos:
        $valido = true;
        if(empty($nome))
        {
            $nomeError = 'Por favor digite o seu nome!';
            $valido = false;
        }

        if(empty($endereco))
        {
            $enderecoErro = 'Por favor digite o seu endereço!';
            $valido = false;
        }

        if(empty($telefone))
        {
            $telefoneErro = 'Por favor digite o número do telefone!';
            $valido = false;
        }

        if(empty($email))
        {
            $emailErro = 'Por favor digite o endereço de email';
            $valido = false;
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL))        {   
            $emailError = 'Por favor digite um endereço de email válido!';
            $valido = false;
          
        }

        if(empty($sexo))
        {
            $sexoErro = 'Por favor digite esse campo!';
            $valido = false;
        }

        //Inserindo no Banco:
        if($valido)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO pessoa (nome, endereco, telefone, email, sexo) VALUES(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$endereco,$telefone,$email,$sexo));        
            Banco::desconectar();
            // header("Location: index.php");    
            $valido  =  $valido  ? 'true' : 'false';  
            echo    '[{"valido":'. $valido .'}]';    
           
        }else{  
            $valido  =  $valido  ? 'true' : 'false';     
            $temErroNome   =  $nomeError  ? 'true' : 'false';        
            $temErroEndereco   =  $enderecoErro ? 'true' : 'false';
            $temErroTelefone   =  $telefoneErro  ? 'true' : 'false';
            $temErroEmailTamanho   =  $emailErro  ? 'true' : 'false';
            $temErroEmailValidade  =  $emailError ? 'true' : 'false';
            $temErroSexo   =  $sexoErro ? 'true' : 'false'; 
            echo    '['
                    .'{"valido":'. $valido .'},'                                   
                    .'{"temErro":' . $temErroNome .', "motivo":"' . $nomeError ,'"},'  
                    .'{"temErro":' . $temErroEndereco .',"motivo":"' . $enderecoErro ,'"},'  
                    .'{"temErro":' . $temErroTelefone .',"motivo":"' . $telefoneErro ,'"},'  
                    .'{"temErro":' . $temErroEmailTamanho .',"motivo":"' . $emailErro ,'"},'  
                    .'{"temErro":' . $temErroEmailValidade .',"motivo":"' . $emailError ,'"},'
                    .'{"temErro":' . $temErroSexo .',"motivo":"' . $sexoErro ,'"}'   
                    . ']';
        }
    }else{
        echo  'método POST vazio';
    }
?>
