<?php
require_once __DIR__ . '/../config/banco.php';
class UsuarioService
{


    private $link;

    public function __construct()
    {
        $db = new Banco();
        $this->link = $db->conectar();
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM pessoa ORDER BY id DESC';
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function deleteById($id)
    {
        $sql = 'DELETE FROM pessoa  WHERE pessoa.id = :id ';
        $stmt = $this->link->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function finById($id)
    {
        $stmt = $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id,nome, login, endereco, telefone,  email, sexo FROM pessoa WHERE id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>