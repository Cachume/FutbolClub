document.getElementById("player-image").addEventListener("change",function (event) {
    const file = event.target.files[0]
    const preview = document.getElementById("np-preview")

    if(file){
        const reader = new FileReader()
        reader.onload = function(e){
            preview.src = e.target.result
        }
        reader.readAsDataURL(file);
    }else{
        preview.src = "../../assets/img/no-fotos.png";
    }

    console.log(file)
})

function filtrarTabla() {
  const input = document.getElementById("search-player").value.trim().toLowerCase();
  const filas = document.querySelectorAll("#player-table tbody tr");

  filas.forEach(fila => {
    const cedula = fila.cells[4].textContent.trim().toLowerCase(); // Columna 5 (Cédula)
    
    // Mostrar si la cédula comienza con lo escrito o es exactamente igual
    fila.style.display = (cedula.startsWith(input)) ? "" : "none";
  });
}
