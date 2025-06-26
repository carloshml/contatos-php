document.addEventListener("DOMContentLoaded", function () {


  $('#btn_salvar_contato_sem_session').click(function () {
    console.log($('#form_contato').serialize());
    $.ajax({
      url: '../modal/create.php',
      method: 'post',
      data: $('#form_contato').serialize(),
      success: function (data) {
        const validacao = JSON.parse(data);
        console.log('modal criacao :::::: ', validacao);
        if (validacao[0].valido) {
          escreverMensagemNaTela('Usuário Salvo!');
          window.location.href = '../index.php';
          return;

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
});
