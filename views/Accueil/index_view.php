<?php $i = 1;?>
<div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth">
    <nav class="pagination is-rounded pagination-top" role="navigation" aria-label="pagination">
        <ul class="pagination-list">
            <?php while ($i <= $nb_pages){?>
                <li><a class="pagination-link" aria-label="Goto page 1" href="/index.php/Accueil/<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php $i++; }?>
        </ul>
    </nav>
    </div>
</div>

<?php foreach($pictures as $picture){ ?>
    <div class="columns accueil_picture">
    <div class="card column is-three-fifths is-offset-one-fifth">
        <div class="card-image">
            <div onclick="open_modal(<?php echo $picture['picture_id']?>)" style='cursor: pointer; background-image: url("/<?php echo $picture['picture_path'];?>"); background-size: cover; background-position: 50% 50%; height:40vh; width: 100%;'></div>
        </div>
        <div class="card-content">
            <div class="media">
            <div class="media-left">
                <a href="/index.php/Profile/<?php echo $picture['login'];?>">
                    <div style='cursor: pointer; background-image: url("/<?php echo $picture['path_profile_picture'];?>"); background-size: cover; border-radius: 100%; background-position: 50% 50%; height: 64px; width: 64px;'></div>
                </a>
            </div>
            <div class="media-content">
                <a href="/index.php/Profile/<?php echo $picture['login'];?>" class="title is-4"><?php echo $picture['login'];?></a>
            </div>
            </div>
            <div class="content">
                <p class="is-italic"><?php echo $picture['picture_desc'];?></p>
            </div>
            <footer class="card-footer columns">
                <div class="column is-half">
                    <span class="has-text-primary is-size-5 comment"><i class="fas fa-comment"></i><?php echo $picture['comments_count']; ?></span>
                </div>
                <div class="has-text-right column is-half">
                    <span class="has-text-danger is-size-5"><i class="far fa-heart"></i><?php echo $picture['likes_count']; ?></span>
                </div>
            </footer>
        </div>
    </div>
</div>
<?php } ?>

<div class="modal" id="modal">
  <div class="modal-background" onclick="close_modal()"></div>
  <div class="modal-content" id="picture_modal"></div>
  <button class="modal-close is-large" aria-label="close" onclick="close_modal()"></button>
</div>

<?php $i = 1;?>
<div class="columns">
    <div class="column is-three-fifths is-offset-one-fifth">
    <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
        <ul class="pagination-list">
            <?php while ($i <= $nb_pages){?>
                <li><a class="pagination-link" aria-label="Goto page 1" href="/index.php/Accueil/<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php $i++; }?>
        </ul>
    </nav>
    </div>
</div>


<script src="/assets/js/accueil.js"></script>
