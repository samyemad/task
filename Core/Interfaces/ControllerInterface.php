<?php
namespace Core\Interfaces;

interface ControllerInterface
{
    public function loadView($view, $args);
}
