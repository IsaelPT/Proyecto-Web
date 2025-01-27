document.addEventListener("DOMContentLoaded", () => {
  mostrarOcultarFooter();

  // Configuración de menús dinámicamente
  const menus = [
      { buttonId: '#inicio-btn-doctores', menuId: '#inicio-menu-doctores' },
      { buttonId: '#inicio-btn-pacientes', menuId: '#inicio-menu-pacientes' },
      { buttonId: '#inicio-btn-especialidad', menuId: '#inicio-menu-especialidad'},
      { buttonId: '#inicio-btn-consulta', menuId: '#inicio-menu-consulta'},
  ];

  menus.forEach(({ buttonId, menuId }) => {
      const button = document.querySelector(buttonId);
      const menu = document.querySelector(menuId);

      // Mostrar/Ocultar el menú al hacer clic en el botón
      button.addEventListener('click', () => {
          menu.classList.toggle('hidden');
      });

      // Cerrar el menú si se hace clic fuera del botón o menú
      document.addEventListener('click', (event) => {
          if (!button.contains(event.target) && !menu.contains(event.target)) {
              menu.classList.add('hidden');
          }
      });
  });
});

function mostrarOcultarFooter() {
  const btnFlotante = document.querySelector('.btn-flotante');
  const footer = document.querySelector('#footer');

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
  });
}
