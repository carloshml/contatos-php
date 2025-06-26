document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById('imagem_file');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImage = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function () {
                previewImage.src = this.result;
                previewContainer.style.display = 'block';
            });

            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });

    // Initialize with existing image if editing
    const urlParams = new URLSearchParams(window.location.search);
    const noticiaId = urlParams.get('noticia_id');
    loadNoticiaData(noticiaId);
    if (sucesso === 1) {
        escreverMensagemNaTela('Notícia salva com sucesso!');
    }
    if (erro && erro !== '0') {
        if (post.titulo) document.getElementById('titulo').value = post.titulo;
        if (post.texto) document.getElementById('texto').value = post.texto;
        if (post.tag1) document.getElementById('tag1').value = post.tag1;
        if (post.tag2) document.getElementById('tag2').value = post.tag2;
        if (post.tag3) document.getElementById('tag3').value = post.tag3;
        if (post.noticia_id) document.getElementById('noticia_id').value = post.noticia_id;
    }

    function loadNoticiaData(noticiaId) {
        $.ajax({
            url: '../controllers/noticia-get-by-id.php',
            type: 'GET',
            data: { noticia_id: noticiaId },
            success: function (noticia) {
                const previewContainer = document.getElementById('imagePreviewContainer');
                previewImage.src = 'data:image/jpeg;base64,' + noticia.noticia.foto;
                previewContainer.style.display = 'block';
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr, status, error);
            }
        });
    }

});

