<?php
require_once 'autoload.php';
require_once 'head.php';
?>


<div class="container-fluid" id="index">
    <div class="content">
        <h1>Reporting</h1>
        <?php
            new User();
        ?>
        <form action="connect.php" method="post">
            <div class="form-group">
                <label for="identifiant">Identifiant</label>
                <input type="text" name="identifiant" id="identifiant" placeholder="Identifiant" class="form-control">
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="text" name="mdp" id="mdp" placeholder="Mot de passe" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info btn-block">
            </div>
        </form>
    </div>
</div>








<?php require_once 'footer.php'; ?>
