<?php
    class SuperController extends Controller {
        // Creación del arreglo con los datos de la vista
        private $data = [
            'title' => 'Log In',
            'principalMessage' => 'Happy to see you!',
            'secondMessage' => "Log in to stay updated on the Wizarding World.",
            'logInAction' => URLROOT . '/logIn',
            'email' => 'Email',
            'emailError' =>  'Please enter a valid email.',
            'password' => "Password",
            'passwordError' => 'Please enter a password with 8 characters.',
            'registerMessage' => "Do you already have an account?",
            'registerLink' => URLROOT . '/register',
            'register' => 'Register' 
        ];

        // Constructor de la clase
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        // Función para orquestar el inicio de sesión
        public function logIn() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $temp = [
                    'email' => trim($POST['email']),
                    'password' => trim($POST['password'])
                ];

                if(isset($temp['email']) && isset($temp['password'])) {
                    if(!($this->userModel->findEmail($temp['email']))) {
                        echo '<script language="javascript">';
                            echo 'alert("Email not registered.")';
                        echo '</script>';
                    } elseif($this->userModel->authenticateUser($temp['email'], $temp['password'])) {
                        $this->createUserSession($temp);
                        return;
                    } else {
                        echo '<script language="javascript">';
                            echo 'alert("Wrong password.")';
                        echo '</script>';
                    }
                }
            } 
            $this->view('logIn', $this->data);
        }

        // Función para crear la sesión de usuario
        public function createUserSession($temp) {
            session_start();
            $user = $this->userModel->getUserByEmail($temp['email']);
            $_SESSION['username'] = $user->username;
            $_SESSION['role'] = $user->role;
            redirect('dashboard');
        }

        // Función para generar el controlador de registro
        public function register() {
            $init = new Core();
            $init->setController('RegisterController', 'register');
        }

        // Función para generar el controlador principal
        public function dashboard() {
            $init = new Core();
            $init->setController('DashboardController', 'dashboard');
        }

        // Función para construir el controlador de creación de publicaciones
        public function share() {
            $init = new Core();
            $init->setController('ShareController', 'share');
        }

        // Función para prellenar el controlador de edición de publicaciones
        public function edit($id) {
            $init = new Core();
            $init->setController('ShareController', 'edit', $id);
        }

        // Función para construir el controlador de edición de publicaciones
        public function editPublication($id) {
            $init = new Core();
            $init->setController('ShareController', 'editPost', $id);
        }

        // Función para llamar al controlador de eliminación de publicaciones
        public function delete($id) {
            $init = new Core();
            $init->setController('ShareController', 'delete', $id);
        }

        // Función para destruir la sesión de usuario
        public function logOut() {
            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
            redirect("logIn");
        }
    }
?>