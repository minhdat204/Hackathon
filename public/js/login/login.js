
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text"; // Hiện mật khẩu
        eyeIcon.setAttribute("name", "eye-outline"); // Thay đổi biểu tượng thành mắt mở
    } else {
        passwordInput.type = "password"; // Ẩn mật khẩu
        eyeIcon.setAttribute("name", "eye-off-outline"); // Thay đổi biểu tượng thành mắt đóng
    }
}
document.getElementById('login-form').addEventListener('submit', function(event) {
    let username = document.getElementById('username').value.trim();
    let password = document.getElementById('password').value.trim();
    let usernameError = document.getElementById('username-error');
    let passwordError = document.getElementById('password-error');
    let formValid = true;

    usernameError.textContent = ''; // Reset lỗi
    passwordError.textContent = '';

    // Kiểm tra nếu không nhập username
    if (!username) {
        usernameError.textContent = 'Vui lòng nhập username.';
        formValid = false;
    }

    // Kiểm tra nếu không nhập password nhưng đã nhập username
    if (!password && username) {
        passwordError.textContent = 'Vui lòng nhập password.';
        formValid = false;
    }

    if (!formValid) {
        event.preventDefault(); // Ngăn form gửi nếu có lỗi
    }
});

// Xóa thông báo lỗi khi người dùng nhấn vào input
document.getElementById('username').addEventListener('focus', function() {
    document.getElementById('username-error').textContent = '';
});

document.getElementById('password').addEventListener('focus', function() {
    document.getElementById('password-error').textContent = '';
});
