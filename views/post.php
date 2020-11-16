<?php
include '../models/config.php';
include '../controllers/post.php';
include 'header.php';
?>
<?php
if (isset($_GET['idDelete'])) {
    if ($isDelete) {
        ?>
        <div class="text-success">Suppression réussie!</div><?php
    } else {
        ?>
        <div class="text-danger">Echec de la suppression...</div>
        <?php
    }
}
?>
<div class="row">
    <div class="text-center col-12">
        <div class="hat">
            <h1>Liste des articles</h1>
        </div>
    </div>
</div>
<?php
if (isset($resultList)) {
    ?>
    <?php
} else {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Modification</th>
                            <th scope="col">Suppression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--                        Boucle foreach pour parcourir la liste des articles-->
                        <?php foreach ($postsList as $posts) { ?>
                            <tr>
                                <td><?= $posts->title ?></td>
                                <td><?= $posts->content ?></td>
                                <td><a class="btn blue-gradient btn-lg btn-block" href="postUpdate.php?id=<?= $posts->id ?>">Modification</a></td>
                                <td><a class="btn blue-gradient-rgba btn-lg btn-block" href="post.php?idDelete=<?= $posts->id ?>">Suppression</a></td>
                            </tr>
                        <?php } ?>                 
                    </tbody>
                </table>
            <?php }
            ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>