<?php

Class Accueil_model extends Model
{
    public function get_pictures($offset){
        $req = $this->db->prepare("SELECT `picture_id`, `picture_path`, `picture_desc`, `picture_user_id`, `picture_date`, `user_id`, `firstname`, `lastname`, `login`, `email`, `biography`, `path_profile_picture`, `password`, `admin`, `enabled`, `notif`,
                                (select count(*) from likes inner join `users` on users.user_id = likes.like_user_id where likes.like_picture_id = pictures.picture_id) as likes_count,
                                (select count(*) from comments inner join `users` on users.user_id = comments.comment_user_id where comments.comment_picture_id = pictures.picture_id) as comments_count 
                                FROM `pictures` 
                                INNER JOIN `users` on users.user_id = pictures.picture_user_id
                                ORDER BY `picture_id` DESC LIMIT 5 OFFSET $offset");
        $req->execute();
        return($req->fetchAll());
    }

    public function get_nb_pages(){
        $req = $this->db->prepare("SELECT count(*) as `nb_pictures` FROM `pictures` 
                                INNER JOIN `users` on users.user_id = pictures.picture_user_id
                                ORDER BY `picture_id` DESC");
        $req->execute();
        return(ceil($req->fetch()['nb_pictures'] / 5));
    }
}

?>