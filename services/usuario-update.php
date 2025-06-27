<?php

require_once __DIR__ . '/../config/banco.php';
$id = null;

if (!empty($_POST)) {
    $nomeError = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;
    $loginError = null;

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $login = $_POST['login'];

    //Validação
    $valido = true;
    if (empty($nome)) {
        $nomeError = 'Por favor digite o nome!';
        $valido = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $valido = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $valido = false;
    }

    if (empty($endereco)) {
        $endereco = 'Por favor digite o endereço!';
        $valido = false;
    }

    if (empty($telefone)) {
        $telefone = 'Por favor digite o telefone!';
        $valido = false;
    }

    if (empty($endereco)) {
        $endereco = 'Por favor preenche o campo!';
        $valido = false;
    }

    if (empty($login)) {
        $loginError = 'Por favor preenche o login!';
        $valido = false;
    }

    // update data
    if ($valido) {
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE pessoa 
                   SET nome = ?, endereco = ?, telefone = ?, email = ?, sexo = ?, login = ? 
                 WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute([$nome, $endereco, $telefone, $email, $sexo, $login, $id]);
            echo json_encode([
                'valido' => true,
                'mensagem' => 'Atualizado com sucesso',
                'id' => $id
            ], JSON_UNESCAPED_UNICODE);
        } catch (PDOException $e) {
            echo json_encode([
                'valido' => false,
                'erro' => true,
                'mensagem' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        } finally {
            Banco::desconectar();
        }
    } else {
        echo json_encode([
            ['valido' => false],
            ['erroNome' => !empty($nomeError), 'motivo' => $nomeError ?? ''],
            ['erroEndereco' => !empty($enderecoErro), 'motivo' => $enderecoErro ?? ''],
            ['erroTelefone' => !empty($telefoneErro), 'motivo' => $telefoneErro ?? ''],
            ['erroEmailTamanho' => !empty($emailErro), 'motivo' => $emailErro ?? ''],
            ['erroEmailValido' => !empty($emailError), 'motivo' => $emailError ?? ''],
            ['erroSexo' => !empty($sexoErro), 'motivo' => $sexoErro ?? ''],
            ['erroLogin' => !empty($loginError), 'motivo' => $loginError ?? '']
        ], JSON_UNESCAPED_UNICODE);
    }

}

?>