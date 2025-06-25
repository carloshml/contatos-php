<?php
  session_start();
  if (!isset($_SESSION['id_usuario'])){
    header("Location: ../index.php?erro=2");
  }
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
  <script language="JavaScript" src="salvar_usuarios.js"></script>


</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="home.php">
      Agenda
    </a>
    <a class="nav-link" href="../modal/logout.php">sair</a>
  </nav>
  <div class="container">
    <div class="form-row">
      <div class="col">
        <h2>Contatos</h2>
      </div>
      <div class="col text-right">
        <button id="btn_abrir_modal_para_inserir" type="button" class="btn btn-success " data-toggle="modal"
          data-target="#meuModal">
          novo
        </button>
      </div>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nome</th>
          <th scope="col">Login</th>
          <th scope="col">Endereço</th>
          <th scope="col">Telefone</th>
          <th scope="col">Email</th>
          <th scope="col">Sexo</th>
          <th scope="col">Ação</th>
        </tr>
      </thead>
      <tbody id="todo_contatos">
        <!--  os contatos aqui são gerado dinamicamento com a funcao  atualizarContatos(); -->
      </tbody>
    </table>
  </div>
  </div>
</body>

</html>


<!-- Modal Create -->
<div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Contato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div clas="span10 offset1">
            <div class="card">
              <div class="card-body">
                <form id="form_contato" class="form-horizontal"> <!-- action="index.php" method="post" -->
                  <div class="control-group">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                      <input id="in_m_c_nome" size="50" class="form-control" name="nome" type="text" placeholder="Nome"
                        required="" value="">
                      <span id="erro_nome" class="help-inline text-warning"></span>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Login</label>
                    <div class="controls">
                      <input id="in_m_c_login" size="50" class="form-control" name="login" type="text"
                        placeholder="login" required="" value="">
                      <span id="erro_login" class="help-inline text-warning"></span>
                    </div>
                  </div>
                  <div class="control-group ">
                    <label class="control-label">Endereço</label>
                    <div class="controls">
                      <input id="in_m_c_endereco" size="80" class="form-control" name="endereco" type="text"
                        placeholder="Endereço" required="" value="">
                      <span id="erro_endereco" class="help-inline text-warning"></span>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col">
                      <div class="control-group ">
                        <label class="control-label">Telefone</label>
                        <div class="controls">
                          <input id="in_m_c_telefone" size="35" class="form-control" name="telefone" type="text"
                            placeholder="Telefone" required="" value="">
                          <span id="erro_telefone" class="help-inline text-warning"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="control-group ">
                        <label class="control-label">Email</label>
                        <div class="controls">
                          <input id="in_m_c_email" size="40" class="form-control" name="email" type="text"
                            placeholder="Email" required="" value="">
                          <span id="erro_email1" class="help-inline text-warning"></span>
                          <span id="erro_email2" class="help-inline text-warning"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col">
                      <div class="control-group ">
                        <label class="control-label">Senha</label>
                        <div class="controls">
                          <input id="in_m_c_senha" size="80" class="form-control" name="senha" type="password"
                            placeholder="senha" required="true" value="">

                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="control-group ">
                        <label class="control-label">Repita a Senha</label>
                        <div class="controls">
                          <input id="in_m_c_senha2" size="80" class="form-control" name="senha2" type="password"
                            placeholder="senha" required="true" value="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <span id="erro_senha" class="help-inline text-warning"></span>
                  <span id="erro_senha2" class="help-inline text-warning"></span>
                  <div class="control-group ">
                    <label class="control-label">Sexo</label>
                    <span id="erro_sexo" class="help-inline text-warning"></span>
                    <div class="controls">
                      <div class="form-check">
                        <p class="form-check-label">
                          <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M" /> Masculino
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F" /> Feminino
                      </div>
                      </p>

                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="btn_salvar_contato" class="btn btn-success">Adicionar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal  Delete-->
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deseja Deletar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div clas="span10 offset1">

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button id="btn-deletar-contato-concluir" class="btn btn-danger">deletar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal  informacao-->
<div class="modal fade" id="modal_read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações do Contato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="span10 offset1">
            <div class="card">

              <div class="container">
                <div class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                      <label class="carousel-inner" id="rd_nome_contato"> </label>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">login</label>
                    <div class="controls">
                      <label class="carousel-inner" id="rd_login_contato"> </label>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Endereço</label>
                    <div class="controls">
                      <label class="carousel-inner" id="rd_endereco_contato"> </label>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Telefone</label>
                    <div class="controls">
                      <label class="carousel-inner" id="rd_telefone_contato"> </label>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                      <label class="carousel-inner" id="rd_email_contato"> </label>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Sexo</label>
                    <div class="controls">
                      <label class="carousel-inner" id="rd_sexo_contato"> </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal  Update-->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Atualizar Contato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div clas="span10 offset1">
            <div class="card">
              <div class="card-body">
                <form id="form_contato_update" class="form-horizontal"> <!-- action="index.php" method="post" -->


                  <div class="form-row">
                    <div class="col col-md-2">
                      <div class="control-group">
                        <label class="control-label">Cód</label>
                        <div class="controls">
                          <input disabled id="input_id_contato" size="50" class="form-control" name="id" type="text"
                            placeholder="Cód" required="">

                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="control-group">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                          <input size="50" id="input_nome_contato" class="form-control" name="nome" type="text"
                            placeholder="Nome" required="">
                          <span id="erro_nomeup" class="help-inline text-warning"></span>
                        </div>
                      </div>
                    </div>
                    <div class="control-group ">
                      <label class="control-label">login</label>
                      <div class="controls">
                        <input size="80" id="input_login_contato" class="form-control" name="login" type="text"
                          placeholder="login" required="">
                        <span id="erro_loginup" class="help-inline text-warning"></span>
                      </div>
                    </div>
                    <div class="control-group ">
                      <label class="control-label">Endereço</label>
                      <div class="controls">
                        <input size="80" id="input_endereco_contato" class="form-control" name="endereco" type="text"
                          placeholder="Endereço" required="">
                        <span id="erro_enderecoup" class="help-inline text-warning"></span>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col">
                        <div class="control-group ">
                          <label class="control-label">Telefone</label>
                          <div class="controls">
                            <input size="35" id="input_telefone_contato" class="form-control" name="telefone"
                              type="text" placeholder="Telefone" required="">
                            <span id="erro_telefoneup" class="help-inline text-warning"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="control-group ">
                          <label class="control-label">Email</label>
                          <div class="controls">
                            <input size="40" id="input_email_contato" class="form-control" name="email" type="text"
                              placeholder="Email" required="">
                            <span id="erro_email1up" class="help-inline text-warning"></span>
                            <span id="erro_email2up" class="help-inline text-warning"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group ">
                      <label class="control-label">Sexo</label>
                      <div class="controls">
                        <span id="erro_sexoup" class="help-inline text-warning"></span>
                        <div class="form-check">
                          <p class="form-check-label">
                            <input class="form-check-input" type="radio" name="sexo" value="M" id="sexo_M" /> Masculino
                          </p>
                        </div>
                        <div class="form-check">
                          <p class="form-check-label">
                            <input class="form-check-input" type="radio" name="sexo" value="F" id="sexo_F" /> Feminino
                          </p>
                        </div>
                      </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button id="btn_concluir_update_contato" type="button" class="btn btn-success">Atualizar</button>
        </div>
      </div>
    </div>
  </div>