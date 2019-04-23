<div class="content_picture">
    <div class="columns infos">
        <div class="column">
            <div class="columns">
                <div class="column is-half">
                    <div style='background-image: url("/<?php echo $image['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 64px; width: 64px;float: left;'></div>
                    <p class="has-text-weight-semibold is-size-4 login"><?php echo $image['login']; ?></p>
                </div>
                <div class="has-text-right column is-half">
                    <?php 
                    if(isset($_SESSION['user']['user_id']))
                        if ($image['user_id'] == $_SESSION['user']['user_id'])
                        echo '<small class="has-text-danger" id="delete" onclick="delete_picture('.$image['picture_id'].')"><i class="fas fa-trash"></i></small><br>';
                    ?>
                    <small class="timestamp is-italic date"><?php echo $image['picture_date']; ?></small>
                </div>
            </div>
        </div>
    </div>
            
    <img class="picture" src="/<?php echo $image['picture_path']; ?>">

    <?php 
    $liked = 0;
    foreach ($likes as $like)
        if($like['login'] == $_SESSION['user']['login'])
            $liked = 1;
    ?>
    <div class="columns">
        <div class="column">
            <div class="columns">
                <div class="column is-half">
                    <div id="likes">
                    <?php if ($liked == 1) { ?>
                        <span class="has-text-danger is-size-5 like" id="unlike" onclick="unlike(<?php echo $image['likes_count']; ?>, <?php echo $image['picture_id']; ?>)"><i class="fas fa-heart"></i><?php echo $image['likes_count']; ?></span>
                    <?php }else{ ?>
                        <span class="has-text-danger is-size-5 like" id="like" onclick="like(<?php echo $image['likes_count']; ?>, <?php echo $image['picture_id']; ?>)"><i class="far fa-heart"></i><?php echo $image['likes_count']; ?></span>
                    <?php } ?>
                    </div>
                    <?php 
                    $i = 0;
                    if($image['likes_count'] > 0)
                    echo '<span>Aimé par ';
                    foreach($likes as $like) {
                        $i++;
                        if($i < 3 && $i < $image['likes_count'])
                            echo '<span>'.$like['login'].', </span>';
                        else if ($i < 3 && $i == $image['likes_count'])
                            echo '<span>'.$like['login'].'</span>';
                        else if($i == 3 && $i < $image['likes_count'])
                            echo '<span>'.$like['login'].' et '.($image['likes_count'] - 3).(($image['likes_count'] - 3) == 1 ?' autre personne' : ' autres personnes').'</span>';
                        else if($i == 3 && $i == $image['likes_count'])
                            echo '<span>'.$like['login'].'</span>';
                    }
                    echo '</span>';
                    ?>
                </div>
                <div class="column is-half has-text-right">
                    <span class="has-text-primary is-size-5 comment"><i class="fas fa-comment"></i><?php echo $image['comments_count']; ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="columns">
        <div class="column">

            <?php foreach ($comments as $comment){?>
            <article class="media">
                <figure class="media-left">
                <p>
                    <?php if (!empty($comment['path_profile_picture'])){?>
                    <div style='background-image: url("/<?php echo $comment['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 45px; width: 45px;'>
                <?php }else{ ?>
                    <div style='background-image: url("/assets/img/avatar.png"); background-size: cover; border-radius: 100%; background-position: 50% 50%; height: 45px; width: 45px;'>
                <?php } ?>
                    </div>
                    </p>
                </figure>
                <div class="media-content">
                    <div class="content">
                        <div class="columns" style="margin-bottom: 0;">
                            <div class="column is-half">
                                <strong><?php echo $comment['login']?></strong>
                            </div>
                            <div class="column is-half has-text-right">
                                <small class="timestamp is-italic"><?php echo $comment['comment_date']?></small>
                            </div>
                        </div>
                        <p><?php echo $comment['comment_content']?></p>
                    </div>
                </article>
            <?php } ?>

                <article class="media">
                <figure class="media-left">
                    <p>
                    <?php if (!empty($_SESSION['user']['path_profile_picture'])){?>
                    <div style='background-image: url("/<?php echo $_SESSION['user']['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 45px; width: 45px;'>
                <?php }else{ ?>
                    <div style='background-image: url("/assets/img/avatar.png"); background-size: cover; border-radius: 100%; background-position: 50% 50%; height: 45px; width: 45px;'>
                <?php } ?>
                    </div>
                    </p>
                </figure>
                <div class="media-content">
                    <div class="field">
                    <p class="control">
                        <textarea class="textarea" placeholder="Ajouter un commentaire..."></textarea>
                    </p>
                    </div>
                    <div class="field">
                    <p class="control has-text-right">
                        <button class="button">Commenter</button>
                    </p>
                    </div>
                </div>
            </article>

        </div>
    </div>
</div>
