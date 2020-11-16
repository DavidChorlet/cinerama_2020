<?php

//Instanciation de l'objet posts. 
//$posts devient une instance de la classe posts.
//La méthode magique construct est appelée automatiquement grâce au mot clé new.
$posts = new posts();
//On appelle la méthode grâce à $posts qui se trouve dans ma classe et qui me retourne un tableau stocké dans $postsList.
$postsList = $posts->getPostsList();

//Pagination
$page = $posts->paging();
if (!empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page) {
    $_GET['page'] = intval($_GET['page']);
    //intval = retourne une valeur numerique, evite l'injection dans l'url
    $posts->id = (($_GET['page'] - 1) * 3);
    $postsList = $posts->getPostsForPaging();
} else {
    $postsList = $posts->getPostsList();
}
?>