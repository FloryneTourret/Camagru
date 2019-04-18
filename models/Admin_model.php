<?php

Class Admin_model extends Model
{
    public function get_users(){
        $req = $this->db->prepare("SELECT * FROM `users` WHERE 1 ORDER BY `admin` DESC");
        $req->execute();
        return ($req->fetchAll());
    }

    public function ban_users($id){
        $req = $this->db->prepare("UPDATE `users` SET `enabled`= -1 WHERE `user_id` = $id");
        $req->execute();
    }

    public function unban_users($id){
        $req = $this->db->prepare("UPDATE `users` SET `enabled`= 1 WHERE `user_id` = $id");
        $req->execute();
    }

    public function register($firstname, $lastname, $login, $email, $token)
    {
        $req = $this->db->prepare("INSERT INTO `users`(`firstname`, `lastname`, `login`, `email`, `token`, `token_expiration`, `admin`) 
                                    VALUES ('$firstname','$lastname','$login','$email', '$token', NOW() + INTERVAL 1 DAY, 1)");
        $req->execute();
    }

    public function activate($token, $password)
    {
        $req = $this->db->prepare("UPDATE `users` SET `password`= '$password', `enabled`= 1,`token`= NULL,`token_expiration` = NULL WHERE `token` = '$token'");
        $req->execute();
    }

}

?>