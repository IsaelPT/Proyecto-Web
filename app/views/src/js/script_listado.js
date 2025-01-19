// Botón y menú para Doctores
const inicioBtnDoc = document.querySelector('#inicio-btn-doctores');
const inicioMenuDoc = document.querySelector('#inicio-menu-doctores');

document.addEventListener("DOMContentLoaded", () => {
    mostrar_ocultar_footer();
    
});

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

function mostrar_ocultar_footer(){
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
    })
}

