<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Noticias - Cadastro</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .card-header {
      background-color: var(--primary-color);
      color: white;
      padding: 1.2rem;
      border-bottom: none;
    }

    .form-control {
      border-radius: 8px;
      padding: 10px 15px;
      border: 1px solid #e0e0e0;
    }

    .form-control:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 0.25rem rgba(76, 201, 240, 0.25);
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      border-radius: 8px;
      padding: 10px 25px;
    }

    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }

    .btn-secondary {
      border-radius: 8px;
      padding: 10px 25px;
    }

    .invalid-feedback-local {
      color: #dc3545;
      font-size: 0.875em;
      display: block;
      margin-top: 5px;
    }

    .form-check-input:checked {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
  </style>

  <script language="JavaScript" src="usuario-inscrevase.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand fw-bold" href="home.php">
        <i class="fas fa-address-book me-2"></i> Notícias Atuais - Usuários
      </a>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div id="mensagem-upload" class="text-center mb-4"></div>

        <div class="card">
          <div class="card-header text-center">
            <h4 class="mb-0">Cadastro de Novo Usuário</h4>
          </div>

          <div class="card-body p-4">
            <form id="form_contato" class="needs-validation" novalidate>
              <h5 class="form-title">Informações Pessoais</h5>

              <div class="form-section">
                <div class="mb-3">
                  <label for="in_m_c_nome" class="form-label">Nome Completo</label>
                  <input id="in_m_c_nome" class="form-control" name="nome" type="text"
                    placeholder="Digite seu nome completo" required>
                  <span id="erro_nome" class="invalid-feedback-local"></span>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="in_m_c_login" class="form-label">Login</label>
                    <input id="in_m_c_login" class="form-control" name="login" type="text"
                      placeholder="Crie um nome de usuário" required>
                    <span id="erro_login" class="invalid-feedback-local"></span>
                  </div>

                  <div class="col-md-6 mb-3">
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
                </div>
              </div>

              <h5 class="form-title">Informações de Contato</h5>

              <div class="form-section">
                <div class="mb-3">
                  <label for="in_m_c_endereco" class="form-label">Endereço</label>
                  <input id="in_m_c_endereco" class="form-control" name="endereco" type="text"
                    placeholder="Digite seu endereço completo" required>
                  <span id="erro_endereco" class="invalid-feedback-local"></span>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="in_m_c_telefone" class="form-label">Telefone</label>
                    <input id="in_m_c_telefone" class="form-control" name="telefone" type="text"
                      placeholder="(00) 00000-0000" required>
                    <span id="erro_telefone" class="invalid-feedback-local"></span>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="in_m_c_email" class="form-label">Email</label>
                    <input id="in_m_c_email" class="form-control" name="email" type="email" placeholder="seu@email.com"
                      required>
                    <span id="erro_email1" class="invalid-feedback-local"></span>
                    <span id="erro_email2" class="invalid-feedback-local"></span>
                  </div>
                </div>
              </div>

              <h5 class="form-title">Segurança</h5>

              <div class="form-section">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="in_m_c_senha" class="form-label">Senha</label>
                    <input id="in_m_c_senha" class="form-control" name="senha" type="password"
                      placeholder="Crie uma senha segura" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="in_m_c_senha2" class="form-label">Confirme a Senha</label>
                    <input id="in_m_c_senha2" class="form-control" name="senha2" type="password"
                      placeholder="Repita a senha" required>
                  </div>
                </div>
                <span id="erro_senha" class="invalid-feedback-local"></span>
                <span id="erro_senha2" class="invalid-feedback-local"></span>
              </div>

              <div class="d-flex justify-content-between mt-4">
                <button type="button" id="btn_salvar_contato_sem_session" class="btn btn-primary">
                  <i class="fas fa-user-plus me-2"></i>Cadastrar
                </button>
                <a class="btn btn-outline-secondary" href="../services/logout.php">
                  <i class="fas fa-times me-2"></i>Cancelar
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script language="JavaScript" src="usuario-inscrevase.js"></script>
  <script language="JavaScript" src="funcoes-sistema.js"></script>
</body>

</html>