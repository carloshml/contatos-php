<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
  header("Location: ../index.php?erro=2");
  exit;
}

require_once('../DAO/noticia.php');

$id_usuario = $_SESSION['id_usuario'];
$erro = $_GET['erro'] ?? 0;
$sucesso = $_GET['sucesso'] ?? 0;
$teste = $_GET['teste'] ?? '{}'; // Now it's a JSON string
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Escrever Notícia</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    const post = <?= $teste ?>;
    const erro = <?= json_encode($erro) ?>;
    const sucesso = <?= $sucesso ?>;   
  </script>
  <script language="JavaScript" src="funcoes-sistema.js"></script>
  <script language="JavaScript" src="escrever_noticia.js"></script>
</head>
<body>
  <div id="mensagem-upload" class="text-center"></div>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="home.php">Notícias Atuais</a>
    <a class="nav-link" href="../modal/logout.php">Sair</a>
  </nav>
  <h1>Notícia</h1>

  <section class="container mt-4">
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