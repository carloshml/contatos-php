<?php
    include '../config/banco.php';
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_REQUEST['id'];  
       $pdo = Banco::conectar();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM pessoa where id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       echo '{ "id" : "' .$data['id'] . '",' 
            .'"nome" : "' .$data['nome'] . '",'
            .'"endereco" : "' .$data['endereco']. '",'
            .'"telefone" : "' .$data['telefone']. '",'
            .'"email" : "' .$data['email']. '",'
            .'"sexo" : "'.$data['sexo'].
            '"}';
       Banco::desconectar();
    }
?>

