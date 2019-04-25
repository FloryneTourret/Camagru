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
        $data['likes'] = $this->Profile_model->get_likes_pictures($id);
        $data['login'] = $login;
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
        if(isset($_GET['like']) && $_GET['like'] == true)
            $this->Profile_model->like_image($id, $_SESSION['user']['user_id']);
        if(isset($_GET['unlike']) && $_GET['unlike'] == true)
            $this->Profile_model->unlike_image($id, $_SESSION['user']['user_id']);
        if(isset($_GET['delete']) && $_GET['delete'] == true)
            if($_SESSION['user']['user_id'] == $data['image']['user_id'])
                $this->Profile_model->del_image($id, $_SESSION['user']['user_id']);
        if(isset($_GET['comment']))
        {
            $comment = trim(htmlspecialchars(addslashes($_GET['comment'])));
            $this->Profile_model->comment_image($id, $_SESSION['user']['user_id'], $comment);
            if($data['image']['notif'] == 1)
            {
                $message = "Bonjour ".$data['image']['login']."\r\nVous avez reçu un commentaire sur l'une de vos images.\r\n";
                mail($data['image']['email'], 'Camagru - Commentaire', $message);
            }
        }
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
            $this->loadView('Profile/picture_view', $data);
        }
    }
}