<div class="columns">
    <div class="column is-one-quarter">
        <figure class="image is-128x128 img_user">
        <?php if (!empty($_SESSION['user']['path_profile_picture'])){?>
            <img class="is-rounded" src="/<?php echo $_SESSION['user']['path_profile_picture']?>">
        <?php }else{ ?>
            <img class="is-rounded" src="/assets/img/avatar.png">
        <?php } ?>
        </figure>
    </div>
    <div class="column is-half">
        <h1 class="user_login is-size-1"><?php echo $_SESSION['user']['login']?><a href="/index.php/Account" class="has-text-dark is-size-4 settings_user"><i class="fas fa-cog"></i></a></h1>
        <p><?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'] ?></p>
        <p><?php echo $_SESSION['user']['email']?></p>
        <?php if (!empty($_SESSION['user']['biography'])){?>
            <p class="is-italic"><?php echo $_SESSION['user']['biography']?></p>
        <?php } ?>
    </div>
</div>
<div class="tabs is-centered">
  <ul>
    <li class="is-active">
      <a>
        <span class="icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span>
        <span>Pictures</span>
      </a>
    </li>
    <li>
      <a>
        <span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span>
        <span>Music</span>
      </a>
    </li>
    <li>
      <a>
        <span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span>
        <span>Videos</span>
      </a>
    </li>
    <li>
      <a>
        <span class="icon is-small"><i class="far fa-file-alt" aria-hidden="true"></i></span>
        <span>Documents</span>
      </a>
    </li>
  </ul>
</div>