<?php

Class Account_model extends Model
{
    public function isPasswordOk($password, $id)
    {
        $req = $this->db->prepare("SELECT `password` FROM `users` WHERE `user_id` = '$id'");
        $req->execute();
        $user = $req->fetch();
        if (password_verify($password, $user['password']))
            return TRUE;
        else
            return FALSE;
    }

    public function changePassword($password, $id)
    {
        $req = $this->db->prepare("UPDATE `users` SET `password` = '$password' WHERE `user_id` = '$id'");
        $req->execute();
    }

    public function updateProfile($firstname, $lastname, $login, $email, $bio, $id){
        $req = $this->db->prepare("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `login` = '$login',
        `email` = '$email', `biography` = '$bio' WHERE `user_id` = '$id'");
        $req->execute();
    }

    public function updateNotif($notif, $id)
    {
        $req = $this->db->prepare("UPDATE `users` SET `notif` = '$notif' WHERE `user_id` = '$id'");
        $req->execute();
    }
    
    public function addimg($path, $id)
    {
        $req = $this->db->prepare("UPDATE `users` SET `path_profile_picture` = '$path' WHERE `user_id` = '$id'");
        $req->execute();
    }

    public function delete($id){
        $req = $this->db->prepare("DELETE FROM `users` WHERE `user_id` = '$id'");
        $req->execute();
    }
}

?>