<?php

Class Accueil extends Controller{

    public function index($page = 1){
        $this->loadModel('Accueil_model');
        $data['pictures'] = $this->Accueil_model->get_pictures(($page - 1) * 5);
        $data['nb_pages'] = $this->Accueil_model->get_nb_pages(); 
        $data['page'] = $page; 

        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Accueil/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>