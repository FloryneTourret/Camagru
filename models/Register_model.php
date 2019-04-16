<?php

Class Register_model extends Model
{
    public function email_already_used($email)
    {
        $req = $this->db->prepare("SELECT * FROM users WHERE `email` = '$email'");
        $req->execute();
        if(!empty($req->fetchAll()))
            return (TRUE);
        else
            return (FALSE);
    }

    public function login_already_used($login)
    {
        $req = $this->db->prepare("SELECT * FROM users WHERE `login` = '$login'");
        $req->execute();
        if(!empty($req->fetchAll()))
            return (TRUE);
        else
            return (FALSE);
    }

    public function register($firstname, $lastname, $login, $email, $password)
    {
        $req = $this->db->prepare("INSERT INTO `users`(`firstname`, `lastname`, `login`, `email`, `password`) 
                                    VALUES ('$firstname','$lastname','$login','$email','$password')");
        $req->execute();
    }
}