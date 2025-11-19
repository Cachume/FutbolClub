$(document).ready(function() {
const form = $(".modal-category-form")
form.on('submit', function(e) {
    e.preventDefault();
    const formData = form.serialize();
    $.ajax({
        type: "POST",
        url: "/FutbolClub/administrador/crearpartido",
        data: formData,
        dataType: "json",
        success: function (response) {
            if(response.success){
                toastr.success('Partido creado correctamente.');
                $(".modal-category").fadeOut();
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }else{
                toastr.error('No se ha podido crear el partido');
            }
        }
    });

    })
})