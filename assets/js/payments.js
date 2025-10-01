const select = document.getElementById("metodo_pago");
const metodos = document.querySelectorAll(".metodo");
const paymentData = document.getElementById("payment-data"); 
const formButtons = document.getElementById("form-buttons");
  select.addEventListener("change", function () {
    metodos.forEach(m => m.style.display = "none");
    if (this.value) {
      const seleccionados = document.querySelectorAll("." + this.value);
      seleccionados.forEach(m => m.style.display = "flex");
    }

    if (this.value && this.value !== "efectivo") {
      paymentData.style.display = "flex";
      document.getElementById("titlepay").style.display = "block"
    } else {
      paymentData.style.display = "none";
      document.getElementById("titlepay").style.display = "none"
    }

    if (this.value !== "") {
        formButtons.style.display = "flex";
    } else {
        formButtons.style.display = "none"; 
    }
  });