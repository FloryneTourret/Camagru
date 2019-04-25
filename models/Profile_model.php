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
        $req = $this->db->prepare("SELECT * from `pictures` WHERE `picture_user_id` = '$id' ORDER BY `picture_id` DESC");
        $req->execute();
        return ($req->fetchAll());
    }

    public function get_likes_pictures($id){
        $req = $this->db->prepare("SELECT * from `likes` 
                                    INNER JOIN `pictures` on pictures.picture_id = likes.like_picture_id
                                    INNER JOIN `users` on users.user_id = pictures.picture_user_id
                                    WHERE `like_user_id` = '$id' ORDER BY `picture_id` DESC");
        $req->execute();
        return ($req->fetchAll());
    }

    public function get_image($id){
        $req = $this->db->prepare("SELECT `picture_id`, `picture_path`, `picture_desc`, `picture_user_id`, `picture_date`, `user_id`, `firstname`, `lastname`, `login`, `email`, `biography`, `path_profile_picture`, `password`, `admin`, `enabled`, `notif`,
                                (select count(*) from likes inner join `users` on users.user_id = likes.like_user_id where likes.like_picture_id = pictures.picture_id) as likes_count,
                                (select count(*) from comments inner join `users` on users.user_id = comments.comment_user_id where comments.comment_picture_id = pictures.picture_id) as comments_count 
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

    public function like_image($picture_id, $id){
        $req = $this->db->prepare("INSERT INTO `likes`(`like_user_id`, `like_picture_id`) VALUES ($id, $picture_id)");
        $req->execute();
    }

    public function unlike_image($picture_id, $id){
        $req = $this->db->prepare("DELETE FROM `likes` WHERE `like_user_id` = $id AND `like_picture_id` = $picture_id");
        $req->execute();
    }

    public function del_image($id){
        $req = $this->db->prepare("DELETE FROM `pictures` WHERE `picture_id` = $id");
        $req->execute();
    }

    public function comment_image($picture_id, $id, $comment){
        $req = $this->db->prepare("INSERT INTO `comments`(`comment_user_id`, `comment_picture_id`, `comment_content`) VALUES ($id, $picture_id, '$comment')");
        $req->execute();
    }
}

?>