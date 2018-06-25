<?php

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel($this->database->getConnection());
    }

    public function clear()
    {
        $this->cart->clear();

        $this->view->render(
            ['header'],
            [
                'products' => $this->model,
                'cart' => $this->cart,
            ],
            null,
            false
        );
    }

    public function add()
    {
        $m = $_SERVER['REQUEST_METHOD'];

        $id = $_POST['id'];
        $cnt = $_POST['count'];
        $price = $_POST['price'];

        // Можна винести в окремий клас при потребі

        filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        filter_var($price, FILTER_SANITIZE_NUMBER_INT);
        filter_var($cnt, FILTER_SANITIZE_NUMBER_INT);

        if (filter_var($id, FILTER_VALIDATE_INT) === false
            || filter_var($price, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false
            || filter_var($cnt, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 999]]) === false) {

            require_once PATH_CONTROLLERS . 'ErrorController.php';
            $err = new ErrorController();
            $err->error404(true);
        }

        $this->cart->add($id, $price, $cnt);

        $this->view->render(
            ['header'],
            [
                'products' => $this->model,
                'cart' => $this->cart,
            ],
            null,
            false
        );
    }

    public function del()
    {
        $id = $_POST['id'];

        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            require_once PATH_CONTROLLERS . 'ErrorController.php';
            $err = new ErrorController();
            $err->error404(true);
        }

        $this->cart->remove($id);

        $this->view->render(
            ['header'],
            [
                'products' => $this->model,
                'cart' => $this->cart,
            ],
            null,
            false
        );
    }
}