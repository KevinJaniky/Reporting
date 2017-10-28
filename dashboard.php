<?php
require_once 'autoload.php';
require_once 'head.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}

?>
<div class="container" id="dashboard">
    <h1 class='text-center'>Dashboard</h1>
    <div class="row">
        <div class="col marginTop">
            <?php
            if (isset($_SESSION['error_reporting'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_reporting'] . '</div>';
                unset($_SESSION['error_reporting']);
            }

            ?>
            <form action="add_comp.php" method="post">
                <div class="form-group">
                    <label for="date">My date</label>
                    <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="date">
                </div>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="titre" class="form-control" placeholder="Titre" name="title">
                </div>
                <div class="form-group">
                    <label for="comp">Compétences</label>
                    <select class="form-control" id="comp" name="comp">
                        <?php
                        $competences = new Competences();
                        $competence = $competences->read();
                        var_dump($competences);
                        $count_competence = count($competence);
                        for ($i = 0; $i < $count_competence; $i++) {
                            echo '<option value="' . $competence[$i]['id'] . '">' . $competence[$i]['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <textarea name="com" id="commentaire" class="form-control"
                              placeholder="Commentaire de la journée"></textarea>

                </div>
                <div class="form-group">
                    <input type="submit" value="Reporter" class="btn btn-info">
                </div>
            </form>
        </div>
        <div class="col marginTop">
            <h5 class="text-center text-uppercase">Reporting de la journée</h5>
            <div class="resumeDay">
                <?php
                $d = new Reporte();
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
                                        <div class="titre_resume"><?= $data[$i]['titre'] ?></div>
                                    </a>
                                    <div class="delete_resume" data-id="<?= $data[$i]['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                </h4>
                            </div>
                            <div id="<?= $classe ?>" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?= $data[$i]['commentaire'] ?>
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

</div>


<?php
require_once 'footer.php';
?>
