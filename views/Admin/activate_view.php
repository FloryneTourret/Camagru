<?php if (isset($error)){?>
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        <article class="message is-danger">
        <div class="message-header">
            <p>Activation du compte</p>
        </div>
        <div class="message-body"> 
            <p><?php echo $error; ?></p>
            <div class="has-text-right">
                <a href="/index.php/Register/sendmail" class="has-text-grey-dark">Renvoyez moi un mail !</a>
            </div>
        </div>
        </article>
    </div>
</div>
<?php } else if (isset($success)) {?>
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        <article class="message is-primary">
        <div class="message-header">
            <p>Activation du compte</p>
        </div>
        <div class="message-body"> 
            <?php if (isset($success_final)){?>
                <p><?php echo $success_final; ?></p>
                <div class="has-text-right">
                    <a href="/index.php/Login" class="has-text-grey-dark">Me connecter</a>
                </div>
            <?php }else{ ?>
                <div class="columns">
                    <form class="column is-half is-offset-one-quarter" action="/index.php/Admin/activate/<?php echo $token;?>" method="post">
                    <p><?php echo $success; ?></p>
                        <div class="field">
                            <label class="label">Mot de passe <i class="fas fa-info-circle" id="info"></i></label>
                            <div class="control">
                            <p class="control has-icons-left">
                                <input class="input" type="password" name="user_password" placeholder="Votre mot de passe" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Confirmez votre mot de passe</label>
                            <div class="control">
                            <p class="control has-icons-left">
                                <input class="input" type="password" name="user_password_confirm" placeholder="Confirmez votre mot de passe" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                            </div>
                        </div>

                        <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

                        <div class="field">
                            <button class="button is-medium is-fullwidth is-primary" type="submit">Valider mon compte</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
        </article>
    </div>
</div>
<?php } ?>
