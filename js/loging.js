function showError(error) {
    let errorLabel = document.getElementById("error");
    errorLabel.innerText = error;
    errorLabel.style.display = "block"

    setTimeout(() => {
        errorLabel.innerText = "";
        errorLabel.style.display = ""
    }, 3000)
}

window.document.getElementById("login_form").addEventListener("submit", async e => {
    e.preventDefault();
    const login = document.getElementById("login").value.toUpperCase();
    const pass = document.getElementById("password").value;
    const response = await fetch("./php/loging.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({login, pass})
    });

    const result = await response.json();
    if (!result.success) {
        showError(result.error);
    }

    else{
        window.location.href = 'profile.php';
    }

})