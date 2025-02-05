
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

  fieldsConfig.forEach(({field, regex, errorMessage}) => {
    const input = document.querySelector(field);

    if (input) {
      if (
        (input.value.trim() !== "") &&
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
