$(document).ready(function () {

    if($('#dashboard').length > 0){
    CKEDITOR.replace("commentaire");
}

    if($('#dashboard').length > 0) {
        $('.delete_resume').click(function () {
            var ident = $(this).data();
            $.post(
                'delete_report.php', // Le fichier cible côté serveur.
                {
                    id : ident['id']
                }
                ,deleted(ident['id'])
            );

            function deleted(id){
                var el = '.item_resume_' + id;
                $(el).css('display','none');

            }
        });
    }
    if($('#list').length > 0) {
        $('.delete_resume').click(function () {
            var ident = $(this).data();
            $.post(
                'delete_report.php', // Le fichier cible côté serveur.
                {
                    id : ident['id']
                }
                ,deleted(ident['id'])
            );

            function deleted(id){
                var el = '.item_resume_' + id;
                $(el).css('display','none');

            }
        });
    }

});