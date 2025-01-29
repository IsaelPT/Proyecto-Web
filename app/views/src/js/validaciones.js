// const form = document.querySelector("form");
// const nombre = document.querySelector("#nombre");
// const apellido1 = document.querySelector("#apellido_1");
// const apellido2 = document.querySelector("#apellido_2");
// const seguro = document.getElementById("seguro");
// const diagnostico = document.getElementById("diagnostico");
// const especialidad = document.getElementById("especialidad");

// const alfanumerico = /^[a-zA-Z0-9]{8}$/;
// const soloLetras = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/; // Expresión regular para solo letras y espacios

// document.addEventListener("DOMContentLoaded", () => {
//   validaciones();
// });

// function validaciones(){

//   form.addEventListener("submit", (event) => {
//     let isValid = true;

//     // Validar el campo "nombre"
//     if (!soloLetras.test(nombre.value)) {
//       isValid = false;
//       showError(nombre, "El nombre solo debe contener letras.");
//     } else {
//       clearError(nombre);
//     }

//     // Validar el campo "apellido_1"
//     if (!soloLetras.test(apellido1.value)) {
//       isValid = false;
//       showError(apellido1, "El primer apellido solo debe contener letras.");
//     } else {
//       clearError(apellido1);
//     }

//     // Validar el campo "apellido_2"
//     if (!soloLetras.test(apellido2.value)) {
//       isValid = false;
//       showError(apellido2, "El segundo apellido solo debe contener letras.");
//     } else {
//       clearError(apellido2);
//     }

//     // Validar el campo "seguro"
//     if (seguro) {
//       if (!alfanumerico.test(seguro.value)) {
//         isValid = false;
//         showError(
//           seguro,
//           "El código debe contener solo números y letras (mín. 8 caracteres)."
//         );
//       } else {
//         clearError(seguro);
//       }
//     }

//     // Validar el campo "diagnostico"
//     if (!soloLetras.test(diagnostico.value)) {
//       isValid = false;
//       showError(diagnostico, "El diagnóstico solo debe contener letras.");
//     } else {
//       clearError(diagnostico);
//     }

//     // Validar el campo "especialidad"
//     if (!soloLetras.test(especialidad.value)) {
//       isValid = false;
//       showError(especialidad, "La especialidad solo debe contener letras.");
//     }else {
//       clearError(especialidad);
//     }

//     // Prevenir el envío del formulario si no pasa la validación
//     if (!isValid) {
//       event.preventDefault();
//     }

//   });
// }

// // Mostrar mensaje de error
// function showError(input, message) {
//     clearError(input);
//     const error = document.createElement("p");
//     error.classList.add("text-red-500", "text-sm", "mt-1");
//     error.textContent = message;
//     input.classList.add("border-red-500");
//     input.parentElement.appendChild(error);
// }

// // Limpiar el mensaje de error
// function clearError(input) {
//     input.classList.remove("border-red-500");
//     const error = input.parentElement.querySelector(".text-red-500");
//     if (error) {
//       error.remove();
//     }
// }
const form = document.querySelector("form");

// Configuración de validaciones
const fieldsConfig = [
  {
    field: "#nombre",
    regex: /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/,
    errorMessage: "El nombre solo debe contener letras.",
  },
  {
    field: "#apellido_1",
    regex: /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/,
    errorMessage: "El primer apellido solo debe contener letras.",
  },
  {
    field: "#apellido_2",
    regex: /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/,
    errorMessage: "El segundo apellido solo debe contener letras.",
  },
  {
    field: "#seguro",
    regex: /^[a-zA-Z0-9]{8}$/,
    errorMessage:
      "El código debe contener solo números y letras (mín. 8 caracteres).",
    optional: true,
  },
  {
    field: "#diagnostico",
    regex: /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/,
    errorMessage: "El diagnóstico solo debe contener letras.",
  },
  {
    field: "#especialidad",
    regex: /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/,
    errorMessage: "La especialidad solo debe contener letras.",
  },
];

document.addEventListener("DOMContentLoaded", () => {
  form.addEventListener("submit", handleValidation);
});

function handleValidation(event) {
  let isValid = true;

  fieldsConfig.forEach(({ field, regex, errorMessage, optional }) => {
    const input = document.querySelector(field);

    if (input) {
      // Validar solo si el campo no es opcional o tiene un valor
      if (
        (!optional || input.value.trim() !== "") &&
        !regex.test(input.value)
      ) {
        isValid = false;
        showError(input, errorMessage);
      } else {
        clearError(input);
      }
    }
  });

  if (!isValid) {
    event.preventDefault();
  }
}

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
}
