<?php
    class User {
        // Referencia a la BD
        private $db;

        // Constructor de la clase
        public function __construct() {
            $this->db = new Database;
        }

        // Función para regisrar al usuario en la BD
        public function saveUser($data) {
            $this->db->query('INSERT INTO Users (username, email, password, role) VALUES(:username, :email, :password, :role)');
        
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':role', $data['role']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Función para recuperar un usuario dado su email
        public function getUserByEmail($email) {
            $this->db->query("SELECT * FROM Users WHERE email = :email");
      
            $this->db->bind(':email', $email);
            
            $row = $this->db->single();

            return $row;
        }

        // Función para buscar un nombre de usuario en la BD
        public function findUsername($username) {
            $this->db->query('SELECT * FROM Users WHERE username = :username');

            $this->db->bind(':username', $username);

            $row = $this->db->single();

            if($this->db->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        }

        // Función para buscar un email en la BD
        public function findEmail($email) {
            $this->db->query('SELECT * FROM Users WHERE email = :email');

            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        }

        // Función para autenticar a un usuario con su nombre de usuario y contraseña
        public function authenticateUser($email, $password) {
            $this->db->query('SELECT * FROM Users WHERE email = :email');

            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;

            if(password_verify($password, $hashed_password)) {
                return $hashed_password;
            } else {
                return false;
            }
        }
    }
?>