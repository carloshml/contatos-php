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
    if (noticiaId) {
        loadNoticiaData(noticiaId);
    }

    if (sucesso === 1) {
        escreverMensagemNaTela('Notícia salva com sucesso!');
    }
    if (erro && erro !== '0') {
        if (noticia.titulo) document.getElementById('titulo').value = noticia.titulo;
        if (noticia.texto) document.getElementById('texto').value = noticia.texto;
        if (noticia.tag1) document.getElementById('tag1').value = noticia.tag1;
        if (noticia.tag2) document.getElementById('tag2').value = noticia.tag2;
        if (noticia.tag3) document.getElementById('tag3').value = noticia.tag3;
        if (noticia.noticia_id) document.getElementById('noticia_id').value = noticia.noticia_id;
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

