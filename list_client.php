<?php
require_once 'autoload.php';
require_once 'head.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}
$client = new Client();
$data = $client->readAll();
$count_client = count($data);
?>

    <div class="container" id="list_client">
        <h1 class="marginTop text-center">Liste des clients</h1>
        <div class="row">
            <div class="col-3 offset-9 search-box">
                <form>
                    <div class="form-group search-bar">
                        <label for="">Rechercher</label>
                        <input type="text" class="form-control" name="search" id="search" aria-describedby="helpId"
                               placeholder="">
                    </div>
                </form>
            </div>
        </div>
        <div id="result" class=" row ">
            <?php
            for ($i = 0; $i < $count_client; $i++) {
                ?>
                <div class="col-4">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h4 class="card-title"><?= $data[$i]['societe'] ?></h4>
                            <p class="card-text">
                                <span><?= $data[$i]['nom'] ?></span><span><?= $data[$i]['prenom'] ?></span></p>
                            <a href="client.php?id=<?= $data[$i]['id'] ?>" class="btn btn-primary btn-block">Accéder</a>
                        </div>
                    </div>
                </div>
                <?php

            }

            ?>
        </div>
    </div>

<?php
require_once 'footer.php';
?>