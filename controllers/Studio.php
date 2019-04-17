<?php

Class Studio extends Controller{

    public function index(){
        // $this->loadModel('Accueil_model');
        // $data['users'] = $this->Accueil_model->get_users();
        $this->loadModel('Studio_model');
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        //$this->loadView('Accueil/index_view', $data);
        $this->loadView('Studio/index_view');
        $this->loadView('Base/footer_view');
    }
}

?>