<?php
require_once 'autoload.php';
require_once 'head.php';
$user = new User();
if (!$user->isConnected()) {
    header('location:index.php');
    die();
}

?>
<div class="container" id="list_prospect">
    <h1 class='text-center'>Liste</h1>
    <div class="row items">
        <?php
        $lists = new Prospection();
        $list = $lists->readAll();
        $count_list = count($list);
        for ($i = 0; $i < $count_list; $i++) {
            if ($i == 0) {
                $date = $list[$i]['create_at'];
                echo '<div class="title">' . date('l d F Y', strtotime($list[$i]['create_at'])) . '</div>';
            }

            if ($date != $list[$i]['create_at']) {
                $date = $list[$i]['create_at'];
                echo '<div class="title">' . date('l d F Y', strtotime($list[$i]['create_at'])) . '</div>';
            }
            $classe = 'item_'.$list[$i]['id'];
            ?>
            <div class="panel-group item_resume_<?= $list[$i]['id'] ?>" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default title_panel">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $classe ?>"
                               aria-expanded="true" aria-controls="collapseOne">
                                <div class="titre_resume"><?= $list[$i]['Nom'] ?></div>
                            </a>
                            <div class="swap_client" data-id="<?= $list[$i]['id'] ?>"><i class="fa fa-address-book-o" aria-hidden="true"></i></div>
                            <div class="delete_resume" data-id="<?= $list[$i]['id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                        </h4>
                    </div>
                    <div id="<?= $classe ?>" class="panel-collapse collapse in content-resume" role="tabpanel"
                         aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div><?= $list[$i]['mail'] ?></div>
                            <div><?=  ($list[$i]['tel']) ? $list[$i]['tel'] : '' ?></div>
                            <div class="adresse">
                                <div><?= $list[$i]['adresse'] ?></div>
                                <div><?= $list[$i]['code postale'] ?></div>
                                <div><?= $list[$i]['ville'] ?></div>
                            </div>
                            <div><?= $list[$i]['commentaire'] ?></div>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }
        ?>
    </div>
</div>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php
require_once 'footer.php';
?>
