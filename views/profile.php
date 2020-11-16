<?php
include '../models/config.php';
include '../controllers/profile.php';
include 'header.php';
?>
<?php
if (isset($_GET['idDelete'])) {
    if ($isDelete) {
    } else {
        ?>
        <div class="text-danger">Echec de la suppression...</div>
        <?php
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <div class="hat">
                <h1>Votre Profil</h1>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Adresse Mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $_SESSION['nickname']; ?></td>
                            <td><?= $_SESSION['mail']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="hat">
    <h1>Modifier votre profil</h1>
</div>
<?php if ($isSuccess) { ?>
    <div class="text-success">Modifications enregistrées !</div>
    <?php
}
if ($isError) {
    ?>
    <div class="text-danger">Désolé, mais vos modifications n'ont pu être enregistrées...</div>
<?php } ?>
<!--    Formulaire de mise à jour du profil-->
<div class="container-fluid">
    <form method="POST" action="profile.php?id=<?= $users->id ?>">
        <fieldset class="window">
            <div class="form-group">
                <div class="form-row">             
                    <label for="nickname" class="col-sm-2 col-form-label">Nouveau pseudo</label>
                    <div class="col-sm-10">
                        <input name="nickname" type="text" class="form-control" id="nickname" placeholder="<?= $_SESSION['nickname']; ?>" value="<?= $_SESSION['nickname']; ?>"/>
                        <p class="text-danger"><?= isset($formError['nickname']) ? $formError['nickname'] : '' ?></p>
                    </div>
                </div>
                <div class="form-row">             
                    <label for="mail" class="col-sm-2 col-form-label">Nouvelle adresse mail</label>
                    <div class="col-sm-10">
                        <input name="mail" type="email" class="form-control" id="mail" placeholder="<?= $_SESSION['mail']; ?>" value="<?= $_SESSION['mail']; ?>"/>
                        <p class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
                    </div>
                </div>
                <div class="form-row">             
                    <label for="password" class="col-sm-2 col-form-label">Nouveau mot de passe</label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" id="password" placeholder="<?= $_SESSION['password']; ?>" value="<?= $_SESSION['password']; ?>"/>
                        <p class="text-danger"><?= isset($formError['password']) ? $formError['password'] : '' ?></p>
                    </div>
                </div>       
                <input class="btn btn-black" type="submit" value="Valider" name='submit'/>
            </div>
        </fieldset>
    </form>
</div>
<div><a class="btn btn-danger" href="profile.php?idDelete=<?= $_SESSION['id']; ?>">Supprimer votre profil</a></div>
<div class="hat">
    <div><a href="?action=deconnexion">Vous déconnecter</a></div>
</div>
<script src="assets/js/script.js" type="text/javascript"></script>
<?php
include 'footer.php';
?>