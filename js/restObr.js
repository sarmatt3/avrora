let rest = document.getElementById("restaurant")
    rest.addEventListener("change", f)

    function f(){
        console.log(document.getElementById("restaurant").value)
    }