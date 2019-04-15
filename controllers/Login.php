<?php

Class Login extends Controller{

    public function index(){
        $this->loadModel('Login_model');
        // $users = $this->Login_model->get_users();

        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Login/index_view');
        $this->loadView('Base/footer_view');
    }
}

?>