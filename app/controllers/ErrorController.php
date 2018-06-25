<?php
    
    class ErrorController extends Controller
    {
        public function error404(bool $simple = false)
        {
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Fount', true, 404);
            
            if ($simple) {
                exit();
            }
            
            $this->view->render(['error404'], [], 'Error', true);
        }
    }