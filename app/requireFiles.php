<!-- Carga de archivos de alta prioridad para la aplicación -->
<?php
    require_once 'core/Core.php';
    require_once 'core/Controller.php';
    require_once 'config/config.php';
    require_once 'utilities/urlUtility.php';

    spl_autoload_register(function ($className) {
        require_once 'core/'. $className . '.php';
    });
?>