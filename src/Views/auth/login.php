<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#ffffff" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
    <title>SGEN - Iniciar Sesión</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="<?= BASE_URL ?>vendors/material-icons/material-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>vendors/materialize-src/sass/materialize.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>vendors/materialize-datatables/css/dataTables.materialize.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/main.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/fonts.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/link-options.css">

    <style>
        main { flex: 1 0 auto; }
        .container { max-width: 600px; }
        .btn { padding: 0 2rem; font-size: 15px; }
        .captcha label { top: auto !important; }
        .captcha label:focus { top: 0 !important; }
    </style>
</head>
<body>

    <div style="text-align: center;">
        <a href="">
            <h1 class="logo-p"></h1>
        </a>

        <div class="container">
            <div class="z-depth-1 white row">
                <div class="clap col s12" style="height: 10px;"></div>

                <div class="row row-end">
                    <div class="col s12">
                        <form method="post" action="<?= BASE_URL ?>auth/procesar" id="login-form" class="col s12" autocomplete="off">
                            <div style="padding: 30px;">
                                <!-- Campo Usuario -->
                                <div class="input-field col s12 m6 offset-m3">
                                    <input type="text" id="username" name="username" required autocomplete="off" class="uppercase identification_letter_fix" />
                                    <label class="required" for="email">Username</label>
                                </div>

                                <!-- Campo Contraseña -->
                                <div class="input-field col s12 m6 offset-m3">
                                    <input type="password" id="password" name="password" required autocomplete="off" />
                                    <label class="required" for="password">Password</label>

                                    <!-- Mensajes Flash -->
                                    <?php if (isset($_SESSION['flash_message'])): ?>
                                        <?php $flash = $_SESSION['flash_message']; ?>
                                        <div class="error flash-<?= htmlspecialchars($flash['type']) ?>">
                                            <?= htmlspecialchars($flash['message']) ?>
                                        </div>
                                        <?php unset($_SESSION['flash_message']); ?>
                                    <?php endif; ?>

                                    <?php if (isset($error)): ?>
                                        <div class="error left-align">
                                            <div><?= htmlspecialchars($error) ?></div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Botón de envío -->
                                <div class="row row-end">
                                    <div class="btn-enter input-field col s12 m6 offset-m3">
                                        <button type="submit" class="col s12 btn btn-medium waves-effect waves-light" accesskey="l" id="enviar" tabindex="6">
                                            Login in
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Enlace de recuperación -->
            <div class="col s12 form-footer" style="margin-bottom: 10px;">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="<?= BASE_URL ?>forgot-password">
                    Forgot your password? 
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= BASE_URL ?>vendors/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>vendors/materialize/dist-patria/js/materialize.min.js"></script>
    <script src="<?= BASE_URL ?>vendors/datatables/dist/js/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>vendors/jquery-mask/dist/jquery.mask.min.js"></script>
    <script src="<?= BASE_URL ?>vendors/jquery-maskMoney/dist/jquery.maskMoney.min.js"></script>
    <script src="<?= BASE_URL ?>vendors/materialize-datatables/js/dataTables.materialize.js"></script>
    <script src="<?= BASE_URL ?>js/main.js"></script>
    <script src="<?= BASE_URL ?>js/session-management.js"></script>
    <script src="<?= BASE_URL ?>js/custom-toast.js"></script>
    <script src="<?= BASE_URL ?>js/inactivity-logout.js"></script>

    <!-- Configuración de DataTables -->
    <script>
        $(function () {
            $.extend(true, $.fn.dataTable.defaults, {
                dom: '<"top">t<"bottom"ilrp<"clear">>',
                sortCellsTop: true,
                sort: false,
                info: false,
                paging: false,
                lengthChange: false,
                language: {
                    sProcessing: '<div class="preloader-wrapper small active"><div class="spinner-layer"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>',
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sSearch: "Buscar:",
                    oPaginate: {
                        sFirst: "<i class='material-icons'>first_page</i>",
                        sLast: "<i class='material-icons'>last_page</i>",
                        sNext: "<i class='material-icons'>navigate_next</i>",
                        sPrevious: "<i class='material-icons'>navigate_before</i>"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>

    <!-- Inicialización de componentes -->
    <script>
        $(document).ready(function () {
            $('.button-collapse').sideNav();
            $('.modal').modal();
        });
    </script>

    <!-- Modal de inactividad -->
    <div id="message-alert-logout" class="modal">
        <div class="modal-content">
            <p>No se ha detectado actividad durante los últimos 8 minutos.</p>
            <p>Si no se detecta actividad en la Plataforma SGEN en los próximos 2 minutos serás redireccionado a la página de inicio.</p>
        </div>
        <div class="modal-footer">
            <a id="alert-accept" href="#!" class="modal-action modal-close waves-effect btn">Aceptar</a>
        </div>
    </div>
</body>
</html>
