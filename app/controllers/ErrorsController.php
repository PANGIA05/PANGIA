<?php
class ErrorsController extends AppController {
    public function beforeFilter() {
        //parent::beforeFilter();
        //$this->Auth->allow('error404');
    }

    public function error404() {//die('here');
        $this->layout = 'comman';
    }
}
