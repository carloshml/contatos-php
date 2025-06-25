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
                        <input id="in_m_c_nome" size="50" class="form-control" name="nome" type="text"
                          placeholder="Nome" required="" value="">
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
          <button id="btn_salvar_contato_sem_session" class="btn btn-success">Adicionar</button>
          <a class="btn btn-secondary" href="../modal/logout.php">Fechar</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>