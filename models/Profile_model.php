<?php 

Class Profile_model extends Model
{
    public function get_current($login)
    {
        $req = $this->db->prepare("SELECT * from `users` WHERE `login` = '$login'");
        $req->execute();
        return ($req->fetch());
    }

    public function get_pictures($id){
        $req = $this->db->prepare("SELECT * from `pictures` WHERE `picture_user_id` = '$id'");
        $req->execute();
        return ($req->fetchAll());
    }

    public function get_image($id){
        $req = $this->db->prepare("SELECT `picture_id`, `picture_path`, `picture_title`, `picture_desc`, `picture_user_id`, `picture_date`, `user_id`, `firstname`, `lastname`, `login`, `email`, `biography`, `path_profile_picture`, `password`, `admin`, `enabled`,
                                (select count(*) from likes where likes.like_picture_id = pictures.picture_id) as likes_count,
                                (select count(*) from comments where comments.comment_picture_id = pictures.picture_id) as comments_count 
                                FROM `pictures` 
                                INNER JOIN `users` on users.user_id = pictures.picture_user_id
                                WHERE `picture_id` = $id");
        $req->execute();
        return($req->fetch());
    }

    public function get_likes($id){
        $req = $this->db->prepare("SELECT `login` FROM `likes`
                                INNER JOIN `users` on users.user_id = likes.like_user_id
                                WHERE `like_picture_id` = $id");
        $req->execute();
        return($req->fetchAll());
    }

    public function get_comments($id){
        $req = $this->db->prepare("SELECT * FROM `comments`
                                INNER JOIN `users` on users.user_id = comments.comment_user_id
                                WHERE `comment_picture_id` = $id");
        $req->execute();
        return($req->fetchAll());
    }
}

?>