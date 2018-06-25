<?php

// Клас для роботи з шаблонами.

class View
{
    private $viewTitle;
    private $viewData;
    private $viewContent;

    public function render(array $views, array $data, ?string $title, bool $layout = true): void
    {
        $this->viewTitle = $title;
        $this->viewData = $data;

        ob_start();

        if (!empty($views)) {
            foreach ($views as $view) {
                require_once PATH_VIEWS . $view . '.php';
            }
        }

        $this->viewContent = ob_get_clean();

        if ($layout) {
            require_once PATH_VIEWS . 'layout.php';
        } else {
            echo $this->viewContent;
        }
    }
}