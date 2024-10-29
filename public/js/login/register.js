
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.setAttribute("name", "eye-outline");
        } else {
            passwordInput.type = "password";
            eyeIcon.setAttribute("name", "eye-off-outline");
        }
    }

    function toggleConfirmPassword() {
        const passwordConfirmInput = document.getElementById("password_confirmation");
        const eyeIconConfirm = document.getElementById("eye-icon-confirm");

        if (passwordConfirmInput.type === "password") {
            passwordConfirmInput.type = "text";
            eyeIconConfirm.setAttribute("name", "eye-outline");
        } else {
            passwordConfirmInput.type = "password";
            eyeIconConfirm.setAttribute("name", "eye-off-outline");
        }
    }

    // Validate form
    document.getElementById('register-form').addEventListener('submit', function(event) {
        let formValid = true;
        const fields = ['username', 'password', 'password_confirmation', 'name'];

        // Loop through each field for validation
        fields.forEach(field => {
            const fieldValue = document.getElementById(field).value.trim();
            const errorField = document.getElementById(`${field}-error`);

            if (!fieldValue) {
                errorField.textContent = `Vui lòng nhập ${field}.`;
                formValid = false;
            } else {
                errorField.textContent = '';
            }
        });

        // Prevent form submission if invalid
        if (!formValid) {
            event.preventDefault();
        }
    });

    // Xóa thông báo lỗi khi người dùng nhấp vào input
    const fields = ['username', 'password', 'password_confirmation', 'name'];

    // Add event listeners for each field
    fields.forEach(field => {
        document.getElementById(field).addEventListener('focus', function() {
            document.getElementById(`${field}-error`).textContent = '';  // Clear error message on focus
        });
    });
