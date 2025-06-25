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
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <title>Contatos-PHP</title>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="../assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  </script>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="home.php">
      Noticias Atuais
    </a>
    <a class="nav-link" href="../modal/logout.php">sair</a>
  </nav>
  <div class="container">
    <div class="form-row">
      <div class="col">
        <h2>Bem Vindo, <?= $nome_usuario ?></h2>
      </div>
      <div class="col text-right">
      </div>
    </div>
    <div class="form-row">
      <div class="col">
        <div class="jumbotron">
          <h5>gerenciar usuarios</h5>
          <a class="btn btn-primary btn-lg" href="salvar_usuarios.php">ir </a>
        </div>
      </div>
      <div class="col">
        <div class="jumbotron">
          <h5>escrever uma noticia</h5>
          <a class="btn btn-primary btn-lg" href="escrever_noticia.php"> Ir </a>
        </div>
      </div>
      <div class="col">
        <div class="jumbotron">
          <h5> Total de Noticias </h5>
          <a class="btn btn-primary btn-lg" href="">
            <?php
            $a = new NoticiaService();
            echo $a->numeroTotalNoticias();
            ?>
          </a>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col">
        <div class="jumbotron">
          <h5>Ver as Notícias</h5>
          <a class="btn btn-primary btn-lg" href="../index.php"> Ir </a>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>