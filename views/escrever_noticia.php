<?php 
     session_start();
     if (!isset($_SESSION['id_usuario'])){
       header("Location: ../index.php?erro=2");
     }
    $id_usuario = 	$_SESSION['id_usuario'] ; 
    //require '../modal/salvar_noticia.php';
    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0 ;  
    $sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : 0 ;
    $teste = isset($_GET['teste']) ? $_GET['teste'] : 0 ; 
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title> Escrever Noticia </title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      const  post =  <?php echo $teste  ?> ;
      const  erro =   <?php echo  json_encode($erro)   ?>;  
      document.addEventListener("DOMContentLoaded", function() {        
           if((erro !==  null) &&  (erro !==  undefined  )  && (erro !==  0) && (erro !==  '0')  ){
                console.log( document.getElementById('titulo')); 
                document.getElementById('titulo').value =  post.titulo ;
                document.getElementById('texto').value = post.texto;
                document.getElementById('tag1').value = post.tag1 ;
                document.getElementById('tag2').value = post.tag2 ;
                document.getElementById('tag3').value = post.tag3 ;   
            } 
        });
       
    </script>
	</head>
	<body >
        <nav class="navbar navbar-light bg-light">
          <a class="navbar-brand" href="home.php">     
             Noticias Atuais
          </a>         
          <a class="nav-link"  href="../modal/logout.php">sair</a>
        </nav>  
        <section class="container">
            <?php if(!empty($sucesso)): ?>
                  <div class="alert alert-success" role="alert">
                    Noticia Salva!
                  </div>                  
            <?php endif;?>   
            <?php if( $erro != '0' ): ?>
                  <div class="alert alert-warning" role="alert">
                     <?=$erro?>
                  </div>                  
            <?php endif;?>       
            <h1>Notícias</h1>	
            <form method="post" enctype="multipart/form-data" action="../modal/salvar_noticia.php" id="formLogin">
                <div>
                   <label for="exampleInputEmail1">Título</label>
                   <input id="titulo"  type="text"  class="form-control" name="titulo"  > 
                </div>
                <div>
                   <label for="exampleInputEmail1">Texto</label>
                   <textarea name="texto"  class="form-control" id="texto" cols="30" rows="10"></textarea>
                </div>  
                
                <div>
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem"/>
                    <br/>                   
                </div>
                <p></p>
                <div class="form-row">
                        <div class="col">
                             <input  type="text"  class="form-control" maxlength="10" placeholder="tag1" name="tag1" id="tag1" > 
                        </div>
                        <div class="col">
                              <input  type="text"  class="form-control"  maxlength="10" placeholder="tag2" name="tag2" id="tag2" > 
                        </div>
                        <div class="col">
                             <input  type="text"  class="form-control" maxlength="10" placeholder="tag3" name="tag3" id="tag3" > 
                        </div>
                        
                        <div class="col text-right">
                              <button   class="btn btn-success " type="submit">salvar</button>
                        </div>
               </div>                        
            </form>
        </section>        
	</body>
</html>

