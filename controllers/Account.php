<?php

Class Account extends Controller{

    public function index(){
        $data = array();
        $this->loadModel('Account_model');
        if(!isset($_SESSION['user']))
            header('Location: /');
        if (isset($_POST['user_token']))
        {
            if ($_POST['user_token'] == $_SESSION['token'])
            {
                if (isset($_POST['user_old_password']) && isset($_POST['user_password']) && isset($_POST['user_password_repeat']))
                {
                    if (strlen($_POST['user_password']) > 11 && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['user_password']))
                    {
                        if ($_POST['user_password'] == $_POST['user_password_repeat'])
                        {
                            $password = trim(htmlspecialchars(addslashes($_POST['user_old_password'])));
                            $newpassword = trim(htmlspecialchars(addslashes($_POST['user_password'])));
                            if ($this->Account_model->isPasswordOk($password, $_SESSION['user']['user_id']) == TRUE)
                            {
                                $pass = password_hash($newpassword, PASSWORD_DEFAULT);
                                $this->Account_model->changePassword($pass, $_SESSION['user']['user_id']);
                                $data['success'] = "Votre mot de passe a bien été modifié.";
                            }
                            else
                                $data['error'] = "Ancient mot de passe incorrect.";
                        }
                        else
                            $data['error'] = "Les mots de passent ne correspondent pas.";
                    }
                    else
                        $data['error'] = "Le nouveau mot de passe n'est pas conforme.";
                }

                if (isset($_POST['user_firstname']) && isset($_POST['user_lastname']) && isset($_POST['user_pseudo'])
                    && isset($_POST['user_mail']))
                {
                    if (!isset($_POST['user_bio']))
                        $bio = NULL;
                    else
                        $bio = trim(htmlspecialchars(addslashes($_POST['user_bio'])));
                    $firstname = ucfirst(trim(htmlspecialchars(addslashes($_POST['user_firstname']))));
                    $lastname = strtoupper(trim(htmlspecialchars(addslashes($_POST['user_lastname']))));
                    $login = strtolower(trim(htmlspecialchars(addslashes($_POST['user_pseudo']))));
                    $email = trim(htmlspecialchars(addslashes($_POST['user_mail'])));
                    $_SESSION['user']['firstname'] = $firstname;
                    $_SESSION['user']['lastname'] = $lastname;
                    $_SESSION['user']['login'] = $login;
                    $_SESSION['user']['email'] = $email;
                    $_SESSION['user']['biography'] = $bio;

                    $this->Account_model->updateProfile($firstname, $lastname, $login, $email, $bio, $_SESSION['user']['user_id']);
                    $data['success'] = "Votre profil a bien été mis à jour.";
                }

                if (isset($_POST['user_notif_active']))
                {
                    if (!isset($_POST['user_notif']))
                        $notif = 0;
                    else
                        $notif = 1;
                    $this->Account_model->updateNotif($notif, $_SESSION['user']['user_id']);
                    $_SESSION['user']['notif'] = $notif;
                    $data['success'] = "Vos préférences ont bien été mises à jour.";
                }

            }
            else
                $data['error'] = "Une erreur est survenue.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Account/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}