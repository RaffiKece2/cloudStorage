const login = document.getElementById("login");


login.addEventListener("click", () => {
    fetch("api/tambah.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            nama: "Raffi Putra",
            password: "subscribe123"
        })

    })

    .then(kirim_data => kirim_data.json())
    .then(data => {
        console.log(data.error);
        if (data.status) {
            alert(data.status),
            alert("Halo " + data.nama)
        }else {
            alert(data.pesan);

        }
     
    })
})