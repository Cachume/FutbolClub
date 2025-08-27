$(document).ready(function() {

$(".newplayers-form").on("submit", function (e) {
        e.preventDefault(); 
        let valido = true;

        $(".newplayers-form input").each(function () {
          if (!validarCampo($(this))) {
            valido = false;
          }
        });

        if (valido) {
            this.submit();
        } else {
            toastr.error('Por favor, corrige los errores en el formulario.');
        }
      });

    $(".newplayers-form input").on("blur", function () {
        console.log($(this).val());
        validarCampo($(this));
    });

    function validarCampo($input) {
        let id = $input.attr("id");
        let valor = $input.val().trim();
        let valido = true;

        if (id === "trainer-names") {
          if (valor === "") {
            toastr.error("El nombre es obligatorio");
            $input.css("border", "1px solid red");
            valido = false;
          } else {
            $input.css("border", "2px solid green");
          }
        }

        if (id === "trainer-email") {
          let regex = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
          if (!regex.test(valor)) {
            toastr.error("Correo Electrónico inválido");
            $input.css("border", "1px solid red");
            valido = false;
          } else {
            $.ajax({
                type: "POST",
                url: "/FutbolClub/administrador/usedEmail",
                data: { email: valor },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    if (response.message) {
                        toastr.error("Correo ya está en uso");
                        $input.css("border", "1px solid red");
                    } else {
                        $input.css("border", "2px solid green");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", status, error);
                }
            });
          }
        }

        if (id === "trainer-dni") {
          if (!/^[0-9]{7,8}$/.test(valor)) {
            toastr.error("Cédula debe ser solo números y máximo 8 dígitos");
            $input.css("border", "1px solid red");
            valido = false;
          } else {
            $.ajax({
                type: "POST",
                url: "/FutbolClub/administrador/usedDni",
                data: { dni: valor },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    if (response.message) {
                        toastr.error("Cédula ya está en uso");
                        $input.css("border", "1px solid red");
                    } else {
                        $input.css("border", "2px solid green");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", status, error);
                }
            });
          }

        }

        if (id === "trainer-phone") {
          if (!/^[0-9]{1,11}$/.test(valor)) {
            toastr.error("Teléfono debe ser solo números y máximo 11 dígitos");
            $input.css("border", "1px solid red");
            valido = false;
          } else {
            $input.css("border", "2px solid green");
          }
        }

        return valido;
    }

    $("#trainer-dni").on("input", function () {
        let valor = $(this).val();
        if (valor.length > 8) {
        $(this).val(valor.slice(0, 8));
        }
    });

    // Limitar teléfono a 11 dígitos
    $("#trainer-phone").on("input", function () {
        let valor = $(this).val();
        if (valor.length > 11) {
        $(this).val(valor.slice(0, 11));
        }
    });

    //Logica modal
    $(".edit-trainer").on("click", function(){
    let id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: "/FutbolClub/administrador/get_trainer",
        data: {id: id},
        dataType: "json",
        success: function (response) {
            if (response.success) {
                $(".modal-category").fadeIn().css("display", "flex");
                $("#trainer-names").val(response.data.trainer_nombre);
                $("#trainer-fecha_nacimiento").val(response.data.fecha_nacimiento);
                $("#trainer-dni").val(response.data.cedula);
                $("#trainer-phone").val(response.data.telefono);
                $("#trainer-email").val(response.data.correo);
                $("#trainer-direccion").val(response.data.direccion);
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
            url: "/FutbolClub/administrador/update_trainer",
            data: $(".modal-category-form").serialize(),
            dataType: "json",
            success: function (response) {
              if (response.success) {
                toastr.success('Entrenador actualizado correctamente.');
                $(".modal-category").fadeOut();
                setTimeout(function() {
                    location.reload();
                }, 1000);
              } else {
                toastr.error(response.message || 'Error al actualizar el entrenador.');
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

//Cerrar Modal
  $(".close-modal").on("click", function(){
      $(".modal-category").fadeOut();
  });

});