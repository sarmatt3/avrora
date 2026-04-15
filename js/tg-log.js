window.document.getElementById("tg-log").addEventListener("click", async e => {
    
    const status = true
    const response = await fetch("./php/tg-log.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({status})
    });
    btn = window.document.getElementById("tg-log")
    const result = await response.json();
    if (!result.success){
        btn.innerText = result.error
        btn.style.backgroundColor = "#ff000050"
        btn.style.border = "2px solid #ff0000"
        setTimeout(() => {
            btn.innerText = "Вход в телеграм"
            btn.style.backgroundColor = ""
            btn.style.border = ""
        }, 2000)
    }else{
        btn.innerText = result.code
        btn.disabled = true
    }

})