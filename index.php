<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title> Login </title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script> 
	</head>
	<body style="height:100vh;"> 
    	<nav class="navbar navbar-light bg-light">
          <a class="navbar-brand" href="views/home.php">     
            Noticias Atuais
          </a>          
        </nav>   		
		<section  class="container">
		<h1 class="text-center">Notícias </h1>		
		<?php	
         session_start();
				$erro = isset($_GET['erro']) ? $_GET['erro'] : 0 ;   
				include 'config/banco.php';
				$pdo = Banco::conectar();
				$sql = 'SELECT * FROM noticia ORDER BY id DESC limit 5';
				foreach($pdo->query($sql)as $row){ 
						echo '<h4 class="text-center">' .$row['titulo'] .' </h4>	 '   ;
						echo '<p>'. $row['texto'].'</p>';
						echo '<h6> <span class="badge badge-secondary">'. $row['tag1'].'</span></h6>';
						echo '<h6> <span class="badge badge-secondary">'. $row['tag2'].'</span></h6>';
						echo '<h6> <span class="badge badge-secondary">'. $row['tag3'].'</span></h6>';		 
						echo '<p> </p>';	 
				}
				Banco::desconectar();  
			?>
		</section>
		<footer class="text-right"  style="position: fixed; width:100%; bottom:0 "  >
			<a id="btn_abrir_login"  class="" data-toggle="modal" data-target="#modal_login">
				login
			</a> 
		</footer>	  
	</body>
</html>

<!-- Modal  Update-->
<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">   Entrar </h5>
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
																			<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
																		</div>
																		<div class="form-group">
																			<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
																		</div>
																		<div>
																			<?php
																				if ($erro == 1){echo '<font color="FF0000">usuário ou senha inválido(s)</font>';}
																				if ($erro == 2){echo '<font color="FF0000"> É necessário entrar na página</font>';}
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