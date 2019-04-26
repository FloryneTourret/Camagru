<?php

Class Studio_model extends Model
{
    public function addimg($path, $id, $desc)
    {
        $req = $this->db->prepare("INSERT INTO `pictures`(`picture_path`, `picture_user_id`, `picture_desc`) VALUES ('$path', $id, '$desc')");
        $req->execute();
    }

    public function get_filters()
    {
        $req = $this->db->prepare("SELECT * FROM `filters`");
        $req->execute();
        return ($req->fetchAll());
    }

    public function get_last_pictures($id)
    {
        $req = $this->db->prepare("SELECT * FROM `pictures` WHERE `picture_user_id` = '$id' ORDER BY picture_date DESC LIMIT 5");
        $req->execute();
        return ($req->fetchAll());
    }
}

?>