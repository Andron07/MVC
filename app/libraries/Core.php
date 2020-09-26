<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 *
*/

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        // $this->getUrl();
        $url = $this->getUrl();

        // Look in controllers for first controller
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.controller.php')) {
            // If exists, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }

        // require the controller the controller
        require_once '../app/controllers/' . $this->currentController . '.controller.php';

        //Instantiate controller class
        $this->currentController = new $this->currentController();

        // Check for second part of the URL
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // unset 1 Index
                unset($url[1]);
            }
        }

        // Get Params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
