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

}

?>