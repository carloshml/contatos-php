document.addEventListener("DOMContentLoaded", function () {



  $('#meuModal').on('shown.bs.modal', function () {
    $('#meuInput').trigger('focus')
  })

  $(document).ready(function () {
    $('#btn_salvar_contato').click(function () {    
      $.ajax({
        url: '../modal/create.php',
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

    $('#btn-deletar-contato-concluir').click(function () {
      $.ajax({
        url: '../modal/delete.php',
        method: 'get',
        data: { id: $('#btn-deletar-contato-concluir').attr('data-id') },
        success: function (data) {
          if (data) {
            escreverMensagemNaTela('Tem noticias associadas!');
            return;
          }
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
      const idContato = this.getAttribute('idUpdate');   
      $.ajax({
        url: '../modal/usuario-update.php',
        method: 'post',
        data: 'id=' + idContato + '&' + $('#form_contato_update').serialize(),
        success: function (data) {
          
          const validacao = JSON.parse(data);
          if (validacao[0].valido) {
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
        url: '../modal/usuario-create.php',
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
    atualizarContatos();
  });


  function atualizarContatos() {
    $.ajax({
      url: '../controllers/listar-usuarios.php',
      dataType: 'json',
      success: function (response) {
        if (response.error) {
          console.error(response.message);
          return;
        }
        $('#todo_contatos').empty();
        // Add new rows


        $.each(response.data, function (index, contact) {
          $('#todo_contatos').append(`
                    <tr>
                        <td>${contact.id}</td>
                        <td>${contact.nome}</td>
                        <td>${contact.login}</td>
                        <td>${contact.endereco}</td>
                        <td>${contact.telefone}</td>
                        <td>${contact.email}</td>
                        <td>${contact.sexo}</td>
                        <td>${contact.actions}</td>
                    </tr>
                `);
        });

        if ($.fn.DataTable.isDataTable('#contactsTable')) {
          $('#contactsTable').DataTable().destroy();
          $('#contactsTable').DataTable({
            responsive: true,
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            }
          });
        }


        // Set up event handlers
        $('.btn_apaga_contato').click(function () {
          const id_contato = this.id.split('_')[1];
          $('#deleteContactName').text($(this).closest('tr').find('td:eq(1)').text());
          $('#btn-deletar-contato-concluir').attr('data-id', id_contato);
        });

        $('.btn_ler_contato').click(function () {
          const id_contato = this.id.split('_')[1];
          $.ajax({
            url: '../modal/usuario-by-id.php',
            method: 'GET',
            data: { id: id_contato },
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

        $('.btn_update_contato').click(function () {
          const id_contato = this.id.split('_')[1];
          $.ajax({
            url: '../modal/read.php',
            method: 'GET',
            data: { id: id_contato },
            dataType: 'json',
            success: function (data) {
              $('#btn_concluir_update_contato').attr('data-id', id_contato);
              $('#input_id_contato').val(data.id);
              $('#input_nome_contato').val(data.nome);
              $('#input_login_contato').val(data.login);
              $('#input_endereco_contato').val(data.endereco);
              $('#input_telefone_contato').val(data.telefone);
              $('#input_email_contato').val(data.email);
              if (data.sexo === "M") {
                $('#sexo_M').prop('checked', true);
              } else {
                $('#sexo_F').prop('checked', true);
              }
            },
            error: function (xhr, status, error) {
              console.error('Error loading contact for edit:', error);
            }
          });
        });
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', status, error);
      }
    });
  }




});