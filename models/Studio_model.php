<?php

Class Studio_model extends Model
{
    public function addimg($path, $id, $desc)
    {
        $req = $this->db->prepare("INSERT INTO `pictures`(`picture_path`, `picture_user_id`, `picture_desc`) VALUES ('$path', $id, '$desc')");
        $req->execute();
    }
}

?>