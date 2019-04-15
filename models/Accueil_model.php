<?php

Class Accueil_model extends Model
{
    function get_users()
    {
        $req = $this->db->prepare("SELECT * FROM users");
        $req->execute();
        return ($req->fetchAll());
    }
}

?>