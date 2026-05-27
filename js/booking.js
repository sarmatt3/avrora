function viewResult(result){
    let mess = document.getElementById("notification")
        let prest = document.getElementById("rest-p")
        let ptime = document.getElementById("date-time-p")
        let ptable = document.getElementById("table-p")
        let pcode = document.getElementById("code-p")
        let paddress = document.getElementById("address-p")

        prest.innerText = result.result["rest"]
        ptime.innerText = result.result["date-time"]
        ptable.innerText = result.result["table"]
        pcode.innerText = result.result["code"]
        paddress.innerText = result.result["address"]

        mess.style.display = "block"


}
document.getElementById("rest").addEventListener("change", restValChange);
document.getElementById("date").addEventListener("change", dateValChange);
document.getElementById("time").addEventListener("change", timeValChange);
document.getElementById("booking-form").addEventListener("submit", async e => {
    e.preventDefault()
    let restaurant = document.getElementById("rest").value
    let time = document.getElementById("time").value
    let date = document.getElementById("date").value
    let fullname = document.getElementById("fullname").value
    let phone = document.getElementById("phone").value
    let book_id = document.getElementById("table").value
    type = "submit"

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ type, time, date, restaurant, fullname, phone, book_id })
    });

    const result = await response.json();

    if (!result.success) {
        console.log(result.error)
    }

    else {
        viewResult(result)
    }

});

function showSuccess(text){
    let popup = document.getElementById("popup")
        let txt = document.getElementById("popuptext")
        let icon = document.getElementById("icon")
        let icon_d = document.getElementById("icon_d")
        icon.innerText = "close"
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

async function restValChange() {
    let restaurant = document.getElementById("rest").value
    let date = document.getElementById("date")
    let time = document.getElementById("time")
    let table = document.getElementById("table")
    if (restaurant == "") {
        date.value = "";
        date.setAttribute("disabled", "disabled")
        date.innerHTML = ""
        date.innerHTML = "<option value=''>-- Сначала выберите ресторан --</option>"

        time.value = "";
        time.setAttribute("disabled", "disabled")
        time.innerHTML = ""
        time.innerHTML = "<option value=''>-- Сначала выберите дату --</option>"

        table.value = "";
        table.setAttribute("disabled", "disabled")
        table.innerHTML = ""
        table.innerHTML = "<option value=''>-- Сначала выберите время --</option>"
        return
    }
    type = "date"

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ type, restaurant })
    });

    const result = await response.json();

    if (!result.success) {
        console.log(result.error)
    }
    else {
        date.innerHTML = ""
        date.removeAttribute("disabled")

        for (element in result.result) {
            let option = document.createElement("option")
            let i = result.result[element].date
            option.textContent = i
            option.value = i
            date.appendChild(option)
        }
    }

}


async function dateValChange() {
    let restaurant = document.getElementById("rest").value
    let date = document.getElementById("date").value
    let time = document.getElementById("time")

    type = "time"

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ type, date, restaurant })
    });

    const result = await response.json();

    if (!result.success) {
        console.log(result.error)
    }
    else {
        time.innerHTML = ""
        time.removeAttribute("disabled")

        for (element in result.result) {
            let option = document.createElement("option")
            let i = result.result[element].time
            option.textContent = i
            option.value = i
            time.appendChild(option)
        }
    }

}


async function timeValChange() {
    let restaurant = document.getElementById("rest").value
    let time = document.getElementById("time").value
    let date = document.getElementById("date").value
    let table = document.getElementById("table")

    type = "table"

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ type, time, date, restaurant })
    });

    const result = await response.json();

    if (!result.success) {
        console.log(result.error)
    }
    else {
        table.innerHTML = ""
        table.removeAttribute("disabled")

        for (element in result.result) {
            let option = document.createElement("option")
            let i = result.result[element]["table"]
            option.textContent = "Стол № " + i
            option.value = result.result[element].id
            table.appendChild(option)
        }
    }

}


document.getElementById("unbooking").addEventListener("submit", async e => {
    e.preventDefault()
    let phone_u = document.getElementById("phone-unbooking").value
    let code_u = document.getElementById("code-unbooking").value
    let type = "unbooking"

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ type, phone_u, code_u })
    });

    const result = await response.json();

    if (!result.success) {
        showError(result.error)
    } else{
        
        showSuccess("Ваша бронь " + code_u + " успешно отменена!")
    }



})

document.getElementById("search").addEventListener("submit", async e => {
    e.preventDefault()
    let phone_s = document.getElementById("phone_sr").value
    
    let type = "search"

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ type, phone_s })
    });

    const result = await response.json();

    if (!result.success) {
        showError(result.error)
    } else{
        let mess = document.getElementById("notification")
        let prest = document.getElementById("rest-p")
        let ptime = document.getElementById("date-time-p")
        let ptable = document.getElementById("table-p")
        let pcode = document.getElementById("code-p")
        let paddress = document.getElementById("address-p")

        prest.innerText = result.result["restaurant"]
        ptime.innerText = result.result["date"] + " " + result.result["time"]
        ptable.innerText = "Стол №" + result.result["table_"]
        pcode.innerText = result.result["code"]
        paddress.innerText = result.result["address"]

        mess.style.display = "block"
    }



})