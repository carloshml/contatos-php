<?php
require_once __DIR__ . '/../DAO/usuarios.php';
header('Content-Type: application/json');
try {
    $usuarioService = new UsuarioService();
    $output = [];
    $users = $usuarioService->findAll();
    foreach ($users as $row) {
        $genderBadge = $row['sexo'] == 'M'
            ? '<span class="badge badge-gender badge-male"><i class="fas fa-mars me-1"></i>Masculino</span>'
            : '<span class="badge badge-gender badge-female"><i class="fas fa-venus me-1"></i>Feminino</span>';

        $output[] = [
            'id' => $row['id'],
            'nome' => htmlspecialchars($row['nome']),
            'login' => htmlspecialchars($row['login']),
            'endereco' => htmlspecialchars($row['endereco']),
            'telefone' => htmlspecialchars($row['telefone']),
            'email' => htmlspecialchars($row['email']),
            'sexo' => $genderBadge,
            'actions' => '
                <div class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-outline-primary action-btn btn_ler_contato" 
                            id="btnrd_' . $row['id'] . '" 
                            data-bs-toggle="modal" 
                            data-bs-target="#viewModal"
                            title="Ver detalhes">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-warning action-btn btn_update_contato" 
                            id="btnupdt_' . $row['id'] . '" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal"
                            title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger action-btn btn_apaga_contato" 
                            id="btndlt_' . $row['id'] . '" 
                            data-id="' . $row['id'] . '"
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal"
                            title="Excluir">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            '
        ];
    }

    echo json_encode(['data' => $output]);

} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Erro ao carregar contatos: ' . $e->getMessage()
    ]);
} finally {
    Banco::desconectar();
}
?>