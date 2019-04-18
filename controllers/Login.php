<?php

Class Login extends Controller{

    public function index(){
        if(isset($_SESSION['user']))
            header('Location: /');
            
        $data = array();
        $this->loadModel('Login_model');

        if (isset($_POST['user_login']) && isset($_POST['user_password']) && isset($_POST['user_token']))
        {
            if($_POST['user_token'] == $_SESSION['token'])
            {
                $login = trim(strtolower(htmlspecialchars(addslashes($_POST['user_login']))));
                $password = htmlspecialchars(addslashes($_POST['user_password']));
                $user = $this->Login_model->get_user($login);
                if (!empty($user))
                {
                    if (password_verify($password, $user['password']))
                    {
                        if ($user['enabled'] == 1)
                        {
                            $_SESSION['user'] = $user;
                            if ($user['admin'] == 1)
                                $_SESSION['admin'] = 1;
                            else
                                $_SESSION['admin'] = 0;
                            header('Location: /');
                        }
                        else if($user['enabled'] == -1)
                            $data['error'] = "Votre compte a été désactivé par un administrateur.";
                        else
                            $data['error'] = "Votre compte n'est pas encore activé. Veuillez l'activer depuis le lien envoyé sur votre adresse email.";
                    }
                    else
                        $data['error'] = "Mot de passe incorrect. Veuillez ré-essayer.";
                }
                else
                    $data['error'] = "Identifiants inconnus.";
            }
            else
                $data['error'] = "Une erreur est survenue.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Login/index_view', $data);
        $this->loadView('Base/footer_view');
    }

    public function forgotpassword()
    {
        if(isset($_SESSION['user']))
            header('Location: /');
        
        $this->loadModel('Register_model');
        $data = array();

        if(isset($_POST['user_email']) && isset($_POST['user_token']))
        {
            if($_POST['user_token'] == $_SESSION['token'])
            {
                $email = trim(strtolower(htmlspecialchars(addslashes($_POST['user_email']))));
                if ($this->Register_model->email_already_used($email) == TRUE)
                {
                    $token = bin2hex(openssl_random_pseudo_bytes(15));
                    $link = 'http://'.$_SERVER["HTTP_HOST"].'/index.php/Login/resetpassword/'.$token;
                    $this->Register_model->create_token($email, $token);
                    $message = "Bienvenue sur Camagru\r\nPour récupérer votre mot de passe, veuillez cliquer sur le lien suivant\r\n".$link;
                    mail($email, 'Camagru - Password recovery', $message);
                    header('Location: /index.php/Login');
                }
                else
                    $data['error'] = "Cet email n'existe pas.";
            }
            else
                $data['error'] = "Une erreur est survenue.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Login/forgot_password_view', $data);
        $this->loadView('Base/footer_view');
    }

    public function resetpassword($token = null)
    {
        if(isset($_SESSION['user']))
            header('Location: /');
        
        $this->loadModel('Register_model');
        $this->loadModel('Login_model');
        $token = trim(htmlspecialchars(addslashes($token)));
        $data['token'] = $token;
        if ($this->Register_model->token_exists($token))
        {
            if (!($this->Register_model->expirated_token($token)))
            {
                $data['success'] = "Veuillez entrer votre nouveau mot de passe";
                if (isset($_POST['user_password'])&& isset($_POST['user_password_confirm']) && isset($_POST['user_token']))
                {
                    if($_POST['user_token'] == $_SESSION['token'])
                    {
                        if ($_POST['user_password'] == $_POST['user_password_confirm'])
                        {
                            if (strlen($_POST['user_password']) > 11 && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['user_password'])) 
                            {
                                $password = password_hash(htmlspecialchars(addslashes($_POST['user_password'])), PASSWORD_DEFAULT);
                                $this->Login_model->resetPassword($password, $token);
                                header('Location: /index.php/Login');
                            }
                            else
                                $data['error_password'] = "Le mot de passe n'est pas conforme.";
                        }
                        else
                            $data['error_password'] = "Les mots de passe ne correspondent pas.";
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
        $this->loadView('Login/reset_password_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>