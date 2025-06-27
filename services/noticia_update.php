<?php
session_start();
require_once __DIR__ . '/../config/banco.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php?erro=2");
    exit;
}

$id_autor = $_SESSION['id_usuario'];
$noticia_id = $_POST['noticia_id'] ?? null;
$titulo = $_POST['titulo'] ?? '';
$texto = $_POST['texto'] ?? '';
$tag1 = $_POST['tag1'] ?? '';
$tag2 = $_POST['tag2'] ?? '';
$tag3 = $_POST['tag3'] ?? '';

// Validações básicas
$erros = [];
if (empty($titulo))
    $erros[] = "Título é obrigatório.";
if (empty($texto))
    $erros[] = "Texto é obrigatório.";
if (strlen($texto) < 60)
    $erros[] = "O texto deve conter pelo menos 60 caracteres.";
if (empty($tag1) && empty($tag2) && empty($tag3))
    $erros[] = "Pelo menos uma tag deve ser preenchida.";

if ($noticia_id === null) {
    $erros[] = "ID da notícia não foi informado.";
}

if (!empty($erros)) {
    $params = http_build_query([
        'erro' => implode(" | ", $erros),
        'sucesso' => 0,
        'teste' => json_encode($_POST)
    ]);
    header("Location: ../views/escrever_noticia.php?$params");
    exit;
}

$imagem = $_FILES['imagem'];
// Atualização no banco
try {

    if ($imagem['type'] != NULL) {
        $fileHandle = fopen($_FILES['imagem']['tmp_name'], "rb") or die("Unable to open file!");
    } else {
        echo ' sem imagem ';
    }

    $pdo = Banco::conectar();
    $sql = "UPDATE noticia SET
                titulo = :titulo,
                texto = :texto,
                tag1 = :tag1,
                tag2 = :tag2,
                tag3 = :tag3,
                id_autor = :id_autor,                
                data_criacao = :data_criacao";

    if ($fileHandle !== null) {
        $sql .= ", foto = :foto  ";
    }

    $sql .= " WHERE id = :noticia_id";


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":titulo", $titulo);
    $stmt->bindParam(":texto", $texto);
    $stmt->bindParam(":tag1", $tag1);
    $stmt->bindParam(":tag2", $tag2);
    $stmt->bindParam(":tag3", $tag3);
    $stmt->bindParam(":id_autor", $id_autor, PDO::PARAM_INT);
    $stmt->bindValue(":data_criacao", date('Y-m-d H:i:s'));
    $stmt->bindValue(":noticia_id", $noticia_id, PDO::PARAM_INT);
    if ($fileHandle !== null) {
        $stmt->bindParam(":foto", $fileHandle, PDO::PARAM_LOB);
    }

    $stmt->execute();

    if ($fileHandle) {
        fclose($fileHandle);
    }


    Banco::desconectar();

    header("Location: ../views/escrever_noticia.php?erro=0&sucesso=1");
    exit;

} catch (PDOException $e) {
    header("Location: ../views/escrever_noticia.php?erro=" . urlencode($e->getMessage()) . "&sucesso=0");
    exit;
}
?>