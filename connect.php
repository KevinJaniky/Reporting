<?php
require_once 'autoload.php';
$user = new User();

if (!$user->isAdmin()) {

    if (isset($_POST['identifiant']) && isset($_POST['mdp'])) {
        $id = $_POST['identifiant'];
        $mdp = $_POST['mdp'];

        $result = $user->getUser($id, $mdp);

        if ($result) {
            $user->createSession($result['id']);
            ?>
            <script> window.location.href = "dashboard.php" </script>
            <?php

        } else {
            ?>
            <script> window.location.href = "index.php" </script>
            <?php
        }
    }


    ?>
    <script>window.location.href = "index.php"</script>
    <?php
} else {
    ?>
    <script> window.location.href = "dashboard.php" </script>
    <?php
}