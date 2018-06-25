<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel($this->database->getConnection());
    }

    public function index()
    {
        $this->cart->refresh($this->model->getAll());
        $this->view->render(['header', 'home'], [
            'products' => $this->model,
            'cart' => $this->cart,
        ], 'Крамниця');
    }
}