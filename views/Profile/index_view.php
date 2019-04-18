<div class="columns info_profile">
    <div class="column is-one-quarter">
        <figure class="image is-128x128 img_user">
        <?php if (!empty($user['path_profile_picture'])){?>
            <div class="picture_profile" style='background-image: url("/<?php echo $user['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 128px; width: 128px;'>
        <?php }else{ ?>
          <div class="picture_profile" style='background-image: url("/assets/img/avatar.png"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 128px; width: 128px;'>
        <?php } ?>
        </div>
        </figure>
    </div>
    <div class="column is-half">
        <h1 class="user_login is-size-1"><?php echo $user['login']?><?php if ($user['login'] == $_SESSION['user']['login']) echo '<a href="/index.php/Account" class="has-text-dark is-size-4 settings_user"><i class="fas fa-cog"></i></a>';?></h1>
        <p><?php echo $user['firstname'].' '.$user['lastname'] ?></p>
        <p><?php echo $user['email']?></p>
        <?php if (!empty($user['biography'])){?>
            <p class="is-italic"><?php echo $user['biography']?></p>
        <?php } ?>
    </div>
</div>
<div class="tabs is-centered">
  <ul>
    <li class="is-active" id="display_pictures">
      <a onclick="display_pictures()">
        <span class="icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span>
        <span>Pictures</span>
      </a>
    </li>
    <li id="display_likes">
      <a onclick="display_likes()">
        <span class="icon is-small"><i class="fas fa-heart" aria-hidden="true"></i></span>
        <span>Likes</span>
      </a>
    </li>
  </ul>
</div>

<div id="pictures">
  <div class="row"> 
    <div class="col" id="col1">
    </div>

    <div class="col" id="col2">
    </div> 

    <div class="col" id="col3">
    </div>

    <div class="col" id="col4">
    </div>
  </div>
</div>

<div id="likes">

</div>


<script src="/assets/js/profile.js"></script>
<script>
var pictures = <?php echo json_encode($pictures);?>;
col1 = document.getElementById('col1');
col2 = document.getElementById('col2');
col3 = document.getElementById('col3');
col4 = document.getElementById('col4');

i = 0;
pictures.forEach(function(element) {
  i++;
  if(i == 1)
    col1.innerHTML += '<img src="/'+element['picture_path']+'">'
  else if(i == 2)
    col2.innerHTML += '<img src="/'+element['picture_path']+'">'
  else if(i == 3)
    col3.innerHTML += '<img src="/'+element['picture_path']+'">'
  else if(i == 4)
    col4.innerHTML += '<img src="/'+element['picture_path']+'">'
  if (i == 4)
    i = 0;
});

</script>