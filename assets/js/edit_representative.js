$(document).ready(function() {

//Logica Modal
$(".edit-representative").on("click", function(){
    let id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: "/FutbolClub/administrador/get_representative",
        data: {id: id},
        dataType: "json",
        success: function (response) {
            if (response.success) {
                $(".modal-category").fadeIn().css("display", "flex");
                $("#nombre").val(response.data.nombre_completo);
                $("#fecha_nacimiento").val(response.data.fecha_nacimiento);
                $("#cedula").val(response.data.cedula);
                $("#telefono").val(response.data.telefono);
                $("#correo").val(response.data.correo);
                $("#direccion").val(response.data.direccion);
            } else {
                toastr.error('Error al obtener los datos del representante.');
            }
        },
        error: function () {
            toastr.error('Error en la solicitud AJAX.');
        }
    });
    $("#representative-id").val(id);
})

//Cerrar Modal
$(".close-modal").on("click", function(){
    $(".modal-category").fadeOut();
});

$(".modal-category-form input").on("blur", function () {
    console.log($(this).val());
    validarCampo($(this));

});

$(".modal-category-form").on("submit", function (e) {
        e.preventDefault(); 
        let valido = true;

        $(".modal-category-form input").each(function () {
          if (!validarCampo($(this))) {
            valido = false;
          }
        });

        if (valido) {
          $.ajax({
            type: "POST",
            url: "/FutbolClub/administrador/update_representative",
            data: $(".modal-category-form").serialize(),
            dataType: "json",
            success: function (response) {
              if (response.success) {
                toastr.success('Representante actualizado correctamente.');
                $(".modal-category").fadeOut();
                setTimeout(function() {
                    location.reload();
                }, 1000);
              } else {
                toastr.error(response.message || 'Error al actualizar el representante.');
              }
              console.log(response);
            },
            error: function () {
              toastr.error('Error en la solicitud AJAX.');
            }
          });
        } else {
            toastr.error('Por favor, corrige los errores en el formulario.');
        }
      });

function validarCampo($input) {
        let id = $input.attr("id");
        let valor = $input.val().trim();
        let valido = true;

        if (id === "nombre") {
          if (valor === "") {
            $input.next(".mensaje-error").text("El nombre es obligatorio");
            valido = false;
          } else {
            $input.next(".mensaje-error").text("");
          }
        }

        if (id === "email") {
          let regex = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
          if (!regex.test(valor)) {
            $input.next(".mensaje-error").text("Email inválido");
            valido = false;
          } else {
            $input.next(".mensaje-error").text("");
          }
        }

        if (id === "cedula") {
          if (!/^[0-9]{1,8}$/.test(valor)) {
            $input.next(".mensaje-error").text("Cédula debe ser solo números y máximo 8 dígitos");
            valido = false;
          } else {
            $input.next(".mensaje-error").text("");
          }
        }

        if (id === "telefono") {
          if (!/^[0-9]{1,11}$/.test(valor)) {
            $input.next(".mensaje-error").text("Teléfono debe ser solo números y máximo 11 dígitos");
            valido = false;
          } else {
            $input.next(".mensaje-error").text("");
          }
        }

        return valido;
    }

        // Limitar cédula a 8 dígitos
    $("#cedula").on("input", function () {
        let valor = $(this).val();
        if (valor.length > 8) {
        $(this).val(valor.slice(0, 8));
        }
    });

    // Limitar teléfono a 11 dígitos
    $("#telefono").on("input", function () {
        let valor = $(this).val();
        if (valor.length > 11) {
        $(this).val(valor.slice(0, 11));
        }
    });

    //eliminar
    $(".delete-representative").on("click", function () {
        let id = $(this).data("id");
        let name = $(this).data("name");

        $("#deleteId").val(id);
        $("#representativeName").text(name);
        $("#deleteModal").css("display", "flex");    
    });

    $("#cancelDelete").on("click", function () {
        $("#deleteModal").fadeOut();
    });
    
     $("#confirmDelete").on("click", function () {
    let id = $("#deleteId").val();
        $.ajax({
        url: "/FutbolClub/administrador/RepresentativeDelete",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if(response['message']){
                toastr.success('Representante ' + $("#representativeName").text() + ' eliminado correctamente.');
                $(".modal-category").fadeOut();
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }else {
                toastr.error('Error al eliminar el representante ' + $("#representativeName").text() + '.');
                 $(".modal-category").fadeOut();
                 setTimeout(function() {
                     location.reload();
                 }, 1000);
            }
        },
        error: function () {
            alert("Error al eliminar ❌");
        }
        });
    });

});