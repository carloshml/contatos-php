<?php
session_start();
require_once('../config/banco.php');


$login = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';



$db = new Banco();
$pdo = $db->conectar();


try {
    $senha_md5 = md5($senha);
    $stmt = $pdo->prepare("SELECT id, nome, email FROM pessoa WHERE login = :login AND senha = :senha");
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha_md5, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuario) {
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nome_usuario'] = $usuario['nome'];
        $_SESSION['email_usuario'] = $usuario['email'];
        header('Location: ../views/home.php');
    } else {
        header('Location: ../index.php?erro=1');
    }


} catch (PDOException $e) {
    echo 'Erro ao tentar logar: ' . htmlspecialchars($e->getMessage());
}

Banco::desconectar();
?>