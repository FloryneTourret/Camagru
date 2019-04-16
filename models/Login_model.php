<?php

Class Login_model extends Model
{
    public function get_user($login)
    {
        $req = $this->db->prepare("SELECT * FROM `users` WHERE `login` = '$login'");
        $req->execute();
        return ($req->fetch());
    }
}

?>