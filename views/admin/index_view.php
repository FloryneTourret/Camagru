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
                    Panel admin
                </p>
                <ul class="menu-list">
                    <li><a onclick="display_users()" id="display_users">Gérer les utilisateurs</a></li>
                    <li><a onclick="display_admin()" id="display_admin">Ajouter un administrateur</a></li>
                    <li><a onclick="display_filters()" id="display_filters">Ajouter un filtre</a></li>
                    <li><a onclick="display_manage_filters()" id="display_manage_filters">Gérer les filtres</a></li>
                </ul>
            </aside>
        </div>
        <div class="column is-three-fifths forms_user">  
            <div class="container-users" id="users">
                <table class="table is-fullwidth">
                    <td class="has-text-primary">Admin</td>
                    <td class="has-text-danger">Banni</td>
                    <td class="has-text-warning">Non activé</td>
                    <td class="has-text-grey-dark">Utilisateur</td>
                </table>
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <th>Prénom Nom</th>
                        <th>Login</th>
                        <th>Email</th>
                        <th></th>
                    </thead>
                    <tbody>
                    <?php
                        foreach($users as $user){
                            if($user['admin'] == 1)
                                echo '<tr id="tr_'.$user['user_id'].'">
                                <td id="name_'.$user['user_id'].'" class="has-text-primary">'.$user['firstname'].' '.$user['lastname'].'</td>
                                <td>'.$user['login'].'</td>
                                <td class="email">'.$user['email'].'</td>
                                <td id="button_'.$user['user_id'].'"></td>
                                </tr>';
                            else if($user['enabled'] == -1)
                                echo '<tr id="tr_'.$user['user_id'].'">
                                <td id="name_'.$user['user_id'].'" class="has-text-danger">'.$user['firstname'].' '.$user['lastname'].'</td>
                                <td>'.$user['login'].'</td>
                                <td class="email">'.$user['email'].'</td>
                                <td id="button_'.$user['user_id'].'"><button class="button is-small is-warning" onclick="unban(\''.$user['user_id'].'\' , \''.$user['enabled'].'\' , \''.$user['admin'].'\')">Autoriser l\'utilisateur</button></td>
                                </tr>';
                            else if($user['enabled'] == 0)
                                echo '<tr id="tr_'.$user['user_id'].'">
                                <td id="name_'.$user['user_id'].'" class="has-text-warning">'.$user['firstname'].' '.$user['lastname'].'</td>
                                <td>'.$user['login'].'</td>
                                <td class="email">'.$user['email'].'</td>
                                <td id="button_'.$user['user_id'].'"><button class="button is-small is-danger" onclick="ban(\''.$user['user_id'].'\' , \''.$user['enabled'].'\' , \''.$user['admin'].'\')">Bannir l\'utilisateur</button></td>
                                </tr>';
                            else
                                echo '<tr id="tr_'.$user['user_id'].'">
                                <td id="name_'.$user['user_id'].'" class="has-text-grey-dark">'.$user['firstname'].' '.$user['lastname'].'</td>
                                <td>'.$user['login'].'</td>
                                <td class="email">'.$user['email'].'</td>
                                <td id="button_'.$user['user_id'].'"><button class="button is-small is-danger" onclick="ban(\''.$user['user_id'].'\' , \''.$user['enabled'].'\' , \''.$user['admin'].'\')">Bannir l\'utilisateur</button></td>
                                </tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="container-admin" id="admin">
                <div class="columns">
                    <form class="column is-three-quarters" action="/index.php/Admin" method="post">

                        <div class="field">
                            <label class="label">Prénom</label>
                            <div class="control">
                            <p class="control has-icons-left">
                                <input class="input" type="text" name="user_firstname" placeholder="Prénom" required value="<?php if(isset($_POST['user_firstname'])){echo $_POST['user_firstname'];}?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Nom</label>
                            <div class="control">
                            <p class="control has-icons-left">
                                <input class="input" type="text" name="user_lastname" placeholder="Nom" required value="<?php if(isset($_POST['user_lastname'])){echo $_POST['user_lastname'];}?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Pseudo</label>
                            <div class="control">
                            <p class="control has-icons-left">
                                <input class="input" type="text" name="user_login" placeholder="Pseudo" required value="<?php if(isset($_POST['user_login'])){echo $_POST['user_login'];}?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                            <p class="control has-icons-left">
                                <input class="input" type="email" name="user_email" placeholder="Adresse email" required value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];}?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </p>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Confirmez votre email</label>
                            <div class="control">
                            <p class="control has-icons-left">
                                <input class="input" type="email" name="user_email_confirm" placeholder="Confirmation adresse email" required value="<?php if(isset($_POST['user_email_confirm'])){echo $_POST['user_email_confirm'];}?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </p>
                            </div>
                        </div>

                        <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

                        <div class="field">
                            <button class="button is-medium is-fullwidth is-primary" type="submit">Inscrire</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-admin" id="filters">
                <form action="/index.php/Admin" method="post" class="column is-three-quarters" enctype="multipart/form-data" class="form_upload">
                    <div class="field">
                        <label class="label">Nom du filtre</label>
                        <div class="control">
                        <p class="control has-icons-left">
                            <input class="input" type="text" name="filter_title" placeholder="Nom du filtre" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                        </div>
                    </div>

                    <div class="file has-name">
                        <label class="file-label">
                        <input class="file-input" id="filter_upload" onchange="name_input();" type="file" name="newfilter" accept="image/*">
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
                        <button class="button is-small is-fullwidth is-primary" type="submit">Charger la photo</button>
                    </div>
                </form>
            </div>

            <div id="manage_filters">
            </div>

        </div>
    </div>
</div>


<script src="/assets/js/admin.js"></script>