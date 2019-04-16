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

    public function account_activated($email)
    {
        $req = $this->db->prepare("SELECT * FROM users WHERE `email` = '$email'");
        $req->execute();
        $user = $req->fetch();
        if($user['enabled'] == 1)
            return (TRUE);
        else
            return (FALSE);
    }

    public function register($firstname, $lastname, $login, $email, $password, $token)
    {
        $req = $this->db->prepare("INSERT INTO `users`(`firstname`, `lastname`, `login`, `email`, `password`, `token`, `token_expiration`) 
                                    VALUES ('$firstname','$lastname','$login','$email','$password', '$token', NOW() + INTERVAL 1 DAY)");
        $req->execute();
    }

    public function create_token($email, $token)
    {
        $req = $this->db->prepare("UPDATE `users` SET `token` = '$token', `token_expiration` =  NOW() + INTERVAL 1 DAY WHERE `email` = '$email'");
        $req->execute();
    }

    public function token_exists($token)
    {
        $req = $this->db->prepare("SELECT * FROM users WHERE `token` = '$token'");
        $req->execute();
        if (!empty($req->fetchAll()))
            return TRUE;
        else
            return FALSE;
    }

    public function expirated_token($token)
    {
        $req = $this->db->prepare("SELECT * FROM users WHERE `token` = '$token'");
        $req->execute();
        $user = $req->fetch();

        $date = date("Y-m-d");
		$datetime1 = new DateTime($date);
        $datetime2 = new DateTime($user['token_expiration']);
        $interval = $datetime1->diff($datetime2);
		if($interval->format('%R%a') >= 0)
            return FALSE;
        else
            return TRUE;
    }

    public function activate($token)
    {
        $req = $this->db->prepare("UPDATE `users` SET `enabled`= 1,`token`= NULL,`token_expiration` = NULL WHERE `token` = '$token'");
        $req->execute();
    }
}