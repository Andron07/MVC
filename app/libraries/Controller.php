<?php
/*
 * Base Controller class
 * Loads the models and views
 */

class Controller
{
    // Load model
    public function model($model)
    {
        // Require model file
        if (file_exists('../app/models/' . $model . '.model.php')) {
            require_once '../app/models/' . $model . '.model.php';

            // Instantiate the model
            return new $model();
        }
    }

    // Load view
    public function view($view, $data = [])
    {
        // check for the view file
        if (file_exists('../app/views/' . $view . '.view.php')) {
            require_once '../app/views/' . $view . '.view.php';
        } else {
            die('View does not exist.');
        }
    }
}
