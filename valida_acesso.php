<?php
    session_start();
    include 'banco.php';
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);
    $pdo = Banco::conectar();
    $sql = "SELECT * FROM pessoa WHERE nome = '$usuario' AND senha = '$senha'";
    $id_usuario = null;
    $nome_usuario = null;
    $email_usuario = null;

    foreach($pdo->query($sql)as $row) { 
        $id_usuario =  $row['id'];
        $nome_usuario =  $row['nome'];
        $email_usuario =  $row['email'];   
    }
    if ( $id_usuario != null){
        // acesso correto do usuario ;
        // criando variáveis globais seesion
        $_SESSION['id_usuario'] = $row['id'];
        $_SESSION['nome_usuario'] = $row['nome'];
        $_SESSION['email_usuario'] = $row['email'];
        header("Location: home.php");
    }else{
        header("Location: index.php?erro=1");
    }
    Banco::desconectar(); 
?>