document.getElementById("text-input").addEventListener("input", function () {
    var text = this.value;
    document.getElementById("text-count").textContent =
        text.length + "/400(最高文字数)";
    if (text.length > 0) {
        this.style.backgroundColor = "white";
    } else {
        this.style.backgroundColor = "#eee";
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var input = document.querySelector('.input-file');
    var imageArea = document.querySelector('.image-area');
    var textArea = document.querySelector('.upload-text__area');
    var img = document.querySelector('.image-area__image');

    input.addEventListener('change', function (e) {
        var file = e.target.file[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var imageUrl = e.target.result;
            image.src = imageUrl;

            textArea.style.display = 'none';
            imageArea.style.display = 'block';
        }
        reader.readAsDataURL(file);
    });
    if (img.getAttribute('src')) {
        imageArea.style.display = none;
    }
});