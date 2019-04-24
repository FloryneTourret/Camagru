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
        $data['filters'] = $this->Admin_model->get_filters();

        if(isset($_GET['ban']) && is_numeric($_GET['ban']))
        {
            $this->Admin_model->ban_users($_GET['ban']);
        }
        if(isset($_GET['del_filter']) && is_numeric($_GET['del_filter']))
        {
            $this->Admin_model->del_filter($_GET['del_filter']);
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

        if (!empty($_FILES) && !empty($_POST['filter_title']))
        {
            $title = htmlspecialchars(addslashes($_POST['filter_title']));
            if ($_FILES['newfilter']['type'] == 'image/jpeg' || $_FILES['newfilter']['type'] == 'image/png'
                    || $_FILES['newfilter']['type'] == 'image/jpg')
            {

                $check = getimagesize($_FILES['newfilter']['tmp_name']);
                if ($check !== false)
                    $upload = 1;
                else
                    $upload = 0;
                if ($upload == 1)
                {
                    $dir = '/var/www/html/assets/upload/';
                    if (!file_exists($dir . 'filter')) {
                        mkdir($dir . 'filter', 0777, true);
                    }
                    $target_dir = '/var/www/html/assets/upload/filter/';
                    $name = bin2hex(openssl_random_pseudo_bytes(8));
                    while (file_exists('/var/www/html/assets/upload/filter'.'/'.$name))
                        $name = bin2hex(openssl_random_pseudo_bytes(8));
                    if ($_FILES['newfilter']['type'] == 'image/png')
                        $name = $name.'.png';
                    else if ($_FILES['newfilter']['type'] == 'image/jpeg')
                        $name = $name.'.jpg';
                    $target_file = $target_dir . $name;
                    move_uploaded_file($_FILES['newfilter']['tmp_name'], $target_file);
                    $target = 'assets/upload/filter/'.$name;
                    $this->Admin_model->addfilter($target, $title);
                    $data['success'] = "Le filtre a bien été ajouté.";
                    header('Location: /index.php/Admin');
                }
                else
                    $data['error'] = 'Le fichier renseigné n\'est pas une image';
            }
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