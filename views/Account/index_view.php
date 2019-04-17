<div class="gestion_user">
    <div class="columns">
        <div class="column is-three-fifths is-offset-one-fifth">
            <?php if (!empty($error)){ ?>
                <p class="has-text-danger"><?php echo $error; ?></p>
            <?php } ?>
            <?php if (!empty($success)){ ?>
                <p class="has-text-info"><?php echo $success; ?></p>
            <?php } ?>
        </div>
    </div>
    
    <div class="columns">
        <div class="column is-one-fifth is-offset-one-fifth menu_user">
            <aside class="menu">
                <p class="menu-label">
                    Gestion du compte
                </p>
                <ul class="menu-list">
                    <li><a onclick="display_profile()" id="display_profile">Modifier mon profil</a></li>
                    <li><a onclick="display_picture()" id="display_picture">Modifier ma photo de profil</a></li>
                    <li><a onclick="display_password()" id="display_password">Changer mon mot de passe</a></li>
                    <li><a onclick="display_notif()" id="display_notif">Mes notfications</a></li>
                </ul>
            </aside>
        </div>
        <div class="column is-two-fifths forms_user">  
            <div class="container-changepicture" id="picture">
                <figure class="image is-128x128 img_user">
                    <?php if (!empty($_SESSION['user']['path_profile_picture'])){?>
                        <div style='background-image: url("/<?php echo $_SESSION['user']['path_profile_picture']?>"); background-size: cover; border-radius: 100%; height: 128px; width: 128px;'>
                    <?php }else{ ?>
                    <div style='background-image: url("/assets/img/avatar.png"); background-size: cover; border-radius: 100%; height: 128px; width: 128px;'>
                    <?php } ?>
                    </div>
                </figure>
                <form action="/index.php/Account" method="post" enctype="multipart/form-data" class="form_upload">
                    <div class="file has-name">
                        <label class="file-label">
                        <input class="file-input" id="file_upload" onchange="name_input()" type="file" name="newimg" id="newimg" accept="image/*">
                            <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Séléctionner un fichier
                            </span>
                            </span>
                            <span class="file-name" id="file_output">
                                Aucun fichier sélectionné
                            </span>
                        </label>
                    </div>
                    <div class="field">
                        <button class="button is-small is-fullwidth is-primary" type="submit">Changer ma photo</button>
                    </div>
                </form>
            </div>
            <div class="container-changeprofile" id="profile">
                <form class="column" action="/index.php/Account" method="post">

                    <div class="field">
                        <label class="label">Prénom</label>
                        <p class="control has-icons-left">
                            <input class="input" type="text" name="user_firstname" placeholder="Prénom" required value="<?php echo $_SESSION['user']['firstname']; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Nom</label>
                        <p class="control has-icons-left">
                            <input class="input" type="text" name="user_lastname" placeholder="Nom" required value="<?php echo $_SESSION['user']['lastname']; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Pseudo</label>
                        <p class="control has-icons-left">
                            <input class="input" type="text" name="user_pseudo" placeholder="Pseudo" required value="<?php echo $_SESSION['user']['login']; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Adresse email</label>
                        <p class="control has-icons-left">
                            <input class="input" type="mail" name="user_mail" placeholder="Adresse email" required value="<?php echo $_SESSION['user']['email']; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Biographie</label>
                        <p class="control has-icons-left">
                            <textarea class="input" type="text" name="user_bio" placeholder="Biographie"><?php if (!empty($_SESSION['user']['biography'])) echo $_SESSION['user']['biography'];?></textarea>
                            <span class="icon is-small is-left">
                                <i class="fas fa-pen-nib"></i>
                            </span>
                        </p>
                    </div>
                    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">
                    <div class="field">
                        <button class="button is-medium is-fullwidth is-primary" type="submit">Mettre à jour mon profil</button>
                    </div>
                </form>
            </div>


            <div class="container-changepassword" id="password">
                <form class="column" action="/index.php/Account" method="post">
                    <div class="field">
                        <label class="label">Votre mot de passe actuel</label>
                        <p class="control has-icons-left">
                            <input class="input" type="password" name="user_old_password" placeholder="Votre mot de passe actuel" required value="<?php if(isset($_POST['user_login'])){echo $_POST['user_login'];}?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Votre nouveau mot de passe <i class="fas fa-info-circle" id="info"></i></label>
                        <p class="control has-icons-left">
                            <input class="input" type="password" name="user_password" placeholder="Votre mot de passe" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Répétez votre nouveau mot de passe</label>
                        <p class="control has-icons-left">
                            <input class="input" type="password" name="user_password_repeat" placeholder="Votre mot de passe" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">
                    <div class="field">
                        <button class="button is-medium is-fullwidth is-primary" type="submit">Modifier mon mot de passe</button>
                    </div>
                </form>
            </div>

            <div class="container-changenotif" id="notif">
                <form class="column" action="/index.php/Account" method="post">
                    <div class="field">
                        <label class="label">Recevoir des notifications?</label>
                        <label class="switch">
                            <?php if($_SESSION['user']['notif'] == 0) {?>
                            <input type="checkbox" name="user_notif">
                            <?php } else {?>
                            <input type="checkbox" name="user_notif" checked>
                            <?php } ?>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">
                    <input class="input" name="user_notif_active" type="hidden" value="<?php echo $_SESSION['token'];?>">
                    <div class="field">
                        <button class="button is-medium is-fullwidth is-primary" type="submit">Mettre à jour mes paramètres</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal" id='modal'>
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Règles de mot de passe</p>
      <button class="delete" id="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <p>Votre mot de passe contient au moins : </p>
      <ul class="modal_list">
        <li>12 caractères</li>
        <li>une majuscule</li>
        <li>une minuscule</li>
        <li>un chiffre</li>
        <li>un caractère spécial</li>
      </ul>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" id="gotit">Compris !</button>
    </footer>
  </div>
</div>

<script src="/assets/js/modal.js"></script>
<script src="/assets/js/account.js"></script>