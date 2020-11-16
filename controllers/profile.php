<?php

$users = new users();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $users->id = htmlspecialchars($_GET['idDelete']);
    $isDelete = $users->deleteUser();
    session_destroy();
    header('Location:index.php');
    exit();
}

$isUser = FALSE;
if (!empty($_GET['id'])) {
    $users->id = htmlspecialchars($_GET['id']);
    $isUser = $users->profileUpdate();
}

//Déclaration des regex :
$nameRegex = '/[a-zéèàêâùûüëïA-Z0-9\.\!?;+\-]$/';

//Création d'un tableau où l'on vient stocker les erreurs :
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;

//Si le submit existe
if (isset($_POST['submit'])) {
    //si $_POST['nickname'] existe
    if (isset($_POST['nickname'])) {
        //si $_POST['nickname'] n'est pas vide
        if (!empty($_POST['nickname'])) {
            //on vérifie si $_POST['nickname'] respecte la regex
            if (preg_match($nameRegex, $_POST['nickname'])) {
                $nickname = htmlspecialchars($_POST['nickname']);
                //sinon on stock un message dans le tableau formError    
            } else {
                $formError['nickname'] = 'Saisie invalide.';
            }
        } else {
            $formError['nickname'] = 'Erreur, veuillez remplir le champ.';
        }
    }

    if (isset($_POST['mail'])) {
        if (!empty($_POST['mail'])) {
            //emploi de la fonction PHP filter_var pour valider l'adresse mail
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $mail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['mail'] = 'Saisie invalide.';
            }
        } else {
            $formError['mail'] = 'Erreur, veuillez remplir le champ.';
        }
    }
    if (isset($_POST['password'])) {
        if (!empty($_POST['password'])) {
            if (preg_match($nameRegex, $_POST['password'])) {
                $users->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            } else {
                $formError['password'] = 'Saisie invalide.';
            }
        } else {
            $formError['password'] = 'Erreur, veuillez remplir le champ.';
        }
    }

    //on vérifie qu'il n'y a aucune erreur
    if (count($formError) == 0) {
        $users->id = $_SESSION['id'];
        $users->nickname = $nickname;
        $users->mail = $mail;

        if ($users->profileUpdate()) {
            $_SESSION['nickname'] = $nickname;
            $_SESSION['mail'] = $mail;

            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}