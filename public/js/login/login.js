
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
