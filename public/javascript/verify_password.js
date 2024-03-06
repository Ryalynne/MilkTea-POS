
document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("password_confirmation");
    const registerButton = document.querySelector("button[type='submit']");
    const errorContainer = document.createElement("div");
    errorContainer.classList.add("text-red-500", "text-sm", "mt-1");
    confirmPasswordInput.parentNode.appendChild(errorContainer);

    function validatePassword() {
        if (passwordInput.value !== confirmPasswordInput.value) {
            errorContainer.innerText = "Passwords do not match";
            confirmPasswordInput.classList.add("border-red-500");
            registerButton.disabled = true;
        } else {
            errorContainer.innerText = "";
            confirmPasswordInput.classList.remove("border-red-500");
            registerButton.disabled = false;
        }
    }

    passwordInput.addEventListener("input", validatePassword);
    confirmPasswordInput.addEventListener("input", validatePassword);
});

