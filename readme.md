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