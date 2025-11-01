            </div>
        <div class="clearfix"></div>
    </main>
    <!-- Footer -->
    <footer class="center-align">
        <span><?= date('Y') ?> © SGP - Sistema de Gestión de Soportes Técnicos. Todos los derechos reservados.</span>
    </footer>
    <!-- Scripts -->
    <script src="<?= VENDOR_PATH ?>jquery/jquery.min.js"></script>
    <script src="<?= VENDOR_PATH ?>materialize/dist-patria/js/materialize.min.js"></script>
    <script src="<?= VENDOR_PATH ?>datatables/dist/js/jquery.dataTables.min.js"></script>
    <script src="<?= VENDOR_PATH ?>jquery-mask/dist/jquery.mask.min.js"></script>
    <script src="<?= VENDOR_PATH ?>jquery-maskMoney/dist/jquery.maskMoney.min.js"></script>
    <script src="<?= VENDOR_PATH ?>materialize-datatables/js/dataTables.materialize.js"></script>
    <script src="<?= JS_PATH ?>main.js"></script>
    <script src="<?= JS_PATH ?>session-management.js"></script>
    <script src="<?= JS_PATH ?>custom-toast.js"></script>
    <script src="<?= JS_PATH ?>datatables-global.js"></script>
    <script src="<?= JS_PATH ?>inactivity-logout.js"></script>
    <script src="<?= JS_PATH ?>identification-letter-fix.js"></script>
    <!-- Inicialización de componentes -->
    <script>
        $(document).ready(function() {
            $('.button-collapse').sideNav();
            $('.modal').modal();
        });
        // Ocultar toast después de 5 segundos
        setTimeout(() => {
            const toast = document.querySelector('#toast-container .toast');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 5000);
    </script>
    <!-- Toast -->
    <div id="toast-container">
        <div class="toast green" style="top: 0px; opacity: 1; flex: 1;">
            <i class="material-icons">check_circle</i>
            <span class="toast-text"></span>
        </div>
    </div>
    <!-- Modal de inactividad -->
    <div id="message-alert-logout" class="modal">
        <div class="modal-content">
            <p>No se ha detectado actividad durante los últimos 8 minutos.</p>
            <p>Si no se detecta actividad en la Plataforma SGP en los próximos 2 minutos serás redireccionado a la página de inicio.</p>
        </div>
        <div class="modal-footer">
            <a id="alert-accept" href="#!" class="modal-action modal-close waves-effect btn">Aceptar</a>
        </div>
    </div>
    <!-- Máscara DNI -->
    <script>
        const options = {
            translation: {
                '0': {
                    pattern: /\d/
                },
                '1': {
                    pattern: /[1-9]/
                },
                '9': {
                    pattern: /\d/,
                    optional: true
                },
                '#': {
                    pattern: /\d/,
                    recursive: true
                },
                'C': {
                    pattern: /[VvEe]/,
                    fallback: 'V'
                }
            }
        };
        $('#document_id').mask('C-19999999', options);
    </script>
    </body>

    </html>