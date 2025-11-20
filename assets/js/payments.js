const select = document.getElementById("metodo_pago");
const metodos = document.querySelectorAll(".metodo");
const paymentData = document.getElementById("payment-data");
const formButtons = document.getElementById("form-buttons");

// 1. Obtener referencias a los campos requeridos
const fechaPagoInput = document.querySelector('[name="fecha_pago"]');
const referenciaInput = document.querySelector('[name="referencia"]');
const comprobanteInput = document.querySelector('[name="comprobante"]');

select.addEventListener("change", function () {
    metodos.forEach(m => m.style.display = "none");

    if (this.value) {
        document.getElementById("metodo_pago_hidden").value = this.value;
        const seleccionados = document.querySelectorAll("." + this.value);
        seleccionados.forEach(m => m.style.display = "flex");
    }

    // Lógica principal de visibilidad y 'required'
    if (this.value && this.value !== "efectivo") {
        // Mostrar campos para otros métodos (Ej: Transferencia)
        paymentData.style.display = "flex";
        document.getElementById("titlepay").style.display = "block";
        
        // **AÑADIR: Establecer 'required' para los métodos que lo necesitan**
        fechaPagoInput.setAttribute('required', 'required');
        referenciaInput.setAttribute('required', 'required');
        comprobanteInput.setAttribute('required', 'required');

    } else {
        // Ocultar campos para Efectivo
        paymentData.style.display = "none";
        document.getElementById("titlepay").style.display = "none";

        fechaPagoInput.removeAttribute('required');
        referenciaInput.removeAttribute('required');
        comprobanteInput.removeAttribute('required');
    }

    if (this.value !== "") {
        formButtons.style.display = "flex";
    } else {
        formButtons.style.display = "none";
    }
});