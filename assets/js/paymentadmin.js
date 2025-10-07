$(document).ready(function() {
        $('.vef_pago').on('click', function() {
            var paymentId = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "/FutbolClub/administrador/verificarpago?id=" + paymentId,
                data: {},
                dataType: "json",
                success: function (response) {
                    if (response.message) {
                        toastr.success('Pago verificado correctamente.');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Error al verificar el pago.');
                    }
                }
            });
        });
        $('.reject_pago').on('click', function() {
            var paymentId = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "/FutbolClub/administrador/rechazarpago?id=" + paymentId,
                data: {},
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.message) {
                        toastr.success('Pago rechazado correctamente.');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('Error al rechazar el pago.');
                    }
                },
                error: function() {
                    console.log(error);
                    toastr.error('Error al rechazar el pago.');
                }
            });
        });
    });
