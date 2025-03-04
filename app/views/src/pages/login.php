
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital - Login/Registro</title>
  <link rel="stylesheet" href="app/views/src/styles/estilos.css">
  <link rel="shortcut icon" href="app/views/src/icons/logoH.png" type="image/x-icon">
</head>

<body class=" min-h-screen flex items-center justify-center"
  style="background-image:url('app/views/src/icons/dash.jpg');background-position: center 20%;">
  <div class="bg-white p-8 rounded-lg shadow-xl w-96 transition-all duration-600">
    <!-- Encabezado -->
    <div class="text-center mb-8">
      <img src="app/views/src/icons/logoH.png" alt=" Logo hospital" class="w-20 h-20 mx-auto mb-4 animate-bounce">
      <h1 class="text-2xl font-bold text-gray-800">Hospital Saturnino Lora</h1>
      <p class="text-gray-600 mt-2" id="formTitle">Ingrese sus credenciales</p>
    </div>

    <!-- Formulario Login -->
    <form id="loginForm" class="space-y-6" method="POST" action="?controller=Auth&&action=auntenticar_user">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
        <input type="text" id="username" name="usuario"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Usuario">
        <span class="text-red-500 text-sm hidden" id="loginUserError"></span>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
        <div class="relative">
          <input type="password" id="password" name="pass"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="••••••••">
          <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500"
            onclick="togglePasswordVisibility('password')">
            👁️
          </button>
        </div>
        <span class="text-red-500 text-sm hidden" id="loginPassError"></span>
      </div>

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
        Ingresar
      </button>

      <span class="text-red-500 text-sm"> <?php echo $_SESSION['error']; ?></span>

      <p class="text-center text-sm text-gray-600">
        ¿No tienes cuenta?
        <button type="button" onclick="toggleForms()" class="text-blue-600 hover:underline">Regístrate</button>
      </p>
    </form>

    <!-- Formulario Registro -->
    <form id="signupForm" class="space-y-6 hidden" method="POST" action="?controller=Auth&&action=isertar_usuario">
      <div>
        <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Nombre Usuario</label>
        <input type="text" id="fullname" name="usuario"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <span class="text-red-500 text-sm hidden" id="signupNameError"></span>
      </div>

      <div>
        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
        <div class="relative">
          <input type="password" id="newPassword" name="pass"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="••••••••">
          <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500"
            onclick="togglePasswordVisibility('newPassword')">
            👁️
          </button>
        </div>
        <span class="text-red-500 text-sm hidden" id="signupPassError"></span>
      </div>

      <div>
        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
        <input type="password" id="confirmPassword"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="••••••••">
        <span class="text-red-500 text-sm hidden" id="signupConfirmError"></span>
      </div>

      <button type="submit"
        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
        Crear Cuenta
      </button>

      <span class="text-red-500 text-sm hidden"> <?php echo $_SESSION['error'] ?></span>

      <p class="text-center text-sm text-gray-600">
        ¿Ya tienes cuenta?
        <button type="button" onclick="toggleForms()" class="text-blue-600 hover:underline">Inicia sesión</button>
      </p>
    </form>

    <!-- Mensajes -->
    <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 text-green-700 rounded-lg"></div>
    <div id="errorMessage" class="hidden mt-4 p-4 bg-red-100 text-red-700 rounded-lg"></div>
  </div>

  <script>
    // Toggle entre formularios
    function toggleForms() {
      const loginForm = document.getElementById('loginForm');
      const signupForm = document.getElementById('signupForm');
      const formTitle = document.getElementById('formTitle');

      loginForm.classList.toggle('hidden');
      signupForm.classList.toggle('hidden');
      formTitle.textContent = loginForm.classList.contains('hidden')
        ? "Crea una nueva cuenta"
        : "Ingrese sus credenciales";

      resetMessages();
      resetErrors();
    }

    // Validación Login
    document.getElementById('loginForm').addEventListener('submit', (e) => {
      e.preventDefault();
      resetMessages();
      resetErrors();

      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;
      let isValid = true;

      if (username.trim() === '') {
        showError('loginUserError', 'El usuario es requerido');
        isValid = false;
      }

      if (password.trim() === '') {
        showError('loginPassError', 'La contraseña es requerida');
        isValid = false;
      }

      if (isValid) {
        e.target.submit();
      }

    });

    // Validación Registro
    document.getElementById('signupForm').addEventListener('submit', (e) => {
      e.preventDefault();
      resetMessages();
      resetErrors();

      const fullname = document.getElementById('fullname').value;
      const newPassword = document.getElementById('newPassword').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      let isValid = true;

      if (fullname.trim() === '') {
        showError('signupNameError', 'El nombre completo es requerido');
        isValid = false;
      }

      if (newPassword.length < 6) {
        showError('signupPassError', 'Mínimo 6 caracteres');
        isValid = false;
      }

      if (newPassword !== confirmPassword) {
        showError('signupConfirmError', 'Las contraseñas no coinciden');
        isValid = false;
      }

      if (isValid) {
        e.target.submit();
      }
    });

    // Funciones auxiliares
    function togglePasswordVisibility(fieldId) {
      const input = document.getElementById(fieldId);
      input.type = input.type === 'password' ? 'text' : 'password';
    }

    function showError(elementId, message) {
      const element = document.getElementById(elementId);
      element.textContent = message;
      element.classList.remove('hidden');
    }

    function showSuccess(message) {
      const successElement = document.getElementById('successMessage');
      successElement.textContent = message;
      successElement.classList.remove('hidden');
      setTimeout(() => successElement.classList.add('hidden'), 3000);
    }

    function resetErrors() {
      document.querySelectorAll('[id$="Error"]').forEach(el => {
        el.classList.add('hidden');
      });
    }

    function resetMessages() {
      document.getElementById('successMessage').classList.add('hidden');
      document.getElementById('errorMessage').classList.add('hidden');
    }
  </script>
</body>

</html>