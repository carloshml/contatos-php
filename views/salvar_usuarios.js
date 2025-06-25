$('#meuModal').on('shown.bs.modal', function () {
  $('#meuInput').trigger('focus')
})

$(document).ready(function () {
  $('#btn_salvar_contato').click(function () {
    console.log($('#form_contato').serialize());
    $.ajax({
      url: '../modal/create.php',
      method: 'post',
      data: $('#form_contato').serialize(),
      success: function (data) {
        //console.log('modal criacao',data );
        const validacao = JSON.parse(data);
        console.log('modal criacao', validacao);
        if (validacao[0].valido) {
          $('#meuModal').modal('hide');
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
      data: 'id=' + this.getAttribute('idDeletar'),
      success: function (data) {
        $('#modal_delete').modal('hide');
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
    console.log(' updatate  M>>> ', 'id=' + idContato + '&' + $('#form_contato_update').serialize());
    $.ajax({
      url: '../modal/update.php',
      method: 'post',
      data: 'id=' + idContato + '&' + $('#form_contato_update').serialize(),
      success: function (data) {
        console.log('up up up', data);
        const validacao = JSON.parse(data);
        if (validacao[0].valido) {
          $('#modal_update').modal('hide');
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

  function atualizarContatos() {
    $.ajax({
      url: '../modal/atualizar.php',
      success: function (data) {
        $('#todo_contatos').html(data);
        // colocado aqui pois só aqui os elementos existem
        $('.btn_apaga_contato').click(function () {
          const id_contato = this.id.split('_')[1];
          console.log('clichou id_contato', id_contato)
          document.getElementById('btn-deletar-contato-concluir').setAttribute('idDeletar', id_contato);
        });

        $('.btn_ler_contato').click(function () {
          const id_contato = this.id.split('_')[1];
          $.ajax({
            url: '../modal/read.php',
            method: 'get',
            data: 'id=' + id_contato,
            success: function (data) {
              data = JSON.parse(data);
              $('#rd_nome_contato').html(data.nome);
              $('#rd_endereco_contato').html(data.endereco);
              $('#rd_telefone_contato').html(data.telefone);
              $('#rd_email_contato').html(data.email);
              $('#rd_sexo_contato').html(data.sexo);
              $('#rd_login_contato').html(data.login);
            }
          });
        });


        $('.btn_update_contato').click(function () {
          const id_contato = this.id.split('_')[1];
          console.log(' updat ', id_contato);
          $.ajax({
            url: '../modal/read.php',
            method: 'get',
            data: 'id=' + id_contato,
            success: function (data) {
              document.getElementById('btn_concluir_update_contato').setAttribute('idUpdate', id_contato);
              data = JSON.parse(data);
              console.log(data);
              $('#input_id_contato').val(data.id);
              $('#input_nome_contato').val(data.nome);
              $('#input_login_contato').val(data.login);
              $('#input_endereco_contato').val(data.endereco);
              $('#input_telefone_contato').val(data.telefone);
              $('#input_email_contato').val(data.email);
              if (data.sexo == "M") {
                $('#sexo_M').attr('checked', 'checked');
              } else {
                $('#sexo_F').attr('checked', 'checked');
              }
            }
          });
        });
      }
    });
  }


  $('#btn_salvar_contato_sem_session').click(function () {
    console.log($('#form_contato').serialize());
    $.ajax({
      url: '../modal/create.php',
      method: 'post',
      data: $('#form_contato').serialize(),
      success: function (data) {
        console.log('  data :::: ', data);
        //console.log('modal criacao',data );
        const validacao = JSON.parse(data);
        console.log('modal criacao :::::: ', validacao);
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