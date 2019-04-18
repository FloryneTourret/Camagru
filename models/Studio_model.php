<?php

Class Studio_model extends Model
{
    public function addimg($path, $id)
    {
        $req = $this->db->prepare("INSERT INTO `pictures`(`picture_path`, `picture_user_id`) VALUES ('$path', $id)");
        $req->execute();
    }
}

?>