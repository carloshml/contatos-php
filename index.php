<!DOCTYPE HTML>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<title> Login </title>
	<script src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body style="height:100vh;">
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand" href="views/home.php">
			Noticias Atuais
		</a>
	</nav>
	<section class="container">
		<h1 class="text-center">Notícias </h1>
		<?php
		session_start();
		//	echo exec('whoami'); 
		$_SESSION["uploads_base_url"] = dirname(__FILE__);
		$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
		include 'config/banco.php';
		try {
			$db = new Banco();
			$pdo = $db->conectar();
			$sql = "SELECT noticia.id as noticia_id , data_criacao,titulo, texto, tag1,tag2,tag3, foto,"
				. "pessoa.nome as nome_autor  "
				. "FROM noticia inner join pessoa  on   noticia.id_autor =  pessoa.id  ORDER BY noticia.id DESC limit 5;";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$stmt->bindColumn('data_criacao', $data_criacao);
			$stmt->bindColumn('tag1', $tag1);
			$stmt->bindColumn('tag2', $tag2);
			$stmt->bindColumn('tag3', $tag3);
			$stmt->bindColumn('titulo', $titulo);
			$stmt->bindColumn('texto', $texto);
			$stmt->bindColumn('noticia_id', $noticia_id);
			$stmt->bindColumn('foto', $foto, PDO::PARAM_LOB);
			$stmt->bindColumn('nome_autor', $nome_autor);
			while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {

				$array = array(
					"noticia_id" => $noticia_id,
					"titulo" => $titulo,
					"texto" => $texto,
					"tag1" => $tag1,
					"tag2" => $tag2,
					"tag3" => $tag3,
				);



				if (isset($_SESSION['id_usuario'])) {
					echo "<form method='post' enctype='multipart/form-data' action='views/escrever_noticia.php?erro=Edite Sua Noticia&teste=" . json_encode($array) . "' id='formLogin'>";
					echo "<button   class='btn btn-success' type='submit'>editar</button>";
					echo "</form >";
				}

				if ($foto) {



					if (is_resource($foto)) {
						$foto = stream_get_contents($foto);
					}

					$base64 = base64_encode($foto);


					echo "<img class='center' height='150' src='data:image/jpeg;base64,$base64' />";


				}

				echo "<h1>";
				print $titulo;
				echo "</h1>";
				print $texto;
				echo "<br>";
				echo '<h6> <span class="badge badge-secondary">' . $tag1 . '</span></h6>';
				echo '<h6> <span class="badge badge-secondary">' . $tag2 . '</span></h6>';
				echo '<h6> <span class="badge badge-secondary">' . $tag3 . '</span></h6>';
				echo "<br>";
				echo '<div class="text-right" > publicado por <strong>  ' . $nome_autor . ' </strong> | ' . date('d/m/Y', strtotime($data_criacao)) . '</div>';
				echo "<hr>";
			}
		} catch (PDOException $e) {
			print $e->getMessage();
		}
		Banco::desconectar();
		?>
	</section>

	<?php
	if (!isset($_SESSION['id_usuario'])) {
		echo '<footer class="text-right"  style="position: fixed; width:100%; bottom:0 "  >
				<a id="btn_abrir_login"  class="" data-toggle="modal" data-target="#modal_login">
					login
				</a> 
				<a href="views/usuario-inscrevase.php">Inscrever-se</a>
			</footer>';
	} else {
		echo '<footer class="text-right"  style="position: fixed; width:100%; bottom:0 "  >
				<a  href="views/home.php"  class="" >
				bem vindo ' . $_SESSION['nome_usuario'] .
			'</a> 
			</footer>';
	}
	?>

</body>

</html>

<!-- Modal  Update-->
<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Entrar </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container align-middle">
					<div class="form-row">
						<div class="col-md-4">
							<div class="jumbotron">
								<h1>Bem vindo</h1>
							</div>
						</div>
						<div class="col ">
							<h3>Já possui uma conta?</h3>
							<form method="post" action="modal/valida_acesso.php" id="formLogin">
								<div class="form-group">
									<input type="text" class="form-control" id="campo_usuario" name="login"
										placeholder="Usuário" />
								</div>
								<div class="form-group">
									<input type="password" class="form-control red" id="campo_senha" name="senha"
										placeholder="Senha" />
								</div>
								<div>
									<?php
									if ($erro == 1) {
										echo '<font color="FF0000">usuário ou senha inválido(s)</font>';
									}
									if ($erro == 2) {
										echo '<font color="FF0000"> É necessário entrar na página</font>';
									}
									?>
								</div>
								<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>