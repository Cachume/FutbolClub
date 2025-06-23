const loginform = document.getElementById("login-form");
const email = document.getElementById("email");
const password = document.getElementById("password");

loginform.addEventListener("submit",function(e) {

    if (emailValidation(email) && passwordValidation(password)) {
        alert("Login realizado com sucesso!");
    } else {
        alert("Por favor, preencha os campos corretamente.");
        e.preventDefault();
    }
})


function emailValidation(email) {
    const caracteres = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    if (caracteres.test(email.value.trim())){
        email.style.border = '3px solid #32bc59';
        email.setAttribute("title", "Email válido");
        return true;
    } else {
        email.style.border = '3px solid red';
        email.setAttribute("title", "Email inválido");
        return false;
    }
}

email.addEventListener("input", function() {
    emailValidation(this);
});

function passwordValidation(password) {
    const caracteres =/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[.$%#&]).{1,}$/;
    if (caracteres.test(password.value.trim())){
        password.style.border = '3px solid #32bc59';
        password.setAttribute("title", "Email válido");
        return true;
    } else {
        password.style.border = '3px solid red';
        password.setAttribute("title", "Email inválido");
        return false;
    }
}

password.addEventListener("input", function() {
    passwordValidation(this);
});