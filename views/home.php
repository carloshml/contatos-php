<?php
session_start();
require_once('../DAO/noticia.php');
if (!isset($_SESSION['id_usuario'])) {
  header("Location: ../index.php?erro=2");
}
$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
$id_usuario = $_SESSION['id_usuario'];
$nome_usuario = $_SESSION['nome_usuario'];
$email_usuario = $_SESSION['email_usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Notícias Atuais</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4cc9f0;
      --light-color: #f8f9fa;
      --dark-color: #212529;
    }

    body {
      background-color: #f5f7fb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      background: white !important;
    }

    .dashboard-card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      background: white;
      height: 100%;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-icon {
      font-size: 2rem;
      color: var(--primary-color);
      margin-bottom: 1rem;
    }

    .welcome-card {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border-radius: 12px;
    }

    .count-badge {
      background-color: var(--accent-color);
      color: white;
      font-size: 1.2rem;
      padding: 0.5rem 1rem;
      border-radius: 50px;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container">
      <a class="navbar-brand fw-bold" href="home.php">
        <i class="fas fa-newspaper me-2"></i>Notícias Atuais
      </a>
      <div class="d-flex align-items-center">
        <span class="me-3 d-none d-sm-inline"><?= $nome_usuario ?></span>
        <a class="btn btn-outline-danger" href="../modal/logout.php">
          <i class="fas fa-sign-out-alt"></i> Sair
        </a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container py-5">
    <!-- Welcome Card -->
    <div class="card welcome-card mb-5 p-4 border-0">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h1 class="fw-bold mb-3">Bem-vindo, <?= $nome_usuario ?>!</h1>
          <p class="mb-0">Gerencie suas notícias e usuários de forma simples e eficiente.</p>
        </div>
        <div class="col-md-4 text-md-end">
          <div class="count-badge d-inline-block">
            <i class="fas fa-newspaper me-2"></i>
            <?php
            $a = new NoticiaService();
            echo $a->numeroTotalNoticias();
            ?> Notícias
          </div>
        </div>
      </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="dashboard-card p-4 text-center">
          <div class="card-icon">
            <i class="fas fa-users-cog"></i>
          </div>
          <h5 class="fw-bold mb-3">Gerenciar Usuários</h5>
          <p class="text-muted mb-4">Adicione, edite ou remova usuários do sistema</p>
          <a href="salvar_usuarios.php" class="btn btn-primary w-100">
            Acessar <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="dashboard-card p-4 text-center">
          <div class="card-icon">
            <i class="fas fa-edit"></i>
          </div>
          <h5 class="fw-bold mb-3">Escrever Notícia</h5>
          <p class="text-muted mb-4">Crie uma nova notícia para publicação</p>
          <a href="escrever_noticia.php" class="btn btn-primary w-100">
            Acessar <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="dashboard-card p-4 text-center">
          <div class="card-icon">
            <i class="fas fa-list"></i>
          </div>
          <h5 class="fw-bold mb-3">Todas as Notícias</h5>
          <p class="text-muted mb-4">Visualize e gerencie todas as notícias publicadas</p>
          <a href="listar_noticias.php" class="btn btn-primary w-100">
            Acessar <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="dashboard-card p-4 text-center">
          <div class="card-icon">
            <i class="fas fa-globe"></i>
          </div>
          <h5 class="fw-bold mb-3">Ver Site Público</h5>
          <p class="text-muted mb-4">Acesse como os visitantes veem seu site</p>
          <a href="../index.php" class="btn btn-outline-primary w-100">
            Visualizar <i class="fas fa-external-link-alt ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>