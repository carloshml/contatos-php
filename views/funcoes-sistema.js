function escreverMensagemNaTela(msg) {
  const container = $('#mensagem-upload');

      console.log(' container ::::::   ', container);


  container.html('<span class="text-success">' + msg + '</span>');
  container.fadeIn(300);
  setTimeout(() => {
    container.fadeOut(300, function () {
      container.html('');
    });
  }, 1500);
}