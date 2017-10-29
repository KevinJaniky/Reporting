<?php
require_once 'autoload.php';
require_once 'head.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $client = new Client();
    $data = $client->readOne($id);
}
?>
<div class="container" id="client">
    <h1 class="text-center marginTop"><?= $data['societe'] ?></h1>
    <small id="societe" class="form-text text-muted">Pour modifier les données du client , il suffit simplement de
        modifier les données du formulaire. <br>La sauvegarde est automatique
    </small>
    <div class="row marginTop nav-client">
        <div class="col-3">
            <div id="general">Général</div>
            <div id="commentaires">Commentaires</div>
            <div id="documents">Documents</div>
        </div>
    </div>
    <div class="element_navigation">
        <div class="info_client">
            <form id="form_client">
                <div class="row marginTop">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="societe">Société</label>
                            <input type="text" class="form-control" name="societe" id="societe"
                                   aria-describedby="societe"
                                   placeholder="Société" value="<?= $data['societe'] ?>">
                            <small id="societe" class="form-text text-muted">Nom de la société</small>
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" value="<?= $data['nom'] ?>"
                                   aria-describedby="nom" placeholder="Nom">
                            <small id="nom" class="form-text text-muted">Nom du contact</small>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" aria-describedby="prenom"
                                   placeholder="Prénom" value="<?= $data['prenom'] ?>">
                            <small id="prenom" class="form-text text-muted">Prénom du contact</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="mail" id="email" aria-describedby="mail"
                                   placeholder="Email" value="<?= $data['mail'] ?>">
                            <small id="mail" class="form-text text-muted">Email du contact</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tel">Téléphone</label>
                            <input type="text" class="form-control" name="tel" id="tel" aria-describedby="tel"
                                   placeholder="Téléphone" value="<?= $data['tel'] ?>">
                            <small id="tel" class="form-text text-muted">Téléphone du contact</small>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <textarea class="form-control" name="adresse" id="adresse" rows="1"
                            ><?= $data['adresse'] ?></textarea>
                            <small id="adresse" class="form-text text-muted">Adresse de la société</small>
                        </div>
                        <div class="form-group">
                            <label for="cp">Code postal</label>
                            <input type="text" class="form-control" name="cp" id="cp" aria-describedby="cp"
                                   placeholder="Code postal" value="<?= $data['codepostal'] ?>">
                            <small id="cp" class="form-text text-muted">Code Postal de la société</small>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" class="form-control" name="ville" id="ville" aria-describedby="ville"
                                   placeholder="Ville" value="<?= $data['ville'] ?>">
                            <small id="ville" class="form-text text-muted">Ville de la société</small>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
            </form>
        </div>
        <div class="info_client_commentaire">
            <form method="post">
                <div class="form-group">
                    <label for="com">Commentaire</label>
                    <textarea class="form-control" name="com" id="com"
                              rows="5" data-id="<?php echo $_GET['id'] ?>"><?= $data['commentaire'] ?></textarea>
                </div>

            </form>
        </div>
        <div class="info_client_documents">
            <form method="post" action="add_file.php" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" class="form-control-file" name="doc" id="doc" placeholder="Ajouter un document"
                           aria-describedby="doc">
                        <input type="hidden" name="MAX_FILE_SIZE" value="284377200" />
                    <small id="doc" class="form-text text-muted">Ajouter un document</small>
                </div>
                <input type="submit" value="Ajouter" class="btn btn-info">
            </form>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>
