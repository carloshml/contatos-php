<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Noticias</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">


  <!-- Latest compiled and minified JavaScript -->

  <script language="JavaScript" src="usuario-inscrevase.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script language="JavaScript" src="funcoes-sistema.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand fw-bold" href="../index.php">
        <i class="fas fa-address-book me-2"></i> Notícias Atuais - Novo Usuário
      </a>
    </div>
  </nav>
  <div id="mensagem-upload" class="text-center"></div>
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
                  <form id="form_contato" class="form-horizontal">
                    <div class="control-group">
                      <label class="control-label">Nome</label>
                      <div class="controls">
                        <input id="in_m_c_nome" size="50" class="form-control" name="nome" type="text"
                          placeholder="Nome" required="" value="">
                        <span id="erro_nome" class="invalid-feedback-local"></span>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Login</label>
                      <div class="controls">
                        <input id="in_m_c_login" size="50" class="form-control" name="login" type="text"
                          placeholder="login" required="" value="">
                        <span id="erro_login" class="invalid-feedback-local"></span>
                      </div>
                    </div>
                    <div class="control-group ">
                      <label class="control-label">Endereço</label>
                      <div class="controls">
                        <input id="in_m_c_endereco" size="80" class="form-control" name="endereco" type="text"
                          placeholder="Endereço" required="" value="">
                        <span id="erro_endereco" class="invalid-feedback-local"></span>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col">
                        <div class="control-group ">
                          <label class="control-label">Telefone</label>
                          <div class="controls">
                            <input id="in_m_c_telefone" size="35" class="form-control" name="telefone" type="text"
                              placeholder="Telefone" required="" value="">
                            <span id="erro_telefone" class="invalid-feedback-local"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="control-group ">
                          <label class="control-label">Email</label>
                          <div class="controls">
                            <input id="in_m_c_email" size="40" class="form-control" name="email" type="text"
                              placeholder="Email" required="" value="">
                            <span id="erro_email1" class="invalid-feedback-local"></span>
                            <span id="erro_email2" class="invalid-feedback-local"></span>
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
                    <span id="erro_senha" class="invalid-feedback-local"></span>
                    <span id="erro_senha2" class="invalid-feedback-local"></span>
                    <div class="col-12">
                      <label class="form-label">Sexo</label>
                      <div class="d-flex gap-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M" required>
                          <label class="form-check-label" for="sexoM">Masculino</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F">
                          <label class="form-check-label" for="sexoF">Feminino</label>
                        </div>
                      </div>
                      <div id="erro_sexo" class="invalid-feedback-local"></div>
                    </div>
                    <div>
                      <button type="button" id="btn_salvar_contato_sem_session"
                        class="btn btn-success">Adicionar</button>
                      <a class="btn btn-secondary" href="../modal/logout.php">Fechar</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

</html>