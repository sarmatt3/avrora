function showError(error) {
    err = document.getElementById("error-c")
    txt = document.getElementById("error-c-p")
    err.style.display = "block"
    txt.innerText = error

    setTimeout(() => {
        err.style.display = "none"
        txt.innerText = ""
    }, 5000)
}

window.document.getElementById("appeal-form").addEventListener("submit", async e => {
    e.preventDefault()

    const fullname = document.getElementById("name_adv").value
    const id = document.getElementById("recipient").value
    const email = document.getElementById("email").value
    const text = document.getElementById("advise").value

    const response = await fetch("./php/appeal.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id, fullname, email, text })
    })

    const result = await response.json()
    if (!result.success) {
        showError(result.error)
    }

    else {
        let notif = document.getElementById("notification")
        notif.style.display = "block"

        txt = document.getElementById("appeal-id").innerText = "Номер Вашего обращения: " + result.id
    }

})