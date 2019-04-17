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
                    <li><a onclick="display_filters()" id="display_filters">Gérer les filtres</a></li>
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
            <div class="container-filters" id="filters">
                Gestion filtres
            </div>

        </div>
    </div>
</div>


<script src="/assets/js/admin.js"></script>