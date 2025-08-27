$(document).ready(function() {

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
                $("#trainer-names").val(response.data.nombre_completo);
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
    $("#trainer-id").val(id);
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
                data: { email: valor, id: $("#trainer-id").val() },
                dataType: "json",
                success: function (response) {
                    if (response.exists) {
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
                data: { dni: valor, id: $("#trainer-id").val() },
                dataType: "json",
                success: function (response) {
                    if (response.exists) {
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

  $(".modal-category-form input").on("blur", function () {
      console.log($(this).val());
      validarCampo($(this));

  });

  $(".delete-trainer").on("click", function () {
        let id = $(this).data("id");
        let name = $(this).data("name");

        $("#deleteId").val(id);
        $("#trainerName").text(name);
        $("#deleteModal").css("display", "flex");    
    });

    $("#cancelDelete").on("click", function () {
        $("#deleteModal").fadeOut();
    });
    
     $("#confirmDelete").on("click", function () {
    let id = $("#deleteId").val();
        $.ajax({
        url: "/FutbolClub/administrador/TrainerDelete",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if(response['message']){
                toastr.success('Entrenador ' + $("#trainerName").text() + ' eliminado correctamente.');
                $(".modal-category").fadeOut();
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }else {
                toastr.error('Error ' + $("#trainerName").text() + ' al eliminar el entrenador.');
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