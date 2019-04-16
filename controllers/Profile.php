<?php

Class Profile extends Controller{

    public function index(){
        if(!isset($_SESSION['user']))
            header('Location: /');

        $data = array();
        //$this->loadModel('Profil_model');

        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Profil/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}