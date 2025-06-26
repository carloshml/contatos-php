<?php
session_start();


require_once('../DAO/noticia.php');

$id_usuario = $_SESSION['id_usuario'] ?? 0;
$erro = $_GET['erro'] ?? 0;
$sucesso = $_GET['sucesso'] ?? 0;
$noticia = $_GET['noticia'] ?? '{}';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Visualizar Notícia</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4cc9f0;
    }

    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .news-container {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      padding: 2rem;
      margin-bottom: 2rem;
    }

    .news-title {
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 1.5rem;
    }

    .news-content {
      line-height: 1.8;
      color: #495057;
      white-space: pre-line;
    }

    .news-image {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 1.5rem;
    }

    .tag-badge {
      background-color: var(--accent-color);
      color: white;
      margin-right: 0.5rem;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-weight: 500;
    }

    .author-info {
      color: #6c757d;
      font-size: 0.9rem;
      text-align: right;
      margin-top: 2rem;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    const noticia = <?= $noticia ?>;
    const erro = <?= json_encode($erro) ?>;
    const sucesso = <?= $sucesso ?>;

    document.addEventListener("DOMContentLoaded", function () {

      console.log('noticia :::: ', noticia)
      if (noticia) {
        if (noticia.titulo) document.getElementById('news-title').textContent = noticia.titulo;
        if (noticia.texto) document.getElementById('news-content').textContent = noticia.texto;
        if (noticia.tag1) document.getElementById('tag1').textContent = noticia.tag1;
        if (noticia.tag2) document.getElementById('tag2').textContent = noticia.tag2;
        if (noticia.tag3) document.getElementById('tag3').textContent = noticia.tag3;
        if (noticia.nomeAutor) document.getElementById('nomeAutor').textContent = noticia.nomeAutor;

        if (noticia.dataCriacao) document.getElementById('dataCriacao').textContent = noticia.dataCriacao;




        if (noticia.foto) {
          document.getElementById('news-image').src = 'data:image/jpeg;base64,' + noticia.foto;
          document.getElementById('news-image').style.display = 'block';
        }
      }

      if (sucesso === 1) {
        alert('Notícia salva com sucesso!');
      }


    });
  </script>
  <script language="JavaScript" src="noticia-read.js"></script>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="home.php">Notícias Atuais</a>
      <?php if (isset($_SESSION['id_usuario'])): ?>
        <a class="btn btn-outline-danger" href="../modal/logout.php">
          <i class="fas fa-sign-out-alt"></i> Sair
        </a>
      <?php endif; ?>
    </div>
  </nav>

  <div class="container py-4">
    <div class="news-container">
      <div id="imagePreviewContainer" style="margin-top: 10px; display: none;">
        <img id="imagePreview" src="#" alt="Preview" style="max-height: 200px; max-width: 100%;" />
      </div>


      <!-- News Title -->
      <h1 id="news-title" class="news-title"></h1>

      <!-- News Content -->
      <div id="news-content" class="news-content"></div>

      <!-- Tags -->
      <div class="mt-4">
        <span id="tag1" class="tag-badge"></span>
        <span id="tag2" class="tag-badge"></span>
        <span id="tag3" class="tag-badge"></span>
      </div>

      <!-- Author Info -->
      <div class="author-info">
        Publicado por <strong id="nomeAutor"> </strong>
        | <span id="dataCriacao"> </span>

      </div>
    </div>

    <div class="text-center mt-3">
      <a href="../index.php" class="btn btn-primary">
        <i class="fas fa-arrow-left me-2"></i>Voltar para Notícias
      </a>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>