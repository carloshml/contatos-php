<?php
    include '../config/banco.php';
    session_start();
    $id_usuario = 	$_SESSION['id_usuario'] ;   
    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $tituloError = null;
        $textoErro = null;  
        $sucesso = null;
        $tagError = null;  
        $textoErroLength = null; 
        $titulo= $_POST['titulo'];
        $texto= $_POST['texto'];
        $tag1= $_POST['tag1'];
        $tag2= $_POST['tag2'];
        $tag3= $_POST['tag3'];
        $noticia_id= $_POST['noticia_id'];        
        $id_autor= $id_usuario ;      
        //Validaçao dos campos:
        $valido = true;
        if(empty($titulo)){
            $tituloError = 'Por favor entre com o titulo!';
            $valido = false;
        }else if(empty($texto)){
            $textoErro = 'Por favor entre com o texto!';
            $valido = false;
        } else if(  empty($tag1)  && empty($tag2) &&  empty($tag3)  ){
              $tagError = 'Ao menos Uma Tag Deve Ser Inserida!';
              $valido = false;
         } else  if(   strlen($texto)  <  60)   {
            $textoErroLength = 'texto deve conter ao menos 60 caracteres!';
            $valido = false;           
         } 
         
         $imagem = $_FILES['imagem'];

        //Inserindo no Banco:
        if($valido){
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{  

              if($noticia_id){                         
                $sql = "UPDATE noticia set 
                titulo= :titulo,
                texto= :texto,
                tag1= :tag1,
                tag2= :tag2,
                tag3= :tag3,
                id_autor= :id_autor,
                data_criacao= :data_criacao
                 where noticia.id = :noticia_id; "   ; 
                $stmt = $pdo->prepare($sql);
                //  $stmt->bindParam(":file_name", $files->name, PDO::PARAM_STR);   
             
                $stmt->bindParam(":titulo",  $titulo);
                $stmt->bindParam(":texto",  $texto);
                $stmt->bindParam(":tag1",  $tag1);
                $stmt->bindParam(":tag2",  $tag2);
                $stmt->bindParam(":tag3",  $tag3);
                $stmt->bindParam(":id_autor",  $id_autor );
                $stmt->bindValue(":data_criacao",  date('Y-m-d H:i:s'));  
                $stmt->bindValue(":noticia_id",  $noticia_id , PDO::PARAM_INT);             
                $stmt->execute();  

              }else{
                if($imagem['type']!= NULL) {  
                  $myfile = fopen($_FILES['imagem']['tmp_name'], "r") or die("Unable to open file!");
                  $myfile = fread($myfile,filesize($_FILES['imagem']['tmp_name']));     
                  // $test2 = $_FILES['imagem'];
                  // usermod -a -G sudo www-data
                  // sudo systemctl restart  apache2.service               
                } else{
                  echo ' sem imagem ';
                }                 
                $sql = "INSERT INTO noticia(titulo,texto,tag1,tag2,tag3,id_autor,data_criacao,foto)"
                ." VALUES"
                ."(:titulo,:texto,:tag1,:tag2,:tag3,:id_autor,:data_criacao,:foto);";
                $stmt = $pdo->prepare($sql);
                //  $stmt->bindParam(":file_name", $files->name, PDO::PARAM_STR);   
             
                $stmt->bindParam(":titulo",  $titulo);
                $stmt->bindParam(":texto",  $texto);
                $stmt->bindParam(":tag1",  $tag1);
                $stmt->bindParam(":tag2",  $tag2);
                $stmt->bindParam(":tag3",  $tag3);
                $stmt->bindParam(":id_autor",  $id_autor );
                $stmt->bindValue(":data_criacao",  date('Y-m-d H:i:s'));
                $stmt->bindParam(":foto", $myfile, PDO::PARAM_LOB);
                fclose($myfile);  
                $stmt->execute();    
              }          

            } catch(PDOException $exception)  {
              echo  "<script type='text/javascript'> console.log('".$exception->getMessage()."')  </script>" ;  
              header("Location: escrever_noticia.php?erro=".$exception."sucesso=".s);             
              die("Database connection failed: " . $exception->getMessage());
            } 
            Banco::desconectar();   
            $sucesso  = 'sucesso';  
            echo  "<script type='text/javascript'> console.log('sucesso')  </script>" ;  
            header("Location: ../views/escrever_noticia.php?erro=0&sucesso=1&teste=". json_encode($_POST));              
        }else{ 
                  
            $valido  =  $valido  ? 'true' : 'false';     
            $temErroTitulo   =  $tituloError  ? true : false;   
            $temErroTexto   =  $textoErro  ? true : false; 
            $temErroTag   =  $tagError  ? true : false; 
            $temTextoErroLength   =  $textoErroLength  ? true : false;  
            if  ( $temErroTitulo  ){
              echo  "<script type='text/javascript'> console.log('tem erro no titulo')  </script>" ; 
              header("Location: ../views/escrever_noticia.php?erro=".$tituloError."&sucesso=0&teste=". json_encode($_POST));  
            }
            if  ( $temErroTexto   ){              
              echo  "<script type='text/javascript'> console.log('tem erro no texto')  </script>" ;  
              header("Location: ../views/escrever_noticia.php?erro=".$textoErro."&sucesso=0&teste=". json_encode($_POST));  
            }             
            if  ( $temErroTag   ){              
              echo  "<script type='text/javascript'> console.log('tem erro no texto')  </script>" ;  
              header("Location: ../views/escrever_noticia.php?erro=".$tagError."&sucesso=0&teste=". json_encode($_POST));  
            }   
            if  ( $temTextoErroLength   ){              
              echo  "<script type='text/javascript'> console.log('tem erro na quantidade do texto')  </script>" ;  
              header("Location: ../views/escrever_noticia.php?erro=".$textoErroLength."&sucesso=0&teste=". json_encode($_POST));  
            }                          
        }
    } 
?>