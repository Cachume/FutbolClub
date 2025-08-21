$(document).ready(function() {
    $("#modal-category-form").submit(function(event) {
        alert("asdasdasdsad");
    })


    $("#nombre_categoria").on('input', function() {
        var categoriaSeleccionada = $(this).val();
        $.ajax({
            type: "POST",
            url: "/FutbolClub/administrador/vefCategory",
            data: { categoria: categoriaSeleccionada },
            dataType: "json",
            success: function (response) {
                if(response['message']){
                    console.log(response)
                    $("#nombre_categoria").addClass("input-error");
                    $("#nombre_categoria").removeClass("input-success");
                }else{
                    console.log(response)
                    $("#nombre_categoria").removeClass("input-error");
                    $("#nombre_categoria").addClass("input-success");
                }
            }
        });
    });


    $("#add-category-button").on("click", function () {
        $(".modal-category").css("display", "flex");
    });

    // Abrir modal con datos dinámicos
    $(".delete-button").on("click", function () {
        let id = $(this).data("id");
        let name = $(this).data("name");

        $("#deleteId").val(id);
        $("#categoryName").text(name);
        $("#deleteModal").css("display", "flex");    
    });

    // Cerrar modal
    $("#cancelDelete").on("click", function () {
        $("#deleteModal").fadeOut();
    });
    
     $("#confirmDelete").on("click", function () {
    let id = $("#deleteId").val();
        $.ajax({
        url: "/FutbolClub/administrador/categoryDelete",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if(response['message']){
                alert("Categoria eliminada correctamente ✅");
                window.location.href = "/FutbolClub/administrador/categorias?success=" + encodeURIComponent(response.message);
            }else {
                alert("Error al eliminar la categoria ❌");
                window.location.href = "/FutbolClub/administrador/categorias?error=" + encodeURIComponent(response.message);
            }
        },
        error: function () {
            alert("Error al eliminar ❌");
        }
        });
    });

});