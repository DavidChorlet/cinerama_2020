<?php
include '../models/config.php';
include '../controllers/usersList.php';
include 'header.php';
?>
<div class="row">
    <div class="text-center col-12">
        <div class="hat">
            <h1>Liste des utilisateurs</h1>
        </div>
    </div>
</div>
<?php
if (isset($resultList)) {
    ?>
    <?php
} else {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pseudo:</th>
                        </tr>
                    </thead>
                    <!--                    Boucle foreach pour parcourir la liste des utilisateurs-->
                    <tbody>
                        <?php foreach ($usersList as $users) { ?>
                            <tr>
                                <td><?= $users->nickname ?></td>                                         
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
<!--    Pagination 5 utilisateurs par page-->
    <nav aria-label="navigation-simple">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $page; $i++) :
                isset($_GET['page']) ? $_GET['page'] : $_GET['page'] = 1;
                if ($_GET['page'] != $i) :
                    ?>
                    <li class="page-item"><a class="page-link text-danger" href="usersList.php?page=<?= $i ?>"><?= $i ?></a></li>
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