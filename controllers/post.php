<?php

//Instanciation de l'objet posts. 
//$posts devient une instance de la classe posts.
//La méthode magique construct est appelée automatiquement grâce au mot clé new.
$posts = new posts();

$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $posts->id = htmlspecialchars($_GET['idDelete']);
    $isDelete = $posts->deletePost();
}
//On appelle la méthode grâce à $posts qui se trouve dans ma classe et qui me retourne un tableau stocké dans $postsList.
$postsList = $posts->getPostsList();
?>