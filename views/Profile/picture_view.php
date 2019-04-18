<?php 
// var_dump($image);
// var_dump($likes);
// var_dump($comments);

?>

<div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth">

        <?php foreach ($comments as $comment){?>
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                <?php if (isset($comment['path_profile_picture'])){?>
                <img src="/<?php echo $comment['path_profile_picture']?>">
                <?php } else {?>
                <img src="/assets/img/avatar.png">
                <?php } ?>
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
                <p class="image is-64x64">
                <?php if (isset($_SESSION['user']['path_profile_picture'])){?>
                <img src="/<?php echo $_SESSION['user']['path_profile_picture']?>">
                <?php } else {?>
                <img src="/assets/img/avatar.png">
                <?php } ?>
                </p>
            </figure>
            <div class="media-content">
                <div class="field">
                <p class="control">
                    <textarea class="textarea" placeholder="Add a comment..."></textarea>
                </p>
                </div>
                <div class="field">
                <p class="control">
                    <button class="button">Post comment</button>
                </p>
                </div>
            </div>
        </article>

    </div>
</div>

<script src="/assets/js/timestamp.js"></script>
