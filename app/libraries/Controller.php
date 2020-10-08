<?php
// This is the base controller
// it loads both the model and views

class Controller{
    // load the model
    public function model($model){
        // require the model file
        require_once '../app/models/' . $model . '.php';

        //instantiate the new model
        return new $model();
        // e.g if post was passed in as the $model it will return   new Post();
    }

    // load the view
    public function view($view, $data = []){
        // check if the view file exist
        if(file_exists('../app/views/' . $view . '.php')){
            // require the view
        require_once '../app/views/' . $view . '.php';
        } else {
            // file does not exit
            die('View Does not exist');
        }
    }
}