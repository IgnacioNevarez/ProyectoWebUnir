<?php
    class RegisterController extends Controller {
        // Creación del arreglo con los datos a ser transmitidos hacia la vista
        private $data = [
            'title' => 'Register',
            'principalMessage' => 'Sign Up',
            'secondMessage' => "Enjoy your free time with us.",
            'registerAction' => URLROOT . '/register',
            'username' => 'Username',
            'usernamePrefix' => '@',
            'usernameError' => 'Please enter a username.',
            'email' => 'Email',
            'emailError' => 'Please enter a valid email.',
            'password' => "Password",
            'passwordError' => 'Please enter a password with 8 characters.',
            'role' => "Role: ",
            'wizardRole' => 'Wizard',
            'witchRole' => 'Witch',
            'logInMessage' => "Don't have an account yet?",
            'logInLink' => URLROOT . '/logIn',
            'logIn' => ' Log In' 
        ];

        // Constructor de la clase
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        // Función para orquestar el registro de usuario
        public function register() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $temp = [
                    'username' => '@' . trim($POST['username']),
                    'email' => trim($POST['email']),
                    'password' => trim($POST['password']),
                    'role' => trim($POST['role'])
                ];

                if(isset($temp['username']) && isset($temp['email']) && isset($temp['password']) && isset($temp['role'])) {
                    if($this->userModel->findUsername($temp['username'])) {
                        echo '<script language="javascript">';
                            echo 'alert("Username already taken.")';
                        echo '</script>';
                    } elseif($this->userModel->findEmail($temp['email'])) {
                        echo '<script language="javascript">';
                            echo 'alert("Email already taken.")';
                        echo '</script>';
                    } else {
                        $temp['password'] = password_hash($temp['password'], PASSWORD_DEFAULT);
                        if($this->userModel->saveUser($temp)) {
                            redirect('logIn');
                        } else {
                            echo '<script language="javascript">';
                                echo 'alert("Something failed.")';
                            echo '</script>';
                        }
                    }
                }
            } 
            $this->view('register', $this->data);
        }

        // Función para generar el controlador de inicio de sesión
        public function logIn() {
            $init = new Core();
            $init->setController();
        }
    }
?>