<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
  header("Location: ../index.php?erro=2");
  exit;
}

require_once('../DAO/noticia.php');
$nome_usuario = $_SESSION['nome_usuario'];
$id_usuario = $_SESSION['id_usuario'];
$erro = $_GET['erro'] ?? 0;
$sucesso = $_GET['sucesso'] ?? 0;
$noticia = $_GET['noticia'] ?? '{}';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Escrever Notícia</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script type="text/javascript">
    const noticia = <?= $noticia ?>;
    const erro = <?= json_encode($erro) ?>;
    const sucesso = <?= $sucesso ?>;   
  </script>
  <script language="JavaScript" src="funcoes-sistema.js"></script>
  <script language="JavaScript" src="escrever_noticia.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="home.php">
        <i class="fas fa-newspaper me-2"></i>Notícias Atuais - Escreva ou Edite
      </a>
      <div class="d-flex align-items-center">
        <span class="me-3 d-none d-sm-inline"><?= $nome_usuario ?></span>
        <a class="btn btn-outline-danger" href="../modal/logout.php">
          <i class="fas fa-sign-out-alt"></i> Sair
        </a>
      </div>
    </div>
  </nav>
  <div id="mensagem-upload" class="text-center"></div>
  <section class="container mt-4">
    <h1> Escreva Sua Notícia</h1>
    <?php if ($erro && $erro !== '0'): ?>
      <div class="alert alert-warning"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
    <?php
    if (!empty($_REQUEST['noticia_id'])) {
      echo '<form method="post" enctype="multipart/form-data" action="../modal/noticia_update.php" id="formNoticia">
      <input type="hidden" name="noticia_id" id="noticia_id">

      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="texto">Texto</label>
        <textarea name="texto" id="texto" class="form-control" rows="8" required></textarea>
      </div>

      <div class="form-group">
        <label for="imagem_file">Nova Imagem</label>
        <input type="file" id="imagem_file" name="imagem" class="form-control-file" accept="image/*">
        <div id="imagePreviewContainer" style="margin-top: 10px; display: none;">
          <img id="imagePreview" src="#" alt="Preview" style="max-height: 200px; max-width: 100%;"/>
        </div>
      </div>

      <div class="form-row">
        <div class="col"><input type="text" name="tag1" id="tag1" class="form-control" maxlength="10"
            placeholder="Tag 1"></div>
        <div class="col"><input type="text" name="tag2" id="tag2" class="form-control" maxlength="10"
            placeholder="Tag 2"></div>
        <div class="col"><input type="text" name="tag3" id="tag3" class="form-control" maxlength="10"
            placeholder="Tag 3"></div>
        <div class="col text-right">
          <button type="submit" class="btn btn-success">Editar</button>
        </div>
      </div>
    </form>';
    }
    if (empty($_REQUEST['noticia_id'])) {
      echo '<form method="post" enctype="multipart/form-data" action="../modal/noticia_salvar.php" id="formNoticia">
      <input type="hidden" name="noticia_id" id="noticia_id">

      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="texto">Texto</label>
        <textarea name="texto" id="texto" class="form-control" rows="8" required></textarea>
      </div>

      <div class="form-group">
        <label for="imagem_file">Imagem Nova</label>
        <input type="file" id="imagem_file" name="imagem" class="form-control-file" accept="image/*">
        <div id="imagePreviewContainer" style="margin-top: 10px; display: none;">
          <img id="imagePreview" src="#" alt="Preview" style="max-height: 200px; max-width: 100%;"/>
        </div>
      </div>

      <div class="form-row">
        <div class="col"><input type="text" name="tag1" id="tag1" class="form-control" maxlength="10"
            placeholder="Tag 1"></div>
        <div class="col"><input type="text" name="tag2" id="tag2" class="form-control" maxlength="10"
            placeholder="Tag 2"></div>
        <div class="col"><input type="text" name="tag3" id="tag3" class="form-control" maxlength="10"
            placeholder="Tag 3"></div>
        <div class="col text-right">
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
      </div>
    </form>';
    }
    ?>
  </section>
</body>

</html>