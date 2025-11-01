<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png/>
        <meta name="theme-color" content="#ffffff"/>
        <meta name="format-detection" content="telephone=no"/>
        <title><?php echo $titulo ?? 'SGEN Soporte'; ?></title>
        <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH ?>material-icons/material-icons.css"/>
        <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH ?>materialize-src/sass/materialize.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH ?>materialize-datatables/css/dataTables.materialize.css"/>
        <link rel="stylesheet" type="text/css" href="<?= CSS_PATH ?>main.css"/>
        <link rel="stylesheet" type="text/css" href="<?= CSS_PATH ?>fonts.css"/>

    <link rel="stylesheet" href="<?= CSS_PATH ?>link-options.css">
    </head>
    <body>
        <header>
            <div id="main-menu" class="navbar-fixed">
                <nav>
                    <div class="nav-wrapper">
                        <a href="#" data-activates="mobile-menu" class="button-collapse mobile-menu">
                        <i class="material-icons">menu</i>
                        </a>
                        <div class="container2">
                            <ul class="left">
                                <li class="first active">
                                    <a href="<?= BASE_URL ?>">
                                    <i class="ico-dash_coin"></i>
                                    <span class="hide-on-small-only">SGEN</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= BASE_URL ?>soportes" title="Tickets">
                                    <i class="material-icons">receipt</i>
                                    <span class="hide-on-small-only">Tickets</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= BASE_URL ?>soportes/crear" title="Abrir Ticket">
                                    <i class="ico-pago_facturas"></i>
                                    <span class="hide-on-small-only">Abrir Ticket</span>
                                    </a>
                                </li>
                                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                                <li class="">
                                    <a href="<?= BASE_URL ?>equipos" title="Equipos">
                                    <i class="material-icons">laptop</i>
                                    <span class="hide-on-small-only">Equipos</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= BASE_URL ?>departamentos" title="Departamentos">
                                    <i class="material-icons">domain</i>
                                    <span class="hide-on-small-only">Departamentos</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?= BASE_URL ?>usuarios" title="Usuarios">
                                    <i class="material-icons">people</i>
                                    <span class="hide-on-small-only">Usuarios</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="right">
                                <li style="line-height: 40px;" class="">
                                    <a href="<?= BASE_URL ?>" style="line-height: 30px;margin-top: 5px;height: 40px;border-radius: 8px;">
                                    <i class="material-icons" style="line-height: 40px;height: 40px">notifications</i>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-button-custom" href="javascript:void(0)" data-activates="dropdown1">
                                    <i class="material-icons left">perm_identity</i><i class="material-icons right">arrow_drop_down</i>
                                    </a>
                                </li>
                            </ul>
                            <ul id="dropdown1" class="dropdown-content">
                                <li><span><?=$_SESSION['username']?></span></li>
                                <li class="divider"></li>
                                <li>
                                    <a title="Perfil" href="<?= BASE_URL ?>perfil">Perfil</a>
                                </li>
                                <li>
                                    <a title="Salir" href="<?= BASE_URL ?>auth/logout/">Salir</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="side-nav" id="mobile-menu">
                <ul id="actions-menu" class="collapsible collapsible-accordion">
                    <li class="menu-header">
                        <a href="#" onclick="$('.button-collapse').sideNav('hide');"><i class="material-icons">clear</i></a>
                        Inicio                
                    </li>
                    <li class="no-padding ">
                        <a href="noticias.html" class="waves-effect waves-grey">
                        <i class="ico-noticias"></i>Noticias
                        </a>
                    </li>
                    <li class="no-padding ">
                        <a href="proteccion-bono.html" class="waves-effect waves-grey">
                        <i class="ico-proteccion_social1"></i>Protección Social
                        </a>
                    </li>
                    <li class="no-padding ">
                        <a href="milicia-bolivariana.html" class="waves-effect waves-grey">
                        <i class="ico-fortalecimiento"></i> Alistamiento
                        </a>
                    </li>
                    <li class="no-padding ">
                        <a href="plan-vuelta-a-la-patria.html" class="waves-effect waves-grey">
                        <i class="ico-vuelta_patria"></i> Vuelta a la Patria
                        </a>
                    </li>
                    <li class="no-padding  active">
                        <a href="encuestas.html " class="waves-effect waves-grey">
                        <i class="ico-encuesta"></i> Encuestas
                        </a>
                    </li>
                </ul>
                <ul id="logout-menu">
                    <li class="">
                        <a href="notification">
                        <i class="material-icons">notifications</i> Notificaciones
                        </a>
                    </li>
                    <li>
                        <a href="logout">
                        <i class="material-icons left">perm_identity</i>Salir
                        </a>
                    </li>
                </ul>
            </div>
        </header>
        <!-- Main -->
        <main>
            <div class="inner-main">
                <?php
                // ---- INICIO DE MENSAJES FLASH ----//
                if (isset($_SESSION['flash_message'])):
                    $flash = $_SESSION['flash_message'];
                    // Definimos un estilo básico para los mensajes
                    ?>
                    <div class="flash-message flash-<?php echo htmlspecialchars($flash['type']); ?>">
                        <?php echo htmlspecialchars($flash['message']); ?>
                    </div>
                    <?php
                    // ¡Importante! Borrar el mensaje después de mostrarlo
                    unset($_SESSION['flash_message']);
                endif;
                // ---- FIN DE MENSAJES FLASH ---//
                ?>