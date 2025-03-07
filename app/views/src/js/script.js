document.addEventListener("DOMContentLoaded", () => {
  mostrarOcultarFooter();
  agregarEventosBorrar();

  // Configuración de menús dinámicamente
  const menus = [
    { buttonId: "#inicio-btn-doctores", menuId: "#inicio-menu-doctores" },
    { buttonId: "#inicio-btn-pacientes", menuId: "#inicio-menu-pacientes" },
    {
      buttonId: "#inicio-btn-especialidad",
      menuId: "#inicio-menu-especialidad",
    },
    { buttonId: "#inicio-btn-consulta", menuId: "#inicio-menu-consulta" },
    { buttonId: "#inicio-btn-user", menuId: "#inicio-menu-user" },
  ];

  menus.forEach(({ buttonId, menuId }) => {
    const button = document.querySelector(buttonId);
    const menu = document.querySelector(menuId);

    // Mostrar/Ocultar el menú al hacer clic en el botón
    button.addEventListener("click", () => {
      menu.classList.toggle("hidden");
    });

    // Cerrar el menú si se hace clic fuera del botón o menú
    document.addEventListener("click", (event) => {
      if (!button.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.add("hidden");
      }
    });
  });
});

function mostrarOcultarFooter() {
  const btnFlotante = document.querySelector(".btn-flotante");
  const footer = document.querySelector("#footer");

  btnFlotante.addEventListener("click", () => {
    if (footer.classList.contains("hidden")) {
      // Mostrar footer
      footer.classList.remove("hidden");
      footer.classList.add("block");
      btnFlotante.textContent = "Cerrar";

      // Mover el botón hacia arriba
      btnFlotante.classList.remove("bottom-5");
      btnFlotante.classList.add("bottom-20");
    } else {
      // Ocultar footer
      footer.classList.add("hidden");
      footer.classList.remove("block");
      btnFlotante.textContent = "Información";

      // Volver a la posición original del botón
      btnFlotante.classList.remove("bottom-20");
      btnFlotante.classList.add("bottom-5");
    }
  });
}

function agregarEventosBorrar() {
  const botones = document.querySelectorAll(".borrar-fila");
  botones.forEach(boton => {
      boton.addEventListener('click', (event) => {
          // Evitar que el enlace se siga
          event.preventDefault(); 
          const userConfirmed = confirm("¿Estás seguro de que deseas eliminar?");
          if (userConfirmed) {
              // Redirigir a la URL del enlace
              window.location.href = boton.href;
          }
      });
  });
}