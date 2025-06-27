document.addEventListener("DOMContentLoaded", function () {



  $('#meuModal').on('shown.bs.modal', function () {
    $('#meuInput').trigger('focus')
  })

  $(document).ready(function () {
    $('#btn_salvar_contato').click(function () {
      $.ajax({
        url: '../services/usuario-create.php',
        method: 'post',
        data: $('#form_contato').serialize(),
        success: function (data) {
          const validacao = JSON.parse(data);
          if (validacao[0].valido) {
            $('#createModal ').modal('hide');
            $('#viewModal').modal('hide');
            $('#deleteModal').modal('hide');
            $('#editModal').modal('hide');
            atualizarContatos();
          } else {
            $('#erro_nome').html('');
            $('#erro_endereco').html('');
            $('#erro_telefone').html('');
            $('#erro_email1').html('');
            $('#erro_email2').html('');
            $('#erro_sexo').html('');
            $('#erro_login').html('');
            $('#erro_senha').html('');
            $('#erro_senha2').html('');
            if (validacao[1].temErro) {
              $('#erro_nome').html(validacao[1].motivo);
            }
            if (validacao[2].temErro) {
              $('#erro_endereco').html(validacao[2].motivo);
            }
            if (validacao[3].temErro) {
              $('#erro_telefone').html(validacao[3].motivo);
            }
            if (validacao[4].temErro) {
              $('#erro_email1').html(validacao[4].motivo);
            }
            if (validacao[5].temErro) {
              $('#erro_email2').html(validacao[5].motivo);
            }
            if (validacao[6].temErro) {
              $('#erro_sexo').html(validacao[6].motivo);
            }
            if (validacao[7].temErro) {
              $('#erro_senha').html(validacao[7].motivo);
            }
            if (validacao[8].temErro) {
              $('#erro_senha2').html(validacao[8].motivo);
            }
            if (validacao[9].temErro) {
              $('#erro_login').html(validacao[9].motivo);
            }
          }
        }
      });
    });

    $('#btn-deletar-contato-concluir').click(function (e) {
      $.ajax({
        url: '../services/usuario-delete.php',
        method: 'get',
        data: { id: $('#btn-deletar-contato-concluir').attr('data-id') },
        success: function (data) {
          if (!('' + data).includes('deletado')) {
            escreverMensagemNaTela('Tem noticias associadas!');
            return;
          }
          escreverMensagemNaTela('Apagado Com Sucesso!');
          $('#createModal ').modal('hide');
          $('#viewModal').modal('hide');
          $('#deleteModal').modal('hide');
          $('#editModal').modal('hide');
          atualizarContatos();
        }
      });
    });

    $('#btn_abrir_modal_para_inserir').click(function () {
      $('#in_m_c_nome').val('');
      $('#in_m_c_endereco').val('');
      $('#in_m_c_telefone').val('');
      $('#in_m_c_email').val('');
      $('#in_m_c_senha').val('');
      $('#in_m_c_senha2').val('');
      $('#in_m_c_login').val('');
      $('#sexoM').attr('checked', 'checked');
      $('#erro_nome').html('');
      $('#erro_endereco').html('');
      $('#erro_telefone').html('');
      $('#erro_email1').html('');
      $('#erro_email2').html('');
      $('#erro_sexo').html('');
      $('#erro_senha').html('');
      $('#erro_senha2').html('');
      $('#erro_login').html('');
    });

    $('#btn_concluir_update_contato').click(function () {
      const dataRequest = 'id=' + $('#btn_concluir_update_contato').attr('data-id') + '&' + $('#form_contato_update').serialize();
      $.ajax({
        url: '../services/usuario-update.php',
        method: 'post',
        data: dataRequest,
        success: function (data) {
          const validacao = JSON.parse(data);
          if (validacao.valido) {
            $('#createModal ').modal('hide');
            $('#viewModal').modal('hide');
            $('#deleteModal').modal('hide');
            $('#editModal').modal('hide');
            atualizarContatos();
          } else {
            $('#erro_nomeup').html('');
            $('#erro_enderecoup').html('');
            $('#erro_telefoneup').html('');
            $('#erro_email1up').html('');
            $('#erro_email2up').html('');
            $('#erro_loginup').html('');
            $('#erro_sexoup').html('');
            if (validacao[1].temErro) {
              $('#erro_nomeup').html(validacao[1].motivo);
            }
            if (validacao[2].temErro) {
              $('#erro_enderecoup').html(validacao[2].motivo);
            }
            if (validacao[3].temErro) {
              $('#erro_telefoneup').html(validacao[3].motivo);
            }
            if (validacao[4].temErro) {
              $('#erro_email1up').html(validacao[4].motivo);
            }
            if (validacao[5].temErro) {
              $('#erro_email2up').html(validacao[5].motivo);
            }
            if (validacao[6].temErro) {
              $('#erro_sexoup').html(validacao[6].motivo);
            }
            if (validacao[7].temErro) {
              $('#erro_loginup').html(validacao[7].motivo);
            }
          }
        }
      });
    });

    $('#btn_salvar_contato_sem_session').click(function () {

      $.ajax({
        url: '../services/usuario-create.php',
        method: 'post',
        data: $('#form_contato').serialize(),
        success: function (data) {

          const validacao = JSON.parse(data);

          if (validacao[0].valido) {
            var url = '../index.php';
            window.location.href = url;
          } else {
            $('#erro_nome').html('');
            $('#erro_endereco').html('');
            $('#erro_telefone').html('');
            $('#erro_email1').html('');
            $('#erro_email2').html('');
            $('#erro_sexo').html('');
            $('#erro_login').html('');
            $('#erro_senha').html('');
            $('#erro_senha2').html('');
            if (validacao[1].temErro) {
              $('#erro_nome').html(validacao[1].motivo);
            }
            if (validacao[2].temErro) {
              $('#erro_endereco').html(validacao[2].motivo);
            }
            if (validacao[3].temErro) {
              $('#erro_telefone').html(validacao[3].motivo);
            }
            if (validacao[4].temErro) {
              $('#erro_email1').html(validacao[4].motivo);
            }
            if (validacao[5].temErro) {
              $('#erro_email2').html(validacao[5].motivo);
            }
            if (validacao[6].temErro) {
              $('#erro_sexo').html(validacao[6].motivo);
            }
            if (validacao[7].temErro) {
              $('#erro_senha').html(validacao[7].motivo);
            }
            if (validacao[8].temErro) {
              $('#erro_senha2').html(validacao[8].motivo);
            }
            if (validacao[9].temErro) {
              $('#erro_login').html(validacao[9].motivo);
            }
          }
        }
      });
    });

    const table = $('#contactsTable').DataTable({
      responsive: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
      }
    });

    // Delegate event handlers using `.on()` — this binds to *future* rows
    $('#contactsTable tbody').on('click', '.btn_apaga_contato', function () {
      const id_user = this.id.split('_')[1];
      $('#deleteContactName').text($(this).closest('tr').find('td:eq(1)').text());
      $('#btn-deletar-contato-concluir').attr('data-id', id_user);
    });

    $('#contactsTable tbody').on('click', '.btn_ler_contato', function () {
      const id_user = this.id.split('_')[1];
      $.ajax({
        url: '../controllers/usuario-by-id.php',
        method: 'GET',
        data: { id: id_user },
        dataType: 'json',
        success: function (data) {
          $('#rd_nome_contato').text(data.nome);
          $('#rd_endereco_contato').text(data.endereco);
          $('#rd_telefone_contato').text(data.telefone);
          $('#rd_email_contato').text(data.email);
          $('#rd_sexo_contato').text(data.sexo === 'M' ? 'Masculino' : 'Feminino');
          $('#rd_login_contato').text(data.login);
        },
        error: function (xhr, status, error) {
          console.error('Error loading contact:', error);
        }
      });
    });

    $('#contactsTable tbody').on('click', '.btn_update_contato', function () {
      const id_user = this.id.split('_')[1];
      $.ajax({
        url: '../controllers/usuario-by-id.php',
        method: 'GET',
        data: { id: id_user },
        dataType: 'json',
        success: function (data) {
          $('#input_id_contato').attr('value', id_user);
          $('#btn_concluir_update_contato').attr('data-id', id_user);
          $('#input_id_user').val(data.id);
          $('#input_nome_contato').val(data.nome);
          $('#input_login_contato').val(data.login);
          $('#input_endereco_contato').val(data.endereco);
          $('#input_telefone_contato').val(data.telefone);
          $('#input_email_contato').val(data.email);
          $('#sexo_M').prop('checked', data.sexo === 'M');
          $('#sexo_F').prop('checked', data.sexo === 'F');
        },
        error: function (xhr, status, error) {
          console.error('Error loading contact for edit:', error);
        }
      });
    });

    atualizarContatos();
  });


  function atualizarContatos() {
    $.ajax({
      url: '../controllers/usuario-listar-todos.php',
      dataType: 'json',
      success: function (response) {
        if (response.error) {
          console.error(response.message);
          return;
        }
        const table = $('#contactsTable').DataTable();
        // Clear existing data
        table.clear();
        // Add new rows
        const newRows = response.data.map(contact => [
          contact.id,
          contact.nome,
          contact.login,
          contact.endereco,
          contact.telefone,
          contact.email,
          contact.sexo,
          contact.actions
        ]);
        table.rows.add(newRows).draw();
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', status, error);
      }
    });
  }
});