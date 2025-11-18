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

$(document).ready(function() {
    var dni = $(".player-dni");
    var pn = $(".player-pn");
    $("#player-birthdate").on('input',function(){
        let fechaNac = $(this).val();
        if(!fechaNac){
          alert("Por favor ingresa una fecha válida.");
          return;
        }
        let nacimiento = new Date(fechaNac);
        let hoy = new Date();

        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        let mes = hoy.getMonth() - nacimiento.getMonth();
        let dia = hoy.getDate() - nacimiento.getDate();
        if (mes < 0 || (mes === 0 && dia < 0)) {
          edad--;
        }
        console.log(edad)
        if (edad <= 9 && edad >= 4){
            pn.css("display","flex")
            dni.css("display","none")
            $("#player-dni").prop('disabled', true).prop('required', false)
            $("#player-pn").prop('disabled', false).prop('required', true);
        }else if(edad>9 && edad<18){
            pn.css("display","none")
            dni.css("display","flex")
            $("#player-dni").prop('disabled', false).prop('required', true);
            $("#player-pn").prop('disabled', true).prop('required', false);
        }else{
            pn.css("display","none")
            dni.css("display","none")
        }
    })

    $("#player-dni").on("input",function(){
        var len = $(this).val();
        if(len.length > 8){
            $(this).val(len.substring(0,8))
        }
    })
    $("#player-pn").on("input",function(){
        var len = $(this).val();
        if(len.length > 4){
            $(this).val(len.substring(0,4))
        }
    })

})