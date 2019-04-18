<?php

Class Profile extends Controller{

    public function index($login = NULL){
        $this->loadModel('Profile_model');
        $data = array();
        if ($login == NULL)
            if(isset($_SESSION['user']))
                $login = $_SESSION['user']['login'];
        else
            $login = htmlspecialchars(addslashes($login));
        $data['user'] = $this->Profile_model->get_current($login);
        $id = $data['user']['user_id'];
        $data['pictures'] = $this->Profile_model->get_pictures($id);
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

    public function picture($id = NULL){
        $this->loadModel('Profile_model');
        $data = array();
        
        $data['image'] = $this->Profile_model->get_image($id);
        if (empty($data['image']))
        {
            $data['error'] = "L'image que vous recherchez n'existe pas.";
            $this->loadView('Base/navbar_view');
            $this->loadView('Base/header_view');
            $this->loadView('Profile/invalid_view', $data);
            $this->loadView('Base/footer_view');
        }
        else
        {
            $data['comments'] = $this->Profile_model->get_comments($id);
            $data['likes'] = $this->Profile_model->get_likes($id);
            $this->loadView('Base/header_view');
            $this->loadView('Base/navbar_view');
            $this->loadView('Profile/picture_view', $data);
            $this->loadView('Base/footer_view');
        }
    }
}