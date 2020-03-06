<?php
    session_start();
    class DashboardController extends Controller {
        // Creación del arreglo con los datos de la vista
        private $data = [
            'title' => 'Dashboard',
            'editButton' => 'Edit',
            'deleteButton' => 'Delete',
            'publications' => ''
        ];

        // Constructor de la clase
        public function __construct() {
            $this->publicationModel = $this->model('Publication');
        }

        // Función para listar las publicaciones
        public function dashboard() {
            $this->data['publications'] = array_reverse($this->publicationModel->getPublications());
            $this->view('dashboard', $this->data);
        }
    }
?>