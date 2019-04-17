<?php 

Class Profile_model extends Model
{
    public function get_current($login)
    {
        $req = $this->db->prepare("SELECT * from `users` WHERE `login` = '$login'");
        $req->execute();
        return ($req->fetch());
    }
}

?>