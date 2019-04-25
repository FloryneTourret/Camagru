<?php

Class Register extends Controller{

    public function index()
    {
        if(isset($_SESSION['user']))
            header('Location: /');

        $data = array();
        $this->loadModel('Register_model');

        if (isset($_POST['user_firstname']) && isset($_POST['user_lastname']) && isset($_POST['user_email'])
            && isset($_POST['user_email_confirm']) && isset($_POST['user_login']) && isset($_POST['user_password'])
            && isset($_POST['user_password_confirm']) && isset($_POST['user_token']))
        {
            if($_POST['user_token'] == $_SESSION['token'])
            {
                if ($_POST['user_email'] == $_POST['user_email_confirm'])
                {
                    if ($_POST['user_password'] == $_POST['user_password_confirm'])
                    {
                        $firstname = trim(ucfirst(htmlspecialchars(addslashes($_POST['user_firstname']))));
                        $lastname = trim(strtoupper(htmlspecialchars(addslashes($_POST['user_lastname']))));
                        $login = trim(strtolower(htmlspecialchars(addslashes($_POST['user_login']))));
                        $email = trim(strtolower(htmlspecialchars(addslashes($_POST['user_email']))));
                        if (strlen($_POST['user_password']) > 11 && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['user_password'])) 
                        {
                            $password = password_hash(htmlspecialchars(addslashes($_POST['user_password'])), PASSWORD_DEFAULT);
                            if ($this->Register_model->email_already_used($email) == FALSE)
                            {
                                if ($this->Register_model->login_already_used($login) == FALSE)
                                {
                                    $secret = "6LeUtpwUAAAAAFSgwDpQWdxHeZ-HgWnpBb0Gm78T";
                                    $response = $_POST['g-recaptcha-response'];
                                    $remoteip = $_SERVER['REMOTE_ADDR'];
                                    $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
                                    . $secret
                                    . "&response=" . $response
                                    . "&remoteip=" . $remoteip ;
                                    $decode = json_decode(file_get_contents($api_url), true);
                                    if ($decode['success'] == true) {
                                        $token = bin2hex(openssl_random_pseudo_bytes(15));
                                        $link = $_SERVER["HTTP_REFERER"].'/activate/'.$token;
                                        $this->Register_model->register($firstname, $lastname, $login, $email, $password, $token);
                                        $message = "Bienvenue sur Camagru\r\nPour activer votre compte, veuillez cliquer sur le lien suivant\r\n".$link;
                                        mail($email, 'Camagru - Account verification', $message);
                                        header('Location: /index.php/login');
                                    }
                                    else {
                                        $data['error'] = "Désolé, le captcha est invalide";
                                    } 
                                }
                                else
                                    $data['error'] = "Désolé, ce login est déjà utilisé.";
                            }
                            else
                                $data['error'] = "Désolé, cet email est déjà utilisé.";
                        }
                        else
                            $data['error'] = "Le mot de passe n'est pas conforme.";
                    }
                    else
                        $data['error'] = "Les mots de passe ne correspondent pas.";
                }
                else
                    $data['error'] = "Les emails ne correspondent pas.";
            }
            else
                $data['error'] = "Une erreur est survenue.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Register/index_view', $data);
        $this->loadView('Base/footer_view');
    }

    public function activate($token = null)
    {
        if(isset($_SESSION['user']))
            header('Location: /');
        
        $this->loadModel('Register_model');
        $data = array();
        $token = trim(htmlspecialchars(addslashes($token)));
        if ($this->Register_model->token_exists($token))
        {
            if (!($this->Register_model->expirated_token($token)))
            {
                $data['success'] = "Votre compte est validé. Vous pouvez maintenant vous connecter.";   
                $this->Register_model->activate($token);
            }
            else
                $data['error'] = "Le token de validation est expiré.";
        }
        else
            $data['error'] = "Le token est invalide.";
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Register/activate_view', $data);
        $this->loadView('Base/footer_view');
    }

    public function sendmail()
    {
        if(isset($_SESSION['user']))
            header('Location: /');
        
        $this->loadModel('Register_model');
        $data = array();

        if(isset($_POST['user_email']) && isset($_POST['token']))
        {
            if($_POST['user_token'] == $_SESSION['token'])
            {
                $email = trim(strtolower(htmlspecialchars(addslashes($_POST['user_email']))));
                if ($this->Register_model->email_already_used($email) == TRUE && $this->Register_model->account_activated($email) == FALSE)
                {
                    $token = bin2hex(openssl_random_pseudo_bytes(15));
                    $link = 'http://'.$_SERVER["HTTP_HOST"].'/index.php/Register/activate/'.$token;
                    $this->Register_model->create_token($email, $token);
                    $message = "Bienvenue sur Camagru\r\nPour activer votre compte, veuillez cliquer sur le lien suivant\r\n".$link;
                    mail($email, 'Camagru - Account verification', $message);
                    header('Location: /index.php/Login');
                }
                else
                    $data['error'] = "Cet email n'existe pas ou le compte est déjà activé.";
            }
            else
                $data['error'] = "Une erreur est survenue.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Register/sendmail_view', $data);
        $this->loadView('Base/footer_view');
        
    }
}

?>