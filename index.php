<?php
session_start();
require_once __DIR__ . '/../config/banco.php';
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

		.edit-btn {
			position: absolute;
			top: 1rem;
			right: 1rem;
			z-index: 10;
		}
	</style>
</head>

<body>
	<div class="container py-5">
		<?php foreach ($noticias as $row):
			$foto_content = $row['foto'];
			if (is_resource($foto_content)) {
				$foto_content = stream_get_contents($foto_content);
			}
			$base64 = $foto_content ? base64_encode($foto_content) : '';

			$array = [
				"noticia_id" => $row['noticia_id'],
				"titulo" => $row['titulo'],
				"texto" => $row['texto'],
				"tag1" => $row['tag1'],
				"tag2" => $row['tag2'],
				"tag3" => $row['tag3']
			];
			?>
			<div class="news-card">
				<?php if (isset($_SESSION['id_usuario'])): ?>
					<form method="post" enctype="multipart/form-data"
						action="views/escrever_noticia.php?noticia_id=<?= $row['noticia_id'] ?>&erro=Edite Sua Noticia&teste=<?= urlencode(json_encode($array)) ?>"
						class="edit-btn">
						<button class="btn btn-sm btn-primary rounded-circle" type="submit" title="Editar Notícia">
							<i class="fas fa-edit"></i>
						</button>
					</form>
				<?php endif; ?>

				<?php if ($base64): ?>
					<img class="news-image" src="data:image/jpeg;base64,<?= $base64 ?>"
						alt="<?= htmlspecialchars($row['titulo']) ?>">
				<?php endif; ?>

				<div class="p-4">
					<h2 class="news-title"><?= htmlspecialchars($row['titulo']) ?></h2>
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
		<?php endforeach; ?>
	</div>

	<!-- Bootstrap 5 JS Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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