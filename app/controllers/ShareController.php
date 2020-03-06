<?php
    session_start();
    class ShareController extends Controller {
        // Creación del arreglo con los datos a ser transmitidos hacia la vista
        private $data = [
            'title' => 'Share',
            'shareAction' => URLROOT . '/share',
            'username' => '',
            'principalMessage' => 'Share your life with us!',
            'secondMessage' => "Are you having fun at Hogwarts?",
            'shareError' => 'Please enter a comment',
            'publication' => ''
        ];

        // Constructor de la clase
        public function __construct() {
            $this->publicationModel = $this->model('Publication');
        }

        // Función para orquestar el registro de una nueva publicación en la BD
        public function share() {
            $this->data['username'] = $_SESSION['username'];

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $temp = [
                    'username' => $_SESSION['username'],
                    'role' => $_SESSION['role'],
                    'publication' => trim($POST['publication'])
                ];

                if(isset($temp['username']) && isset($temp['role']) && isset($temp['publication'])) {
                    if($this->publicationModel->savePublication($temp)) {
                        redirect('dashboard');
                    } else {
                        echo '<script language="javascript">';
                            echo 'alert("Something failed.")';
                        echo '</script>';
                    }
                }
            }

            $this->view('share', $this->data);
        }

        // Función para orquestar la edición de una publicación en la BD
        public function editPublication($id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $temp = [
                    'id' => $id,
                    'username' => $_SESSION['username'],
                    'role' => $_SESSION['role'],
                    'publication' => trim($POST['publication'])
                ];

                if(isset($temp['username']) && isset($temp['role']) && isset($temp['publication'])) {
                    if($this->publicationModel->updatePublication($temp)) {
                        redirect('dashboard');
                    } else {
                        echo '<script language="javascript">';
                            echo 'alert("Something failed.")';
                        echo '</script>';
                    }
                }
            }
        }

        // Función para orquestar la edición de una publicación
        public function edit($id) {
            $this->data['publication'] = $this->publicationModel->getPublicationById($id);
            $this->share();
        }

        // Función para orquestar la eliminación de una publicación
        public function delete($id) {
            if($this->publicationModel->deletePublication($id)) {
                redirect('dashboard');
            } else {
                echo '<script language="javascript">';
                    echo 'alert("Something failed.")';
                echo '</script>';
            }
        }

        // Función para construir el controlador principal
        public function dashboard() {
            $init = new Core();
            $init->setController('DashboardController', 'dashboard');
        }
    }
?>