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
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    const post = <?= $teste ?>;
    const erro = <?= json_encode($erro) ?>;

    document.addEventListener("DOMContentLoaded", function () {
      if (erro && erro !== '0') {
        if (post.titulo) document.getElementById('titulo').value = post.titulo;
        if (post.texto) document.getElementById('texto').value = post.texto;
        if (post.tag1) document.getElementById('tag1').value = post.tag1;
        if (post.tag2) document.getElementById('tag2').value = post.tag2;
        if (post.tag3) document.getElementById('tag3').value = post.tag3;
        if (post.noticia_id) document.getElementById('noticia_id').value = post.noticia_id;
      }
    });
  </script>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="home.php">Notícias Atuais</a>
    <a class="nav-link" href="../modal/logout.php">Sair</a>
  </nav>

  <section class="container mt-4">
    <?php if ($sucesso): ?>
      <div class="alert alert-success">Notícia salva com sucesso!</div>
    <?php endif; ?>

    <?php if ($erro && $erro !== '0'): ?>
      <div class="alert alert-warning"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <h1>Notícia</h1>

    <?php
    if (!empty($_REQUEST['noticia_id'])) {
      $noticiaService = new NoticiaService();
      $noticia = $noticiaService->findById((int) $_REQUEST['noticia_id']);
      if ($noticia && !empty($noticia['foto'])) {
        $foto = is_resource($noticia['foto']) ? stream_get_contents($noticia['foto']) : $noticia['foto'];
        echo "<img class='center' height='150' src='data:image/jpeg;base64," . base64_encode($foto) . "' />";
      }

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
        <label for="imagem_file">Imagem</label>
        <input type="file" id="imagem_file" name="imagem" class="form-control-file">
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
        <label for="imagem_file">Imagem</label>
        <input type="file" id="imagem_file" name="imagem" class="form-control-file">
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