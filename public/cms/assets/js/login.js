document.addEventListener("DOMContentLoaded", function () {
    const timerElement = document.getElementById("timer");
    const timeElement = document.getElementById("time");
    const loginButton = document.getElementById("loginButton");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    if (timerElement && timeElement) {
        console.log("indide");

        let remainingTime = parseInt(timeElement.textContent);

        // Disable the inputs and button
        loginButton.disabled = true;
        loginButton.style.pointerEvents = "none";
        loginButton.style.opacity = "0.5";
        emailInput.disabled = true;
        passwordInput.disabled = true;

        // Start countdown
        const countdown = setInterval(() => {
            remainingTime--;
            timeElement.textContent = remainingTime;

            if (remainingTime <= 0) {
                clearInterval(countdown);
                timerElement.style.display = "none";

                // Enable the inputs and button
                loginButton.disabled = false;
                loginButton.style.pointerEvents = "auto";
                loginButton.style.opacity = "1";
                emailInput.disabled = false;
                passwordInput.disabled = false;

                const errorMessage = document.getElementById("error-message");
                if (errorMessage) {
                    errorMessage.style.display = "none";
                }
            }
        }, 1000);
    }

    document.querySelectorAll("input").forEach((input) => {
        input.addEventListener("focus", () => {
            const errorMessage = document.getElementById("error-message");
            if (errorMessage) {
                errorMessage.style.display = "none";
            }
        });
    });
});
