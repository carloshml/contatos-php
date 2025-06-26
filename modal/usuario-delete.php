<?php
require_once __DIR__ . '/../DAO/usuarios.php';
require_once __DIR__ . '/../DAO/noticia.php';

$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];


    $noticiaService = new NoticiaService();
    $noticiaQTD = (int) $noticiaService->findByIdUsuario($id);


    if ($noticiaQTD == 0) {
        $usuarioService = new UsuarioService();
        $usuarioService->deleteById($id);
    } else {
        echo 'Usuáro tem noticias associadas!';
    }
}
?>