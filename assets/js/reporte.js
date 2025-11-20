// La función se ejecuta una vez que el DOM esté completamente cargado
$(document).ready(function() {
  
  // 1. Manejar el evento 'change' en el selector principal
  $('#tipoReporte').on('change', function() {
    const valorSeleccionado = $(this).val(); // 'jugadores', 'asistencia', etc.
    
    // Ocultar todos los formularios de reporte y mostrar el mensaje inicial por defecto
    $('.reporte-form').hide();
    $('#mensajeInicio').show();
    
    // Si hay un valor seleccionado (no es la opción vacía)
    if (valorSeleccionado) {
      // Ocultar el mensaje de inicio
      $('#mensajeInicio').hide();
      
      // Mostrar el formulario específico usando el valor
      const idDelFormulario = '#form-' + valorSeleccionado;
      $(idDelFormulario).show(); 
    }
  });

})