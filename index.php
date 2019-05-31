<?php	
    session_start();
    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0 ; 
    if (isset($_SESSION['id_usuario'])){
        header("Location: home.php");
    }
?>
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
	<script>
		$(document).ready(function (){
			//verificar se os campos de usupario e senha foram devidadmente preenchidos
			// #para o uso do Id
			$('#btn_login').click(function(){
				var campo_vazio = false;
				 if ($('#campo_usuario').val() == ''){
				  $('#campo_usuario').css({'border-color':'#a94442'})
					campo_vazio = true;
				}else {
					$('#campo_usuario').css({'border-color':'#CCC'})
				}
				if ($('#campo_senha').val() == ''){
					$('#campo_senha').css({'border-color':'#a94442'})
					campo_vazio = true;
				}else {
					$('#campo_senha').css({'border-color':'#CCC'})
				}
				if (campo_vazio) return false;
			});
		});
	</script>
	</head>
	<body style="height:100vh; padding-top:10%">    
	    <div class="container align-middle">
                 <div class="form-row">
						    <div class="col-md-4">
										<div class="jumbotron">
									     	 <h1>Bem vindo</h1>	
                                         </div>									 
							 </div>		
						     <div class="col ">
									<div class="<?= $erro == 1 ? 'open': '' ?>">
                                    </div>
									<div class="col-md-12">
										     <h3>já possui uma conta?</h3>
										     <form method="post" action="valida_acesso.php" id="formLogin">
										     				<div class="form-group">
										     					<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
										     				</div>
										     				<div class="form-group">
										     					<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
										     				</div>
										     				<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>
										     </form>
										     		<?php
										     		    if ($erro == 1){
                                    	                     echo '<font color="FF0000">usuário ou senha inválido(s)</font>';                                                    
                                                         }
                                                         if ($erro == 2){
                                                            echo '<font color="FF0000"> É necessário entrar na página</font>';                                                    
                                                        }
										     		 ?>
							        </div>
						     </div>					
                  </div>
		</div>	 
	</body>
</html>