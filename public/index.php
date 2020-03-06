<!-- Inicialización de la clase Core, y carga de archivos de alta prioridad -->
<?php
  require_once('../app/requireFiles.php');
  $init = new Core();
  $init -> setController();
?>