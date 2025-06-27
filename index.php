<?php
session_start();
require_once('DAO/noticia.php');
$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
$noticiaService = new NoticiaService();
$noticias = $noticiaService->get5Noticia();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Últimas Notícias</title>
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

		.news-card {
			background: white;
			border-radius: 12px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
			margin-bottom: 2rem;
			overflow: hidden;
			transition: transform 0.3s ease;
		}

		.news-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
		}

		.news-image {
			width: 100%;
			height: 300px;
			object-fit: cover;
		}

		.news-title {
			color: var(--primary-color);
			font-weight: 700;
			margin-bottom: 1rem;
		}

		.news-content {
			line-height: 1.8;
			color: #495057;
		}

		.tag-badge {
			background-color: var(--accent-color);
			color: white;
			margin-right: 0.5rem;
			margin-bottom: 0.5rem;
			padding: 0.5rem 1rem;
			border-radius: 50px;
			font-weight: 500;
		}

		.author-info {
			color: #6c757d;
			font-size: 0.9rem;
		}

		form {
			position: relative !important;
		}

		.form-edit-btn {
			position: absolute;
			top: 1rem;
			left: 1rem;
			z-index: 10;
		}

		.edit-btn {
			position: absolute;
		}

		.form-btn-sair {
			top: 4rem;
			right: 1rem;
			z-index: 10;
		}

		.btn-sair {
			position: absolute;
			right: 1rem;
			background-color: red;
		}

		.form-btn-adm {
			top: 7rem;
			right: 1rem;
			z-index: 10;
		}

		.btn-adm {
			position: absolute;
			right: 1rem;
			background-color: #005588;
		}
	</style>
	 
</head>

<body>
	<?php if (isset($_SESSION['id_usuario'])): ?>
		<form method="post" enctype="multipart/form-data" action="modal/logout.php" class="form-btn-sair">
			<button class="btn btn-sm btn-primary rounded-circle btn-sair " type="submit" title="Sair">
				<i class="fas fa-sign-out-alt"></i>
			</button>
		</form>

		<form method="post" enctype="multipart/form-data" action="views/home.php" class="form-btn-adm">
			<button class="btn btn-sm btn-primary  btn-adm  " type="submit" title="Gerenciar Sistema">
				<div>
					Oi, <?= $_SESSION['nome_usuario'] ?>
				</div>
				<div>
					Gerenciar Sistema
				</div>
			</button>
		</form>
	<?php endif; ?>




	<div class=" container py-5 ">
		<div class="row">
			<?php foreach ($noticias as $row):
				$foto_content = $row['foto'];
				if (is_resource($foto_content)) {
					$foto_content = stream_get_contents($foto_content);
				}
				$base64 = $foto_content ? base64_encode($foto_content) : '';

				$dataCriacao = date('d/m/Y', strtotime($row['data_criacao']));

				$array = [
					"noticia_id" => $row['noticia_id'],
					"titulo" => $row['titulo'],
					"texto" => $row['texto'],
					"tag1" => $row['tag1'],
					"tag2" => $row['tag2'],
					"tag3" => $row['tag3'],
					"nomeAutor" => $row['nome_autor'],
					"dataCriacao" => $dataCriacao
				];
				?>

				<div class="col-md-6 mb-4">
					<div class="news-card">
						<?php if (isset($_SESSION['id_usuario'])): ?>
							<form method="post" enctype="multipart/form-data"
								action="views/escrever_noticia.php?noticia_id=<?= $row['noticia_id'] ?>&erro=Edite Sua Noticia&noticia=<?= urlencode(json_encode($array)) ?>"
								class="form-edit-btn">
								<button class="btn btn-sm btn-primary rounded-circle edit-btn" type="submit"
									title="Editar Notícia">
									<i class="fas fa-edit"></i>
								</button>
							</form>
						<?php endif; ?>

						<?php if ($base64): ?>
							<img class="news-image" src="data:image/jpeg;base64,<?= $base64 ?>"
								alt="<?= htmlspecialchars($row['titulo']) ?>">
						<?php endif; ?>

						<div class="p-4">
							<h2 class="news-title">

								<a
									href="views/noticia-read.php?noticia_id=<?= $row['noticia_id'] ?>&erro=Edite Sua Noticia&noticia=<?= urlencode(json_encode($array)) ?>">
									<?= htmlspecialchars($row['titulo']) ?> </a>

							</h2>
							<div class="news-content"><?= nl2br(htmlspecialchars($row['texto'])) ?></div>

							<div class="mt-3 mb-4">
								<?php foreach (['tag1', 'tag2', 'tag3'] as $tag):
									if (!empty($row[$tag])): ?>
										<span class="tag-badge"><?= htmlspecialchars($row[$tag]) ?></span>
									<?php endif;
								endforeach; ?>
							</div>

							<div class="author-info text-end">
								Publicado por <strong><?= htmlspecialchars($row['nome_autor']) ?></strong> |
								<?= date('d/m/Y', strtotime($row['data_criacao'])) ?>
							</div>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>




	<?php
	if (!isset($_SESSION['id_usuario'])) {
		echo '<footer class="bg-light py-3 fixed-bottom border-top d-flex justify-content-end pe-4">
			<a class="btn btn-outline-primary me-2" href="#" id="btn_abrir_login" data-bs-toggle="modal" data-bs-target="#modal_login">
				<i class="fas fa-sign-in-alt"></i> Login
			</a>
			<a class="btn btn-outline-success" href="views/usuario-inscrevase.php">
				<i class="fas fa-user-plus"></i> Inscrever-se
			</a>
		</footer>';
	}
	?>
	<!-- Bootstrap 5 JS Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>





<!-- Modal login-->
<div class="modal fade" id="modal_login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content" style="border-radius: 0.75rem;">
			<div class="modal-header border-0" style="background-color: var(--primary-color); color: white;">
				<h5 class="modal-title" id="loginModalLabel"></h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
					aria-label="Fechar"></button>
			</div>
			<div class="modal-body p-4">
				<div class="row g-4 align-items-center">
					<div class="col-md-5 "
						style="background-color: var(--secondary-color); color: white; border-radius: 0.5rem;">
						<h2 class="mb-3 mt-3 text-center">Bem-vindo</h2>
						<p>Entre para escrever notícias e para a gestão</p>
					</div>
					<div class="col-md-7">
						<h4 class="mb-4">Já possui uma conta?</h4>
						<form method="post" action="modal/valida_acesso.php" id="formLogin">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="campo_usuario" name="login"
									placeholder="Usuário">
								<label for="campo_usuario">Usuário</label>
							</div>
							<div class="form-floating mb-3">
								<input type="password" class="form-control" id="campo_senha" name="senha"
									placeholder="Senha">
								<label for="campo_senha">Senha</label>
							</div>
							<?php
							if ($erro == 1) {
								echo '<div class="text-danger small mb-3">Usuário ou senha inválido(s)</div>';
							}
							if ($erro == 2) {
								echo '<div class="text-warning small mb-3">É necessário entrar na página</div>';
							}
							?>
							<div class="row">
								<div class="col-md-6">
									<button type="submit" class="btn btn-primary w-100">Entrar</button>
								</div>
								<div class="col-md-6">
									<a class="btn btn-outline-success w-100" href="views/usuario-inscrevase.php">
										<i class="fas fa-user-plus"></i> Inscrever-se
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer border-0"></div>
		</div>
	</div>
</div>