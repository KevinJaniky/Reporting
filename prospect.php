<?php
require_once 'autoload.php';
require_once 'head.php';

$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}

?>

<div class="container" id="prospect">
    <h1 class="text-center marginTop">Prospection</h1>

    <div class="row">
        <div class="col marginTop">
            <form action="add_prospect.php" method="post">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" class="form-control" name="nom" id="nom" aria-describedby="helpId" placeholder="Nom">
                    <small id="helpId" class="form-text text-muted">Entrer le nom de l'entité</small>
                </div>
                <div class="form-group">
                    <label for="emailHelp">Email *</label>
                    <input type="email" class="form-control" name="mail" id="emailHelp"
                           aria-describedby="emailHelpId"
                           placeholder="Email">
                    <small id="emailHelpId" class="form-text text-muted">Saisissez votre email</small>
                </div>
                <div class="form-group">
                    <label for="tel">Telephone</label>
                    <input type="text" class="form-control" name="tel" id="tel" aria-describedby="telephone"
                           placeholder="Téléphone">
                    <small id="telephone" class="form-text text-muted">Saisissez votre téléphone Format : 0606060606</small>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <textarea class="form-control" name="adresse" id="adresse" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" name="cp" id="cp" aria-describedby="cp"
                           placeholder="Code postal">
                    <small id="cp" class="form-text text-muted">Saisissez le code postal  Format : 75000</small>
                </div>
                <div class="form-group">
                    <label for="ville">Ville *</label>
                    <input type="text" class="form-control" name="ville" id="ville" aria-describedby="ville"
                           placeholder="Ville">
                    <small id="ville" class="form-text text-muted">Saisissez votre ville</small>
                </div>
                <div class="form-group">
                    <label for="com">Commentaire</label>
                    <textarea class="form-control" name="com" id="com" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-info">Ajouter</button>
            </form>
        </div>
        <div class="col">
            <h5 class="text-center text-uppercase">Prospection de la journée</h5>
            <?php
            $d = new Prospection();
            $data = $d->readToday();
            $count_data = count($data);
            for ($i = 0; $i < $count_data; $i++) {
                $classe = 'collapse' . $i;
                ?>
                <div class="panel-group item_resume_<?= $data[$i]['id'] ?>" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default title_panel">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $classe ?>"
                                   aria-expanded="true" aria-controls="collapseOne">
                                    <div class="titre_resume"><?= $data[$i]['Nom'] ?></div>
                                </a>
                                <div class="delete_resume" data-id="<?= $data[$i]['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                            </h4>
                        </div>
                        <div id="<?= $classe ?>" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div><?= $data[$i]['mail'] ?></div>
                                <div><?=  ($data[$i]['tel']) ? $data[$i]['tel'] : '' ?></div>
                                <div class="adresse">
                                    <div><?= $data[$i]['adresse'] ?></div>
                                    <div><?= $data[$i]['code postale'] ?></div>
                                    <div><?= $data[$i]['ville'] ?></div>
                                </div>
                                <div><?= $data[$i]['commentaire'] ?></div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
            }

            ?>

        </div>
    </div>
</div>


<?php require_once 'footer.php' ?>
