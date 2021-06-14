<?php
namespace Core;

use Core\Database\Connection;
use Core\Interfaces\SimpleKernelInterface;

class SimpleKernel implements SimpleKernelInterface
{
    public function init()
    {
        $uri = parse_url($_SERVER['REQUEST_URI']);
        //new php version have issue with split so using explode instead
        $parameters = explode('/', $uri['path']);
        // get query using $uri['query'] // TODO
        $start = $this->getStartPoint($parameters);
        if ($start != -1) {
            $this->callControllerWithFunction($parameters, $start);
        } else {
            echo "404 not found";
        }
    }

    private function callControllerWithFunction($parameters, $start)
    {
        $controllerName = ucfirst($parameters[$start]);
        $functionName =strtolower($_SERVER['REQUEST_METHOD']). ucfirst($parameters[$start+1]) ;
        $start+=2;
        $args = array();
        for (;$start < count($parameters); $start++) {
            array_push($args, $parameters[$start]);
        }
        $refClass = new \ReflectionClass("Controller".'\\'.$controllerName);
        $model="Model".'\\'.$controllerName."Model";
        $object = $refClass->newInstanceArgs([new $model(new Connection())]);
        if (method_exists($object, $functionName)) {
            call_user_func_array(array($object, $functionName), $args);
        } else {
            echo '<h1>404 not found</h1>';
        }
    }

    private function getStartPoint($uri)
    {
        foreach ($uri as $key => $value) {
            if ($value == 'index.php') {
                if ($key == count($uri) - 1) {
                    return -1;
                }

                return $key+1;
            }
        }
    }
}
