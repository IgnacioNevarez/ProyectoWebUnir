<?php
    class Core {
        // Función para registrar el controlador actual, el método invocado y sus parámetros
        public function setController($currentController = 'SuperController', $currentMethod = 'logIn', $params = []) {
            $url = $this->getUrl();

            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
                $currentController = ucwords($url[0]);
                unset($url[0]);
            }

            require_once('../app/controllers/' . $currentController . '.php');
            $currentController = new $currentController;

            if(isset($url[0])) {
                if(method_exists($currentController, $url[0])) {
                $currentMethod = $url[0];
                unset($url[0]);
                }
            }

            $params = $url ? array_values($url) : [];
            call_user_func_array([$currentController, $currentMethod], $params);
        }

        // Función para generar la url correspondiente a la vista elegida
        public function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>