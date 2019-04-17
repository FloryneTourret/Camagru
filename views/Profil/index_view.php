<div class="columns info_profile">
    <div class="column is-one-quarter">
        <figure class="image is-128x128 img_user">
        <?php if (!empty($_SESSION['user']['path_profile_picture'])){?>
            <div class="picture_profile" style='background-image: url("/<?php echo $_SESSION['user']['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 128px; width: 128px;'>
        <?php }else{ ?>
          <div class="picture_profile" style='background-image: url("/assets/img/avatar.png"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 128px; width: 128px;'>
        <?php } ?>
        </div>
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