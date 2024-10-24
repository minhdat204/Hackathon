document.addEventListener('DOMContentLoaded', function() {
    // Lấy tất cả các phần tử có class là 'error__close'
    const closeButtons = document.querySelectorAll('.error__close');

    closeButtons.forEach(function(button) {
        // Thêm sự kiện click vào mỗi nút 'close'
        button.addEventListener('click', function() {
            // Tìm phần tử cha có class là 'error' để ẩn nó
            const errorBox = this.closest('.error');
            if (errorBox) {
                errorBox.style.display = 'none'; // Ẩn thông báo lỗi
            }
        });
    });
});
