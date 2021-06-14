<?php
namespace Core;

use Core\Interfaces\ControllerInterface;
use Core\Interfaces\ModelInterface;

class Controller
{
    public function __construct(ModelInterface $model)
    {
        $this->model = $model;
    }
    public function loadView($view, $args)
    {
        foreach ($args as $argName => $argValue) {
            $$argName = $argValue;
        }
        require_once(__DIR__.'/../View/'.$view.'.php');
    }
}
