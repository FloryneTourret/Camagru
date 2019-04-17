<?php

Class Admin extends Controller{

    public function index(){
        if(!isset($_SESSION['user']))
            header('Location: /');
        if($_SESSION['user']['admin'] != 1)
            header('Location: /');

        $data = array();
        $this->loadModel('Admin_model');
        $data['users'] = $this->Admin_model->get_users();

        if(isset($_GET['ban']) && is_numeric($_GET['ban']))
        {
            $this->Admin_model->ban_users($_GET['ban']);
        }
        if(isset($_GET['unban']) && is_numeric($_GET['unban']))
        {
            $this->Admin_model->unban_users($_GET['unban']);
            
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Admin/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>