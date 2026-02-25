const cari = document.getElementById("cari");


cari.addEventListener("click", () => {
    fetch("api/pencarian.php?Search=awdawda")
    .then(kirim => kirim.json())
    .then(data => {
        console.log(data.error),
        alert("Anda mencari " + data.status)
    })
})