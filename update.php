<?php

	require 'banco.php';

	$id = null;	

	if ( !empty($_POST)) {
		$nomeError = null;
		$enderecoErro = null;
		$telefoneErro = null;
        $emailErro = null;
        $sexoErro = null;

        $id = $_POST['id'];
		$nome = $_POST['nome'];
		$endereco = $_POST['endereco'];
		$telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sexo = $_POST['sexo'];

		//Validação
		$valido = true;
		if (empty($nome)){
                    $nomeError = 'Por favor digite o nome!';
                    $valido = false;
        }

		if (empty($email)) {
                    $emailErro = 'Por favor digite o email!';
                    $valido = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
                    $emailErro = 'Por favor digite um email válido!';
                    $valido = false;
		}

		if (empty($endereco))
                {
                    $endereco = 'Por favor digite o endereço!';
                    $valido = false;
		}

                if (empty($telefone))
                {
                    $telefone = 'Por favor digite o telefone!';
                    $valido = false;
		}

                if (empty($endereco))
                {
                    $endereco = 'Por favor preenche o campo!';
                    $valido = false;
		}

		// update data
		if ($valido)   {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE pessoa  set nome = ?, endereco = ?, telefone = ?, email = ?, sexo = ? WHERE id = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome,$endereco,$telefone,$email,$sexo,$id));
                    //Banco::desconectar();
                    // header("Location: index.php");
                    $valido  =  $valido  ? 'true' : 'false';  
                    echo    '[{"valido":'. $valido .'},{"msg":"'. $nome.$endereco.$telefone.$email.$sexo.$id .'"}]';   

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
	}
       
?> 