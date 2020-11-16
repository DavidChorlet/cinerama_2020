<?php
include '../models/config.php';
include '../controllers/register.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="form-row">
        <div class="text-center col-12" >
            <div class="hat">
                <h1>Inscription</h1>
            </div>
            <?php if ($isSuccess) { ?>
                <div class="text-success">Votre inscription est réussie !</div>
                <?php
            }
            if ($isError) {
                ?>
                <div class="text-danger">Désolé, mais votre inscription a échoué...</div>
            <?php } ?>
            <!--            Formulaire d'inscription-->
            <div class="container">
                <form method="POST" action="#">
                    <fieldset class="window">
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="mail" name="mail" class="form-control" id="mail"  placeholder="Renseignez votre adresse mail" />
                            <div class="mailMessage"></div>
                            <div class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></div>
                        </div>
                        <div class="form-group">
                            <label for="mailVerify">Mail (confirmation)</label>
                            <input type="mail" name="mailVerify" class="form-control" id="mailVerify"  placeholder="Confirmez votre adresse mail" />
                            <div class="text-danger"><?= isset($formError['mailVerify']) ? $formError['mailVerify'] : '' ?></div>
                        </div>
                        <div class="form-group">
                            <label for="nickname">Pseudo</label>
                            <input type="text" name="nickname" class="form-control" id="nickname"  placeholder="Renseignez votre pseudo" />
                            <div class="text-danger"><?= isset($formError['nickname']) ? $formError['nickname'] : '' ?></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" class="form-control" id="password"  placeholder="Renseignez votre mot de passe" />
                            <div class="text-danger"><?= isset($formError['password']) ? $formError['password'] : '' ?></div>
                        </div>
                        <div class="form-group">
                            <label for="passwordVerify">Mot de passe (confirmation)</label>
                            <input type="password" name="passwordVerify" class="form-control" id="passwordVerify"  placeholder="Confirmez votre mot de passe" />
                            <div class="text-danger"><?= isset($formError['passwordVerify']) ? $formError['passwordVerify'] : '' ?></div>
                        </div>
                        <button type="submit" name="register" class="btn btn-dark">S'enregistrer</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/script.js" type="text/javascript"></script>
<?php include 'footer.php'; ?>