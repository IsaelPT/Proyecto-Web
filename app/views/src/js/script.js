// Botón y menú para Doctores
const inicioBtnDoc = document.querySelector('#inicio-btn-doctores');
const inicioMenuDoc = document.querySelector('#inicio-menu-doctores');

// Mostrar/Ocultar el menú al hacer clic en "Doctores"
inicioBtnDoc.addEventListener('click', () => {
  inicioMenuDoc.classList.toggle('hidden');
});

// Cerrar el menú si se hace clic fuera del botón o menú "Doctores"
document.addEventListener('click', (event) => {
  if (!inicioBtnDoc.contains(event.target) && !inicioMenuDoc.contains(event.target)) {
    inicioMenuDoc.classList.add('hidden');
  }
});

// Botón y menú para Pacientes
const inicioBtnPac = document.querySelector('#inicio-btn-pacientes');
const inicioMenuPac = document.querySelector('#inicio-menu-pacientes');

// Mostrar/Ocultar el menú al hacer clic en "Pacientes"
inicioBtnPac.addEventListener('click', () => {
  inicioMenuPac.classList.toggle('hidden');
});

// Cerrar el menú si se hace clic fuera del botón o menú "Pacientes"
document.addEventListener('click', (event) => {
  if (!inicioBtnPac.contains(event.target) && !inicioMenuPac.contains(event.target)) {
    inicioMenuPac.classList.add('hidden');
  }
});

document.addEventListener("DOMContentLoaded", () => {
    const btnFlotante = document.querySelector('.btn-flotante');
    const footer = document.querySelector('#footer');
    const form = document.querySelector("form");
    const nombre = document.querySelector("#nombre");
    const apellido1 = document.querySelector("#apellido_1");
    const apellido2 = document.querySelector("#apellido_2");
    const seguro = document.getElementById("seguro");

    const alfanumerico = /^[a-zA-Z0-9]{8}$/;
    const soloLetras = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/; // Expresión regular para solo letras y espacios

    btnFlotante.addEventListener('click', () => {
        if (footer.classList.contains('hidden')) {
            footer.classList.remove('hidden');
            footer.classList.add('block');
            btnFlotante.textContent = 'Cerrar';
        } else {
            footer.classList.add('hidden');
            footer.classList.remove('block');
            btnFlotante.textContent = 'Información';
        }
    })
   
    form.addEventListener("submit", (event) => {
        let isValid=true;

        // Validar el campo "nombre"
        if (!soloLetras.test(nombre.value)) {
            isValid=false;
            showError(nombre, "El nombre solo debe contener letras");
        } else {
            clearError(nombre);
        }

        // Validar el campo "apellido_1"
         if (!soloLetras.test(apellido1.value)) {
            isValid=false;
            showError(apellido1, "El primer apellido solo debe contener letras");
        } else {
            clearError(apellido1);
        }

        // Validar el campo "apellido_2"
        if (!soloLetras.test(apellido2.value)) {
            isValid=false;
            showError(apellido2, "El segundo apellido solo debe contener letras");
        } else {
            clearError(apellido2);
        }


        // Validar el campo "seguro"
        if(seguro){
            if (!alfanumerico.test(seguro.value)) {
                isValid = false;
                showError(seguro, "El código debe contener solo números y letras (mín. 8 caracteres)");
            } else {
                clearError(seguro);
            }
        }

        // Prevenir el envío del formulario si no pasa la validación
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Mostrar mensaje de error
    function showError(input, message) {
        clearError(input);
        const error = document.createElement("p");
        error.classList.add("text-red-500", "text-sm", "mt-1");
        error.textContent = message;
        input.classList.add("border-red-500");
        input.parentElement.appendChild(error);
    }

    // Limpiar el mensaje de error
    function clearError(input) {
        input.classList.remove("border-red-500");
        const error = input.parentElement.querySelector(".text-red-500");
        if (error) {
            error.remove();
        }
    };
});
