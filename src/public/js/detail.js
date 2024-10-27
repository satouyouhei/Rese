document.addEventListener("DOMContentLoaded", function() {
  // すべてのrating__star要素を取得
    const stars = document.querySelectorAll('.rating__star');

    stars.forEach(star => {
    // data-rate属性の値を取得
    const rate = parseFloat(star.getAttribute('data-rate'));
    // 幅を計算（例：4.8 => 96%）
    const width = Math.floor((rate / 5) * 100);
    // ::after疑似要素に直接スタイルを適用するのは難しいため、インラインスタイルを使用
    star.style.setProperty('--star-width', `${width}%`);
    });
});