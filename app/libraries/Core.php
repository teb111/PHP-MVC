<?php
/*
* App Core Class
* Creates URL & loads core controller
* URL FORMAT - /controller/method/params
*/

class Core {
  // properties
  protected $currentController = 'Pages';
  protected $currentMethod     = 'index';
  protected $params            = []; 

  public function __construct()
  {
    //  print_r($this->getUrl());

    $url = $this->getUrl();

    // look in the controller for the first value
    if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
      // if the file exists, overide the default and set it as the current contoller on line 10
      $this->currentController = ucwords($url[0]);
      // then we want to unset the zero index
      unset($url[0]);
    }
      //require the controller
      require_once '../app/controllers/' . $this->currentController. '.php';

      // instantiate the controller class
      $this->currentController = new $this->currentController;
      // i.e $Pages = new Pages

      // CHECK FOR THE SECOND PART OF THE URL
      if(isset($url[1])){
          // check if the method exists in the controller
          if(method_exists($this->currentController, $url[1])){
              $this->currentMethod = $url[1];

              //we want to unset the 1 index
              unset($url[1]);
          }
      }

       // Get Params
       $this->params = $url ? array_values($url) : [];

       // call a callback with an array of params
       call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    
  }

  public function getUrl() {
      if(isset($_GET['url'])) {
          $url = rtrim($_GET['url'], '/');
          $url = filter_var($url, FILTER_SANITIZE_URL);
          $url = explode('/', $url);
          return $url;
      }
  }
}