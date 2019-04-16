<?php

Class Profile extends Controller{

    public function index(){
        if(!isset($_SESSION['user']))
            header('Location: /');
    }
}