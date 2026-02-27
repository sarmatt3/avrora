document.getElementById("rest").addEventListener("change", async e => {
    let rest = document.getElementById("rest").value;
    let date_time = document.getElementById("date-time");
    let type = "date"
    if (rest == ""){
        date_time.value = '';
        date_time.setAttribute("disabled", "disabled")
        date_time.innerHTML = "";
        date_time.innerHTML = '<option value="">-- Сначала выберите ресторан --</option>';
        return;
    }

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({type, rest})
    })

    const result = await response.json();
    if (!result.success) {
        
    }

    else{
        date_time.removeAttribute("disabled");
        date_time.innerHTML = "";
        for (i in result.result){
            
            let option = document.createElement("option");
            option.value = result.result[i].date;
            option.textContent = result.result[i].date
            date_time.appendChild(option)

        }
        
    }

})
    
document.getElementById("date-time").addEventListener("change", async e => {
    let date = document.getElementById("date-time").value;
    let time = document.getElementById("time");
    let type = "time"
    if (date == ""){
        time.value = '';
        time.setAttribute("disabled", "disabled")
        time.innerHTML = "";
        time.innerHTML = '<option value="">-- Сначала выберите дату --</option>';
        return;
    }

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({type, date})
    })

    const result = await response.json();
    if (!result.success) {
        
    }

    else{
        time.removeAttribute("disabled");
        time.innerHTML = "";
        for (i in result.result){
            
            let option = document.createElement("option");
            option.value = result.result[i].id;
            option.textContent = result.result[i].time
            time.appendChild(option)

        }
        
    }

})


document.getElementById("booking-form").addEventListener("submit", async e => {
    e.preventDefault();
    const time_id = document.getElementById("time").value;
    const restaurant = document.getElementById("rest").value;
    const full_name = document.getElementById("fullname").value;
    const phone = document.getElementById("phone").value;

    let prest = document.getElementById("rest-p")
    let pdatetime = document.getElementById("date-time-p")
    let pcode = document.getElementById("code-p")
    let padd = document.getElementById("address-p")
    let type = "submit";

    

    const response = await fetch("./php/booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({type, time_id, full_name, phone, restaurant})
    })

    const result = await response.json();
    if (!result.success) {
        console.log("error " + result.error)
    } else{
        prest.innerText = result.result["rest"]
        pdatetime.innerText = result.result["date-time"]
        padd.innerText = result.result["code"]
        pcode.innerText = result.result["address"]
        document.getElementById("notification").style.display = 'block'
        console.log("success" + "\n" + result.result["code"])
    }
})