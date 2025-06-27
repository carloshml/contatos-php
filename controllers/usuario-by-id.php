<?php
require_once __DIR__ . '/../DAO/usuarios.php';
header('Content-Type: application/json');
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $usuarioService = new UsuarioService();
        $data = $usuarioService->finById($id);
        header('Content-Type: application/json');
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['error' => true, 'message' => 'Registro não encontrado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => true, 'message' => $e->getMessage()]);
    } finally {
        Banco::desconectar();
    }
}
?>