<?php

//Instanciation de l'objet medias. 
//$medias devient une instance de la classe medias.
//La méthode magique construct est appelée automatiquement grâce au mot clé new.
$medias = new medias();
//On appelle la méthode grâce à $medias qui se trouve dans ma classe et qui me retourne un tableau stocké dans $mediasList.
$mediasList = $medias->getmediasList();

//Pagination

$page = $medias->paging();
if (!empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page) {
    $_GET['page'] = intval($_GET['page']);
    //intval = retourne une valeur numerique, evite l'injection dans l'url
    $medias->id = (($_GET['page'] - 1) * 5);
    $mediasList = $medias->getMediasForPaging();
} else {
    $mediasList = $medias->getMediasList();
}
?>