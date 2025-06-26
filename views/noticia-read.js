document.addEventListener("DOMContentLoaded", function () {
    const previewImage = document.getElementById('imagePreview');
    const urlParams = new URLSearchParams(window.location.search);
    const noticiaId = urlParams.get('noticia_id');
    loadNoticiaData(noticiaId);
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

