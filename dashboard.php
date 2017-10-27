<?php
require_once 'autoload.php';
require_once 'head.php';
?>
<div class="container">
    <h1 class='text-center'>Dashboard</h1>
    <div class="row">
        <div class="col marginTop">
            <?php
            var_dump($_SESSION);
                if(isset($_SESSION['error_reporting'])){
                    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error_reporting'].'</div>';
                    unset($_SESSION['error_reporting']);
                }

            ?>
            <form action="add_comp.php" method="post">
                <div class="form-group">
                    <label for="date">My date</label>
                    <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="date">
                </div>
                <div class="form-group">
                    <label for="comp">Compétences</label>
                    <select class="form-control" id="comp" name="comp">
                       <?php
                       $competences = new Compétences();
                       $competence = $competences->read();
                       $count_competence = count($competence);
                       for($i=0;$i<$count_competence;$i++){
                           echo '<option value="'.$competence[$i]['id'].'">'.$competence[$i]['name'].'</option>';
                       }
                       ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <textarea name="com" id="commentaire" class="form-control" placeholder="Commentaire de la journée"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Reporter" class="btn btn-info">
                </div>
            </form>
        </div>
        <div class="col marginTop">
            <h5 class="text-center text-uppercase">Reporting de la journée</h5>
            <div class="resumeDay">

            </div>
        </div>
    </div>

</div>

<?php
require_once 'footer.php';
?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>