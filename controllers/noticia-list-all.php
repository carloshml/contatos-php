<?php
require_once('../DAO/noticia.php');
function fetchNoticias()
{
    try {
        $noticiaService = new NoticiaService();
        return $noticiaService->getAllNoticia();
    } catch (PDOException $e) {
        return [];
    }
}
?>