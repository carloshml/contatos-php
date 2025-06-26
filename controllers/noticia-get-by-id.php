<?php
require_once('../DAO/noticia.php');
header('Content-Type: application/json');

if (!empty($_GET['noticia_id'])) {
    $noticiaService = new NoticiaService();
    $noticias = $noticiaService->findById($_GET['noticia_id']);
    if ($noticias) {
        foreach ($noticias as $noticia) {
            $foto = $noticia['foto'];
            if (is_resource($foto)) {
                $foto = stream_get_contents($foto);
            }
            $base64 = base64_encode($foto);

            echo json_encode([
                'success' => true,
                'noticia' => [
                    'titulo' => $noticia['titulo'],
                    'texto' => $noticia['texto'],
                    'tag1' => $noticia['tag1'],
                    'tag2' => $noticia['tag2'],
                    'tag3' => $noticia['tag3'],
                    'foto' => $base64,
                    'noticia_id' => $noticia['noticia_id']
                ]
            ]);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Notícia não encontrada']);
?>