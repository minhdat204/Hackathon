document.getElementById("voteButton").addEventListener("click", function() {
    const button = this;

    // Chuyển sang trạng thái "Cảm ơn bạn"
    button.innerHTML = "Cảm ơn bạn";
    button.classList.add('thank-you');

    // Sau 2 giây, chuyển sang trạng thái "Đã bình chọn"
    setTimeout(function() {
        button.innerHTML = "Đã bình chọn";
        button.classList.remove('thank-you');
        button.classList.add('voted');
    }, 2000);
});
