<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hospital Saturnino Lora</title>
        <link rel="stylesheet" href="app/views/src/styles/estilos.css">
        <link rel="shortcut icon" href="app/views/src/icons/logoH.png" type="image/x-icon">
    </head>

<body class="bg-cover bg-center bg-fixed"
    style="background-image: linear-gradient(rgba(186, 172, 172, 0.542), rgba(205, 194, 194, 0.2)), url('app/views/src/icons/dash.jpg');background-position: center 20%;">
    <header class="bg-blue-300">
        <div class="container mx-auto flex items-center justify-between py-4 px-6 flex-wrap">
            <div class="flex items-center space-x-2 mr-2">
                <img src="app/views/src/icons/logoH.png" alt="Ícono del hospital" class="w-12 h-12">
                <h1 class="text-black font-bold text-lg whitespace-nowrap">
                    Hospital Saturnino Lora
                </h1>
            </div>
            <nav class="flex-grow">
                <ul class="flex flex-col sm:flex-row justify-end items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <li class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                            <path
                                d="M32 32c17.7 0 32 14.3 32 32l0 336c0 8.8 7.2 16 16 16l400 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L80 480c-44.2 0-80-35.8-80-80L0 64C0 46.3 14.3 32 32 32zM160 224c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32zm128-64l0 160c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-160c0-17.7 14.3-32 32-32s32 14.3 32 32zm64 32c17.7 0 32 14.3 32 32l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96c0-17.7 14.3-32 32-32zM480 96l0 224c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-224c0-17.7 14.3-32 32-32s32 14.3 32 32z" />
                        </svg>
                        <a href="?controller=Dashboard"
                            class="text-dark-gray hover:text-blue-logo hover:text-blue-700 ml-2 hover:underline">Dashboard</a>
                    </li>
                    <div class="flex items-center space-x-2">
                        <li class="relative flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 576 512">
                                <path
                                    d="M32 32c17.7 0 32 14.3 32 32l0 336c0 8.8 7.2 16 16 16l400 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L80 480c-44.2 0-80-35.8-80-80L0 64C0 46.3 14.3 32 32 32zM160 224c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32zm128-64l0 160c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-160c0-17.7 14.3-32 32-32s32 14.3 32 32zm64 32c17.7 0 32 14.3 32 32l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96c0-17.7 14.3-32 32-32zM480 96l0 224c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-224c0-17.7 14.3-32 32-32s32 14.3 32 32z" />
                            </svg>
                            <button id="inicio-btn-consulta"
                                class="text-dark-gray hover:text-blue-logo hover:text-blue-700  hover:underline ml-2">
                                Consulta
                            </button>
                            <ul id="inicio-menu-consulta"
                                class="hidden absolute top-full right-0 bg-white shadow rounded mt-2 w-40 z-40">
                                <li>
                                    <a href="?controller=Consulta&&action=form_consultas"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700  hover:underline">Añadir
                                        consulta</a>
                                </li>
                                <li>
                                    <a href="?controller=Consulta&&action=principal"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700  hover:underline">Listado
                                        de consultas</a>
                                </li>
                            </ul>
                        </li>
                    </div>

                    <div class="flex items-center space-x-2">
                        <li class="relative flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1l0 50.8c27.6 7.1 48 32.2 48 62l0 40c0 8.8-7.2 16-16 16l-16 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l0-24c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 24c8.8 0 16 7.2 16 16s-7.2 16-16 16l-16 0c-8.8 0-16-7.2-16-16l0-40c0-29.8 20.4-54.9 48-62l0-57.1c-6-.6-12.1-.9-18.3-.9l-91.4 0c-6.2 0-12.3 .3-18.3 .9l0 65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7l0-59.1zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                            </svg>
                            <button id="inicio-btn-doctores"
                                class="text-dark-gray hover:text-blue-logo hover:text-blue-700 ml-2 hover:underline">
                                Doctores
                            </button>
                            <ul id="inicio-menu-doctores"
                                class="hidden absolute top-full right-0 bg-white shadow rounded mt-2 w-40 z-40">
                                <li>
                                    <a href="?controller=Doctor&&action=form_doctores"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700 hover:underline">Añadir
                                        doctor</a>
                                </li>
                                <li>
                                    <a href="?controller=Doctor&&action=principal"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700 hover:underline">Listado
                                        de
                                        doctores</a>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <div class="flex items-center space-x-2">
                        <li class="relative flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M48 0C21.5 0 0 21.5 0 48L0 256l144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L0 288l0 64 144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L0 384l0 80c0 26.5 21.5 48 48 48l217.9 0c-6.3-10.2-9.9-22.2-9.9-35.1c0-46.9 25.8-87.8 64-109.2l0-95.9L320 48c0-26.5-21.5-48-48-48L48 0zM152 64l16 0c8.8 0 16 7.2 16 16l0 24 24 0c8.8 0 16 7.2 16 16l0 16c0 8.8-7.2 16-16 16l-24 0 0 24c0 8.8-7.2 16-16 16l-16 0c-8.8 0-16-7.2-16-16l0-24-24 0c-8.8 0-16-7.2-16-16l0-16c0-8.8 7.2-16 16-16l24 0 0-24c0-8.8 7.2-16 16-16zM512 272a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM288 477.1c0 19.3 15.6 34.9 34.9 34.9l218.2 0c19.3 0 34.9-15.6 34.9-34.9c0-51.4-41.7-93.1-93.1-93.1l-101.8 0c-51.4 0-93.1 41.7-93.1 93.1z" />
                            </svg>
                            <button id="inicio-btn-pacientes"
                                class="text-dark-gray hover:text-blue-logo hover:text-blue-700 hover:underline ml-2 ">
                                Pacientes
                            </button>
                            <ul id="inicio-menu-pacientes"
                                class="hidden absolute top-full right-0 bg-white shadow rounded mt-2 w-40 z-40">
                                <li>
                                    <a href="?controller=Paciente&&action=form_pacientes"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700 hover:underline">Añadir
                                        paciente</a>
                                </li>
                                <li>
                                    <a href="?controller=Paciente&&action=principal"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700 hover:underline">Listado
                                        de
                                        pacientes</a>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <div class="flex items-center space-x-2">
                        <li class="relative flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M208 32c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 140.9 122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.6 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1 304 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-140.9L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4L208 32z" />
                            </svg>
                            <button id="inicio-btn-especialidad"
                                class="text-dark-gray hover:text-blue-logo hover:text-blue-700 hover:underline ml-2">
                                Especialidades
                            </button>
                            <ul id="inicio-menu-especialidad"
                                class="hidden absolute top-full right-0 bg-white shadow rounded mt-2 w-40 z-40">
                                <li>
                                    <a href="?controller=Especialidad&&action=form_especialidades"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700 hover:underline">Añadir
                                        especialidad</a>
                                </li>
                                <li>
                                    <a href="?controller=Especialidad&&action=principal"
                                        class="block px-4 py-2 hover:bg-light-gray text-sm hover:text-blue-700 hover:underline">Listado
                                        de especialidades</a>
                                </li>
                            </ul>
                        </li>
                    </div>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contenido de Listado de Consultas -->
    <main class="container mx-auto py-4 px-6 sm:px-6 max-w-full overflow-x-auto">
        <section class="mb-8">
            <div class="flex flex-col items-center mt-10">
                <h2 class="text-2xl sm:text-4xl font-bold mb-4 ">Listado de consultas</h2>
                <div class="w-full max-w-full overflow-x-auto mx-auto">
                    <table id="tablaPacientes"
                        class="p-6 w-auto backdrop-blur-lg bg-gray-100/60 border-collapse overflow-hidden rounded-lg table-auto mx-auto">
                        <thead>
                            <tr>
                                <th class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">Paciente</th>
                                <th class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">Apellido Paciente
                                </th>
                                <th class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">Doctor asignado</th>
                                <th class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">Apellido Doctor</th>
                                <th class="p-2 sm:p-3 border-b border-gray-700 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consultas = $this->consulta->listar();
                            for ($i = 0; $i < count($consultas); $i++): ?>
                                <tr>
                                    <?php if ($i + 1 == count($consultas)): ?>
                                        <td class="p-2 sm:p-3 border-r border-gray-700 text-left">
                                            <?php echo $consultas[$i]->nombre_paciente; ?></td>
                                        <td class="p-2 sm:p-3 border-r border-gray-700 text-left">
                                            <?php echo $consultas[$i]->primer_apellido_paciente; ?></td>
                                        <td class="p-2 sm:p-3 border-r border-gray-700 text-left">
                                            <?php echo $consultas[$i]->nombre_doctor; ?></td>
                                        <td class="p-2 sm:p-3 border-r border-gray-700 text-left">
                                            <?php echo $consultas[$i]->primer_apellido_doctor; ?></td>
                                        <td class="p-2 sm:p-3 border-gray-700 text-left">
                                            <div
                                                class="flex flex-col sm:flex-row justify-end items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                                <a href="?controller=Consulta&&action=eliminar&&id_doctor=<?php echo $consultas[$i]->id_doctor ?>&&id_paciente=<?php echo $consultas[$i]->id_paciente ?>"
                                                    class="px-4 py-2 bg-red-300 text-black rounded hover:bg-red-500 mr-5 borrar-fila">
                                                    Borrar </a>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">
                                            <?php echo $consultas[$i]->nombre_paciente; ?></td>
                                        <td class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">
                                            <?php echo $consultas[$i]->primer_apellido_paciente; ?></td>
                                        <td class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">
                                            <?php echo $consultas[$i]->nombre_doctor; ?></td>
                                        <td class="p-2 sm:p-3 border-r border-b border-gray-700 text-left">
                                            <?php echo $consultas[$i]->primer_apellido_doctor; ?></td>
                                        <td class="p-2 sm:p-3 border-b border-gray-700 text-left">
                                            <div
                                                class="flex flex-col sm:flex-row justify-end items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                                <a href="?controller=Consulta&&action=eliminar&&id_doctor=<?php echo $consultas[$i]->id_doctor ?>&&id_paciente=<?php echo $consultas[$i]->id_paciente ?>"
                                                    class="px-4 py-2 bg-red-300 text-black rounded hover:bg-red-500 mr-5 borrar-fila">
                                                    Borrar </a>
                                            </div>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            <?php endfor
                            ?>
                        </tbody>
                    </table>
                </div>
        </section>
    </main>

        <footer id="footer"
            class="footer fixed bottom-0 left-0 w-full bg-gray-900 hidden transition-all duration-300 ease-in-out">
            <div
                class="container mx-auto flex flex-col sm:flex-row items-center justify-between text-white w-full px-4 py-3">
                <p class="text-center sm:text-left">© 2025 Mi Sitio Web. Todos los derechos reservados.</p>
                <a href="#" class="text-blue-500 hover:underline mt-2 sm:mt-0">Política de Privacidad</a>
            </div>
        </footer>

        <a href="#footer"
            class="btn-flotante fixed bottom-5 right-4 bg-gray-500 text-white px-4 py-2 rounded shadow-lg text-sm sm:text-base">Información</a>

        <script src="app/views/src/js/script.js"></script>
    </body>

</html>