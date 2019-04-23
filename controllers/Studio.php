<?php

Class Studio extends Controller{

    public function index(){
        $this->loadModel('Studio_model');
        $data = array();
        if (!empty($_FILES))
        {
            if ($_FILES['newimg']['type'] == 'image/jpeg' || $_FILES['newimg']['type'] == 'image/png'
                    || $_FILES['newimg']['type'] == 'image/jpg')
            {
                $check = getimagesize($_FILES['newimg']['tmp_name']);
                if ($check !== false)
                    $upload = 1;
                else
                    $upload = 0;
                if ($upload == 1)
                {
                    $userdir = '/var/www/html/assets/upload/';
                    if (!file_exists($userdir . $_SESSION['user']['login'])) {
                        mkdir($userdir . $_SESSION['user']['login'], 0777, true);
                    }
                    $target_dir = '/var/www/html/assets/upload/'.$_SESSION['user']['login'].'/';
                    $name = bin2hex(openssl_random_pseudo_bytes(8));
                    while (file_exists('/var/www/html/assets/upload'.$_SESSION['user']['login'].'/'.$name))
                        $name = bin2hex(openssl_random_pseudo_bytes(8));
                    if ($_FILES['newimg']['type'] == 'image/png')
                        $name = $name.'.png';
                    else if ($_FILES['newimg']['type'] == 'image/jpeg')
                        $name = $name.'.jpg';
                    $target_file = $target_dir . $name;
                    move_uploaded_file($_FILES['newimg']['tmp_name'], $target_file);
                    $target = 'assets/upload/'.$_SESSION['user']['login'].'/'.$name;
                    $this->Studio_model->addimg($target, $_SESSION['user']['user_id']);
                }
                else
                    $data['error'] = 'Le fichier renseigné n\'est pas une image';
            }
        }
        if (!empty($_POST['snap-img']))
        {
            $target_dir = '/var/www/html/assets/upload/'.$_SESSION['user']['login'].'/';
            $name = bin2hex(openssl_random_pseudo_bytes(8));
            while (file_exists('/var/www/html/assets/upload'.$_SESSION['user']['login'].'/'.$name))
                $name = bin2hex(openssl_random_pseudo_bytes(8));
            $ext = 'png';
            file_put_contents($target_dir.'/'.$name.'.'.$ext, file_get_contents($_POST['snap-img']));
            $target = 'assets/upload/'.$_SESSION['user']['login'].'/'.$name.'.'.$ext;
            $this->Studio_model->addimg($target, $_SESSION['user']['user_id']);
        }
        
        $this->loadModel('Studio_model');
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Studio/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>