document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const loadingDiv = document.getElementById('loading');
    const section = document.getElementById('section');
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Ngăn form submit ngay lập tức

        // Hiển thị loading
        loadingDiv.style.display = 'flex';
        section.style.display = 'none'; //

        // Sau 2 giây (giả lập quá trình xử lý), chuyển đến trang chủ
        setTimeout(() => {
            loginForm.submit(); // Submit form sau khi đã hiển thị loading
        }, 2000); // Bạn có thể thay đổi thời gian này tùy theo thời gian xử lý thực tế
    });
});
