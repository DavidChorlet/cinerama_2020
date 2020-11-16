<?php
include '../models/config.php';
include '../controllers/mediasList.php';
include 'header.php';
?>
<div class="row">
    <div class="text-center col-12">
        <div class="hat">
            <h1>Liste des oeuvres</h1>
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
                            <th scope="col">Oeuvre</th>
                            <th scope="col">Réal/Auteur</th>
                            <th scope="col">Résumé</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mediasList as $medias) { ?>
                            <tr>
                                <td><?= $medias->title ?></td>
                                <td><?= $medias->director ?></td>
                                <td><?= $medias->content ?></td>
                                <td><img src="../assets/<?= $medias->picture ?>" alt="<?= $medias->title ?>" class="img-fluid" /></td>
                            </tr>
                        <?php } ?>                 
                    </tbody>
                </table>
            <?php }
            ?>
        </div>
    </div>
</div>
<div>
<!--    Pagination 5 fiches par page-->
    <nav aria-label="navigation-simple">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $page; $i++) :
                isset($_GET['page']) ? $_GET['page'] : $_GET['page'] = 1;
                if ($_GET['page'] != $i) :
                    ?>
                    <li class="page-item"><a class="page-link text-danger" href="mediasList.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                else :
                    ?>
                    <li class="page-item disabled page-link text-dark"> <?= $i ?></li>
                    <?php
                    endif;
                endfor;
                ?>
        </ul>
    </nav>
</div>
<?php include 'footer.php';
?>