<?php
    class Publication {
        // Referencia a la BD
        private $db;

        // Constructor de la clase
        public function __construct() {
            $this->db = new Database;
        }

        // Función para guardar una publicación en la BD
        public function savePublication($data) {
            $this->db->query('INSERT INTO Publications (username, role, publication) VALUES(:username, :role, :publication)');
        
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':publication', $data['publication']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Función para recuperar una publicación dado su id
        public function getPublicationById($id) {
            $this->db->query("SELECT * FROM Publications WHERE publicationID = :id");
      
            $this->db->bind(':id', $id);
            
            $row = $this->db->single();
      
            return $row;
        }

        // Función para editar una publicación
        public function updatePublication($data) {
            $this->db->query('UPDATE Publications SET publication = :publication WHERE publicationID = :id');
        
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':publication', $data['publication']);
                
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    
        // Función para eliminar una publicación
        public function deletePublication($id) {
            $this->db->query('DELETE FROM Publications WHERE publicationID = :id');
        
            $this->db->bind(':id', $id);
                
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Función para recuperar todas las publicaciones de la BD
        public function getPublications() {
            $this->db->query("SELECT * FROM Publications");
        
            $results = $this->db->resultset();
        
            return $results;
        }
    }
?>