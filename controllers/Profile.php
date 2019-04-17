<?php

Class Profile extends Controller{

    public function index($login = NULL){
        if(!isset($_SESSION['user']))
            header('Location: /');
        
        $this->loadModel('Profile_model');
        $data = array();
        if ($login == NULL)
            $login = $_SESSION['user']['login'];
        else
            $login = htmlspecialchars(addslashes($login));
        $data['user'] = $this->Profile_model->get_current($login);
        if ($data['user'] == FALSE)
        {
            $data['error'] = "Le profil que vous recherchez n'existe pas.";
            $this->loadView('Base/navbar_view');
            $this->loadView('Base/header_view');
            $this->loadView('Profile/invalid_view', $data);
            $this->loadView('Base/footer_view');
        }
        else
        {
            $this->loadView('Base/header_view');
            $this->loadView('Base/navbar_view');
            $this->loadView('Profile/index_view', $data);
            $this->loadView('Base/footer_view');
        }
    }
}