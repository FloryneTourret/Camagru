<?php

Class Admin extends Controller{

    public function index(){
        if(!isset($_SESSION['user']))
            header('Location: /');
        if($_SESSION['user']['admin'] != 1)
            header('Location: /');

        $data = array();
        $this->loadModel('Admin_model');
        $this->loadModel('Register_model');
        $data['users'] = $this->Admin_model->get_users();

        if(isset($_GET['ban']) && is_numeric($_GET['ban']))
        {
            $this->Admin_model->ban_users($_GET['ban']);
        }
        if(isset($_GET['unban']) && is_numeric($_GET['unban']))
        {
            $this->Admin_model->unban_users($_GET['unban']);
            
        }

        if (isset($_POST['user_firstname']) && isset($_POST['user_lastname']) && isset($_POST['user_email'])
            && isset($_POST['user_email_confirm']) && isset($_POST['user_login']) && isset($_POST['user_token']))
        {
            if($_POST['user_token'] == $_SESSION['token'])
            {
                if ($_POST['user_email'] == $_POST['user_email_confirm'])
                {
                    $firstname = trim(ucfirst(htmlspecialchars(addslashes($_POST['user_firstname']))));
                    $lastname = trim(strtoupper(htmlspecialchars(addslashes($_POST['user_lastname']))));
                    $login = trim(strtolower(htmlspecialchars(addslashes($_POST['user_login']))));
                    $email = trim(strtolower(htmlspecialchars(addslashes($_POST['user_email']))));

                    if ($this->Register_model->email_already_used($email) == FALSE)
                    {
                        if ($this->Register_model->login_already_used($login) == FALSE)
                        {
                            $token = bin2hex(openssl_random_pseudo_bytes(15));
                            $link = $_SERVER["HTTP_REFERER"].'/activate/'.$token;
                            $this->Admin_model->register($firstname, $lastname, $login, $email, $token);
                            $message = "Bienvenue sur Camagru\r\nPour activer votre compte administrateur, veuillez cliquer sur le lien suivant\r\n".$link;
                            mail($email, 'Camagru - Admin - Account verification', $message);
                            header('Location: /index.php/Admin');
                        }
                        else
                            $data['error'] = "Désolé, ce login est déjà utilisé.";
                    }
                    else
                        $data['error'] = "Désolé, cet email est déjà utilisé.";    
                }
                else
                    $data['error'] = "Les emails ne correspondent pas.";
            }
            else
                $data['error'] = "Une erreur est survenue.";
        }

        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Admin/index_view', $data);
        $this->loadView('Base/footer_view');
    }

    public function activate($token = null)
    {
        if(!isset($_POST))
        {
            $_SESSION = array();
            session_destroy();
            session_start();
            if (!isset($_SESSION['token'])) {
                $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(6));
            }
        }
        if(isset($_SESSION['user']))
            header('Location: /');
        
        $this->loadModel('Admin_model');
        $this->loadModel('Register_model');
        $data = array();
        $data['token'] = $token;
        $token = trim(htmlspecialchars(addslashes($token)));
        if ($this->Register_model->token_exists($token))
        {
            if (!($this->Register_model->expirated_token($token)))
            {
                $data['success'] = "Afin d'activer votre compte, merci de choisir un mot de passe.";
                if (isset($_POST['user_password'])&& isset($_POST['user_password_confirm']) && isset($_POST['user_token']))
                {
                    if($_POST['user_token'] == $_SESSION['token'])
                    {
                        if ($_POST['user_password'] == $_POST['user_password_confirm'])
                        {
                            if (strlen($_POST['user_password']) > 11 && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['user_password'])) 
                            {
                                $password = password_hash(htmlspecialchars(addslashes($_POST['user_password'])), PASSWORD_DEFAULT);
                                $this->Admin_model->activate($token, $password);
                                $data['success_final'] = "Votre compte est validé. Vous pouvez maintenant vous connecter."; 
                            }
                            else
                                $data['error'] = "Le mot de passe n'est pas conforme.";
                        }
                        else
                            $data['error'] = "Les mots de passe ne correspondent pas.";
                    }
                    else
                        $data['error'] = "Une erreur est survenue.";
                }
            }
            else
                $data['error'] = "Le token de validation est expiré.";
        }
        else
            $data['error'] = "Le token est invalide.";
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Admin/activate_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>