<?php

$user = new users();
//J'initialise mon tableau d'erreur.
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
//On initialise les variables de stockage des informations pour éviter d'avoir des erreurs dans la vue.
$nickname = '';
$mail = '';

//Déclaration des regex :
$nameRegex = '/[a-zéèàêâùûüëïA-Z0-9\.\!?;+\-]$/';

//Quand on s'enregistre
if (isset($_POST['register'])) {
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
    //On vérifie que l'adresse mail est renseigné, qu'il correspond à la confirmation et qu'il a la bonne forme.
    if (!empty($_POST['mail']) && !empty($_POST['mailVerify'])) {
        if ($_POST['mail'] == $_POST['mailVerify']) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $mail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['mail'] = 'Le mail n\'est pas valide.';
            }
        } else {
            $formError['mail'] = 'Les mails ne sont pas identiques...';
        }
    } else {
        $formError['mail'] = 'Veuillez renseigner un mail svp.';
        $formError['mailVerify'] = 'Veuillez confirmer le mail svp.';
    }
    //On vérifie que le mot de passe est renseigné et qu'il est identique à la confirmation. On le hash avant de le mettre en base de données. 
    if (!empty($_POST['password']) && !empty($_POST['passwordVerify'])) {
        if ($_POST['password'] == $_POST['passwordVerify']) {
            $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        } else {
            $formError['password'] = 'Les mots de passe ne sont pas identiques';
        }
    } else {
        $formError['password'] = 'Veuillez renseigner un mot de passe svp.';
        $formError['passwordVerify'] = 'Veuillez confirmer le mot de passe svp.';
    }
    //Si il n'y a pas d'erreur, j'enregistre l'utilisateur
    if (count($formError) == 0) {
        $user->mail = $mail;
        $user->nickname = $nickname;

        if ($user->addUsers()) {
            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}