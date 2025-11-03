#  SGEN-Support - Sistema de Gestión de Tickets de Soporte Técnico

SGEN-Support es una aplicación web desarrollada en PHP 8 para gestionar solicitudes de soporte técnico dentro de una institución. Su arquitectura modular y escalable permite registrar, asignar y resolver tickets de manera eficiente, con métricas claras y una interfaz accesible para usuarios, técnicos y administradores.

##  Objetivo

Facilitar la atención técnica institucional mediante un sistema centralizado que documenta cada solicitud, mejora la comunicación interna y permite tomar decisiones basadas en datos.

##  Funcionalidades principales

- Registro de tickets por área, prioridad y tipo de incidencia
- Panel de control con métricas y filtros dinámicos
- Asignación de técnicos y seguimiento del estado del ticket
- Historial de intervenciones y comentarios
- Redirección automática según rol (usuario, técnico, administrador)
- URLs amigables mediante `.htaccess`
- Diseño adaptable con Materialize CSS y componentes personalizados

##  Tecnologías utilizadas

- PHP 8
- MySQL
- Composer (autocarga y dependencias)
- JavaScript (jQuery, plugins)
- Materialize CSS
- Git para control de versiones

##  Estructura del proyecto


/sgen-support/
|
|-- /config/
|   |-- database.php       (Contendrá las credenciales de la BD)
|
|-- /public/                 (La única carpeta accesible desde el navegador)
|   |-- index.php            (Front Controller - Punto de entrada único)
|   |-- .htaccess            (Para URLs amigables)
|   |-- /css/
|   |-- /js/
|
|-- /src/                    (El código de nuestra aplicación)
|   |-- /Core/               (Clases base: Router, Database, Controller...)
|   |-- /Models/             (Clases que interactúan con la BD: Usuario.php, Soporte.php...)
|   |-- /Views/              (Archivos HTML/PHP para la UI: login.php, soportes/lista.php...)
|   |-- /Controllers/        (Clases que gestionan la lógica: AuthController.php, SoporteController.php...)
|
|-- /vendor/                 (Carpeta gestionada por Composer)
|
|-- composer.json            (Define las dependencias y la autocarga)

##  Instalación

1. Clona el repositorio:
   bash
   git clone https://github.com/adolfojos/sgen-support.git

Configura tu entorno local (XAMPP, Laragon, etc.)

Crea una base de datos y ajusta las credenciales en config/database.php

Asegúrate de que el servidor apunte a la carpeta /public

Accede desde http://localhost/sgen-support/public

Roles del sistema

Consultor: Crea y consulta sus tickets

Técnico: Atiende y actualiza tickets asignados

Administrador: Supervisa métricas, asigna técnicos y gestiona el sistema

Seguridad y buenas prácticas
Separación clara entre lógica, vistas y acceso público

Uso de funciones reutilizables para blindar rutas y redirecciones

Validación de sesiones y roles en cada controlador

Integridad referencial en la base de datos

Créditos
Desarrollado por Adolfo Suarez, técnico. Con enfoque en funcionalidad, empatía institucional y escalabilidad técnica.