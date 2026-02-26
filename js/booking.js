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