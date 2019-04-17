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
}

?>