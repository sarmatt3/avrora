function showSuccess(text){
   
    let popup = document.getElementById("popup")
        let txt = document.getElementById("popuptext")
        let icon = document.getElementById("icon")
        let icon_d = document.getElementById("icon_d")
        icon.innerText = "check"
        icon.style.color = "#00cc2c"
        popup.style.display = "flex"
        popup.style.backgroundColor = "#afffc0"
        txt.innerText = text

        setTimeout(() => {
        popup.style.display = "none"
        
    }, 3000)
}

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

let adm = document.getElementById("adm_form")
let deladm = document.getElementsByName("delete_adm")

for(let i = 0; i < deladm.length; i ++){
deladm[i].addEventListener("click", async e => {
    let id = deladm[i].value
    let type = "delete_adm"

    const response = await fetch("./php/add-admin.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({type, id})
    });

    const result = await response.json();
    
    if (!result.success) {
        showError(result.error);
    }
    else{
        
        
        showSuccess(result.mes)
        

        
    }

})}

adm.addEventListener("submit", async e => {
    e.preventDefault()
    console.log("get")
    let fio = document.getElementById("fio").value
    let login = document.getElementById("login").value
    let prev = document.getElementById("prev").value
    let password = document.getElementById("password").value
    let r_password = document.getElementById("r_password").value
    let adm_pass = document.getElementById("adm_pass").value
    let type = "add_adm"
    const response = await fetch("./php/add-admin.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({type, fio, login, prev, password, r_password, adm_pass})
    });

    const result = await response.json();
    
    if (!result.success) {
        showError(result.error);
    }
    else{
        showSuccess(result.mes)
        setTimeout(() => {
            window.location.href = "admin.php";
        }, 1500)
    }
})