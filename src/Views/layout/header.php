<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#ffffff" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
    <title><?php echo $titulo ?? 'SGEN Soporte'; ?></title>

    <!-- Estilos -->
    <link rel="stylesheet" href="<?= VENDOR_PATH ?>material-icons/material-icons.css">
    <link rel="stylesheet" href="<?= VENDOR_PATH ?>materialize-src/sass/materialize.min.css">
    <link rel="stylesheet" href="<?= VENDOR_PATH ?>materialize-datatables/css/dataTables.materialize.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>main.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>fonts.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>link-options.css">
</head>
<body>
    <!-- Header -->
    <header>
        <!-- Menú principal -->
        <div id="main-menu" class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="<?=BASE_URL?>admin/dashboard" class="button-collapse mobile-menu">
                        <i class="material-icons">menu</i>
                    </a>

                    <div class="container2">
                        <ul class="left">
                            <li class="first active"><a href="<?=BASE_URL?>"><i class="ico-dash_coin"></i><span class="hide-on-small-only">SGEN</span></a></li>
                            <li><a href="<?=BASE_URL?>soportes"><i class="ico-nomina mdi-action-nomina"></i><span class="hide-on-small-only">Tickets</span></a></li>
                            <li><a href="<?=BASE_URL?>soportes/crear"><i class="ico-pago_facturas mdi-action-pago_facturas"></i><span class="hide-on-small-only">Abrir Ticket</span></a></li>
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                            <li><a href="<?=BASE_URL?>equipos"><i class="material-icons mdi-material-icons">laptop</i><span class="hide-on-small-only">Equipos</span></a></li>
                            <li><a href="<?=BASE_URL?>departamentos"><i class="material-icons mdi-material-icons">domain</i><span class="hide-on-small-only">Departamentos</span></a></li>
                            <li><a href="<?=BASE_URL?>usuarios"><i class="ico-group mdi-action-group"></i><span class="hide-on-small-only">Usuarios</span></a></li>
                            <li><a href="<?=BASE_URL?>profile"><i class="ico-account_circle mdi-action-account_circle"></i><span class="hide-on-small-only">Perfil</span></a></li>
                            <?php endif; ?>
                        </ul>

                        <ul class="right">
                            <li><a href="notification"><i class="material-icons">notifications</i></a></li>
                            <li><a class="dropdown-button-custom" href="javascript:void(0)" data-activates="dropdown1"><i class="material-icons left">perm_identity</i><i class="material-icons right">arrow_drop_down</i></a></li>
                        </ul>

                        <!-- Dropdown -->
                        <ul id="dropdown1" class="dropdown-content">
                            <li><span>Admin</span></li>
                            <li class="divider"></li>
                            <li><a href="<?=BASE_URL?>profile">Perfil</a></li>
                            <li>
                                <a href="<?=BASE_URL?>auth/logout/">Logout</a></li>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Menú móvil -->
        <ul id="mobile-menu" class="side-nav">
            <li class="menu-header"><a href="#" onclick="$('.button-collapse').sideNav('hide');"><i class="material-icons">clear</i></a>Inicio</li>
            <li><a href="#"><i class="ico-"></i>Dashboard (Común)</a></li>
            <li><a href="#"><i class="ico-"></i>Managers</a></li>
            <li class="active"><a href="#"><i class="ico-"></i>Students</a></li>
            <li><a href="#"><i class="ico-"></i>Academics</a></li>
            <li><a href="notification"><i class="material-icons">notifications</i>Notifications</a></li>
            <li>
                <a href="<?=BASE_URL?>auth/logout/" style="color: red; font-weight: bold;"><i class="material-icons left">perm_identity</i>Logout</a>
            </li>
        </ul>
    </header>
    <!-- Main -->
    <main>
    <?php 
    // ---- INICIO DE MENSAJES FLASH ----
    if (isset($_SESSION['flash_message'])):
        $flash = $_SESSION['flash_message'];
        // Definimos un estilo básico para los mensajes
    ?>
        <style>

        </style>
        
        <div class="flash-message flash-<?php echo htmlspecialchars($flash['type']); ?>">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
    <?php 
        // ¡Importante! Borrar el mensaje después de mostrarlo
        unset($_SESSION['flash_message']);
    endif;
    // ---- FIN DE MENSAJES FLASH ----
    ?>
