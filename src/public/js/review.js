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