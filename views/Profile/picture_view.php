<img class="picture" src="/<?php echo $image['picture_path']; ?>">

<?php 
$liked = 0;
foreach ($likes as $like)
    if($like['login'] == $_SESSION['user']['login'])
        $liked = 1;
?>
<div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth infos">
        <div class="columns">
            <div class="column is-half">
                <span><?php echo $image['login']; ?></span>
            </div>
            <div class="has-text-right column is-half">
                <small class="timestamp is-italic"><?php echo $image['picture_date']; ?></small>
            </div>
        </div>
        <div>
            <?php if ($liked == 1) { ?>
                <span class="has-text-danger is-size-5"><i class="fas fa-heart"></i><?php echo $image['likes_count']; ?></span>
            <?php }else{ ?>
                <span class="has-text-danger is-size-5"><i class="far fa-heart"></i><?php echo $image['likes_count']; ?></span>
            <?php } ?> 
            <span class="has-text-primary is-size-5 comment"><i class="fas fa-comment"></i><?php echo $image['comments_count']; ?></span>
        </div>
        <div>
            <span>Aimé par </span>
            <?php 
            $i = 0;
            foreach($likes as $like) {
                $i++;
                if($i < 4 && $i < $image['likes_count'])
                    echo '<span>'.$like['login'].', </span>';
                else if ($i < 4 && $i == $image['likes_count'])
                    echo '<span>'.$like['login'].'</span>';
                else if($i == 5 && $i < $image['likes_count'])
                    echo '<span>'.$like['login'].'...</span>';
            }
            ?>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth">

        <?php foreach ($comments as $comment){?>
        <article class="media">
            <figure class="media-left">
            <p>
                <?php if (!empty($comment['path_profile_picture'])){?>
                  <div style='background-image: url("/<?php echo $comment['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 64px; width: 64px;'>
              <?php }else{ ?>
                <div style='background-image: url("/assets/img/avatar.png"); background-size: cover; border-radius: 100%; background-position: 50% 50%; height: 64px; width: 64px;'>
              <?php } ?>
                </div>
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                <p>
                    <strong><?php echo $comment['login']?></strong>
                    <br>
                    <?php echo $comment['comment_content']?>
                    <br>
                    <small class="timestamp"><?php echo $comment['comment_date']?></small>
                </p>
                </div>
            </article>
        <?php } ?>

            <article class="media">
            <figure class="media-left">
                <p>
                <?php if (!empty($_SESSION['user']['path_profile_picture'])){?>
                  <div style='background-image: url("/<?php echo $_SESSION['user']['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 64px; width: 64px;'>
              <?php }else{ ?>
                <div style='background-image: url("/assets/img/avatar.png"); background-size: cover; border-radius: 100%; background-position: 50% 50%; height: 64px; width: 64px;'>
              <?php } ?>
                </div>
                </p>
            </figure>
            <div class="media-content">
                <div class="field">
                <p class="control">
                    <textarea class="textarea" placeholder="Add a comment..."></textarea>
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

<script src="/assets/js/timestamp.js"></script>
