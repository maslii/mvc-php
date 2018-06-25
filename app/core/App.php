<?php

// Шаблон розбору url: /controller/action/param1/param2...
// url передається в якості GET параметру, просте можна використати змінну $_SERVER['REQUEST_URI']

class App
{
    private $actionName;
    private $controllerName;
    private $params = [];
    
    private function splitURL(string $url): void
    {
        $urlArray = trim($url, '/');
        $urlArray = trim($urlArray);
        $urlArray = filter_var($urlArray, FILTER_SANITIZE_URL);
        $urlArray = explode('/', $urlArray);
        
        $this->controllerName = $urlArray[0] ?? null;
        $this->actionName = $urlArray[1] ?? null;
        unset($urlArray[0], $urlArray[1]);
        $this->params = array_values($urlArray);
    }
    
    public function __construct()
    {
        if (isset($_GET['url'])) {
            $this->splitURL($_GET['url']);
        }
        
        $this->controllerName = $this->controllerName ?? DEFAULT_CONTROLLER;
        $this->actionName = $this->actionName ?? DEFAULT_ACTION;
        
        $this->controllerName = ucfirst($this->controllerName).'Controller';
        
        if (file_exists(PATH_CONTROLLERS.$this->controllerName.'.php')) {
            
            require_once PATH_CONTROLLERS.$this->controllerName.'.php';
            $controller = new $this->controllerName();
            
            if (method_exists($controller, $this->actionName)) {
                if (!empty($this->params)) {
                    call_user_func_array(
                        [$controller, $this->actionName],
                        $this->params
                    );
                } else {
                    $controller->{$this->actionName}();
                }
            } else {
                require PATH_CONTROLLERS.'ErrorController.php';
                $controller = new ErrorController();
                $controller->error404();
            }
        } else {
            require PATH_CONTROLLERS.'ErrorController.php';
            $controller = new ErrorController();
            $controller->error404();
        }
    }
}