<?php

Class Logout extends Controller{

    public function index(){
        $_SESSION = array();
        session_destroy();
        header('Location: /index.php');
    }
}

?>