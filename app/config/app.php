<?php
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    define('DEFAULT_CONTROLLER', 'index');
    define('DEFAULT_ACTION', 'index');
    
    define('PATH_ROOT', dirname(__DIR__, 2).DIRECTORY_SEPARATOR);
    define('PATH_APP', PATH_ROOT.'app'.DIRECTORY_SEPARATOR);
    define('PATH_CONTROLLERS', PATH_APP.'controllers'.DIRECTORY_SEPARATOR);
    define('PATH_MODELS', PATH_APP.'models'.DIRECTORY_SEPARATOR);
    define('PATH_VIEWS', PATH_APP.'views'.DIRECTORY_SEPARATOR);
    define('PATH_CORE', PATH_APP.'core'.DIRECTORY_SEPARATOR);
    define('PATH_SHOP', PATH_APP.'shop'.DIRECTORY_SEPARATOR);