
function showError(error) {

    let popup = document.getElementById("popup")
        let txt = document.getElementById("popuptext")
        let icon = document.getElementById("icon")
        let icon_d = document.getElementById("icon_d")
        icon.innerText = "close"
        icon.style.color = "#cc0000"
        popup.style.display = "flex"
        popup.style.backgroundColor = "#ffafaf"
        
        txt.innerText = error

    setTimeout(() => {
        popup.style.display = "none"
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
    } else if (result.role === "avr") {
        window.location.href = 'profile.php';
    } else if (result.role === "admin") {
        window.location.href = 'admin.php';
    }
});