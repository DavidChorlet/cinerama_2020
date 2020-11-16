<?php

//Instanciation de l'objet users. 
//$users devient une instance de la classe users.
//La méthode magique construct est appelée automatiquement grâce au mot clé new.
$users = new users();
//on appelle la méthode grâce à $patients qui se trouve dans ma classe et qui me retourne un tableau stocké dans $patientsList
$usersList = $users->getUsersList();

//Pagination
$page = $users->paging();
if (!empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page) {
    $_GET['page'] = intval($_GET['page']);
    //intval = retourne une valeur numerique, evite l'injection dans l'url
    $users->id = (($_GET['page'] - 1) * 5);
    $usersList = $users->getUsersForPaging();
} else {
    $usersList = $users->getUsersList();
}
?>