<?php
include '../models/config.php';
include '../controllers/postUpdate.php';
include 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="text-center col-12">
            <div class="hat">
                <h1>Fiche de l'article</h1>
            </div>
            <div class="table-responsive">
                <table class="responsive">
                    <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <?php if ($isPost) { ?>
                        <tbody>
                            <tr>
                                <td><?= $posts->title ?></td>
                                <td><?= $posts->content ?></td>
                                <td><img src="../assets/<?= $posts->picture ?>" alt="<?= $posts->title ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="text-danger">L'article n'a pas été trouvé...</div>
            <?php } ?>
            <div class="hat">
                <h1>Modifier le contenu de cet article</h1>
            </div>
            <?php if ($isSuccess) { ?>
                <div class="text-success">Modifications enregistrées !</div>
                <?php
            }
            if ($isError) {
                ?>
                <div class="text-danger">Désolé, mais vos modifications n'ont pu être enregistrées.</div>
            <?php } ?>
        </div>
    </div>
</div>
<!--                Formulaire de mise à jour d'un article, la récupération se fait via l'Id-->
<div class="container-fluid">
    <form method="POST" action="postUpdate.php?id=<?= $posts->id ?>" enctype="multipart/form-data" >
        <fieldset class="window">
            <div class="form-group">
                <div class="input-group mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Affiche/Couverture</label>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Image</span>
                    </div>
                    <div class="custom-file">
                        <input name="affiche" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Fichier</label>
                    </div>
                </div>
                <div class="form-row">             
                    <label for="title" class="col-sm-2 col-form-label">Titre</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" id="title" placeholder="Votre nouveau titre" value="<?= isset($title) ? $title : '' ?>"/>
                        <p class="text-danger"><?= isset($formError['title']) ? $formError['title'] : '' ?></p>
                    </div>
                </div>
                <div class="form-row">             
                    <label for="content" class="col-sm-2 col-form-label">Nouveau Texte</label>
                    <div class="col-sm-10">
                        <textarea name="content" type="text" class="form-control" id="content" value="<?= isset($content) ? $content : '' ?>"></textarea>
                        <p class="text-danger"><?= isset($formError['content']) ? $formError['content'] : '' ?></p>
                    </div>
                </div>
                <input class="btn btn-black" type="submit" value="Valider votre contribution" name='submit'/>
            </div>
        </fieldset>
    </form>
</div>
<?php include 'footer.php'; ?>