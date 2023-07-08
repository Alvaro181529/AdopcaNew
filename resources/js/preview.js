document.addEventListener('DOMContentLoaded', function () {
    var fileInput = document.getElementById('file_input');
    fileInput.addEventListener('change', previewImage);
});

function previewImage(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var previewElement = document.getElementById('preview');
            previewElement.src = e.target.result;
            previewElement.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}